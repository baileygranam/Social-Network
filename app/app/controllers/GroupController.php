<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to manage/view groups.
 *
 * @author Bailey Granam
 */
class GroupController extends MY_Controller 
{
	/* Constuctor */
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation'); 
        $this->load->helper('form');

        /* Load the Group model. */
        $this->load->model('Group');

        /* Load the Friend model. */
        $this->load->model('Friend');
    }

     /**
	 * Index Page for this controller.
	 */
	public function index()
	{
		/* Grab all the groups of the user. */
		$data['groups'] = $this->Group->get_group();

		/* Load the default page displaying the friends list. */
		$this->view('groups/index.php', $data);
	}

	/** 
	 * Method to create a group.
	 */
	public function create()
	{
		/* Redirect to group page is form was not submitted. */
		if(!$this->input->post())
		{
			redirect('groups');
		}

		/* Set the form validation rules to ensure input validity. */
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');

		/* Data to be inserted. */
    	$data = array(
    		'owner_id'    => $this->session->user_id,
    		'title'       => $this->input->post('title'),
        	'description' => $this->input->post('description')
        );

    	/* Check if input is valid. */
    	if($this->validate())
    	{
    		/* Grab the result. */
    		$result = $this->Group->create($data);

    		/* If the result did not return empty then redirect to the group page. */
    		if(!empty($result))
    		{
    			/* Add the owner to the group after the group is created. */
    			$this->Group->add_member($result, $this->session->user_id);

    			redirect('/groups/'.$result);
    		}
    	}
    	else /* If something went wrong then present an error. */
    	{
		    $data = array('error_message' => 'Unable to create that group! Try Again.');
		    $this->session->set_flashdata($data);
			$this->index();
    	}
    	
	}

	/**
	 * Method to view a specific group.
	 *
	 * @param $group_id (int) - ID of the group.
	 */
	public function get($group_id)
	{
		/* Group information. */
		$data['group'] = $this->Group->get_group($group_id);

		/* Users who are NOT in the group. */
		$data['friends'] = $this->Group->get_non_members($group_id);

		/* Users who are in the group. */
		$data['members'] = $this->Group->get_members($group_id);

		/* If the requested group returned no data then present an error. */
		if(empty($data['group']))
		{
		    $data = array('error_message' => 'You do not have access to this group.');
		    $this->session->set_flashdata($data);
		    $this->session->keep_flashdata($data);
			redirect('/groups/');
		}

		/* Load the group page. */
		$this->view('groups/group.php', $data);
	}

	/** 
	 * Method to add a user to a group.
	 *
	 * @param $group_id (int) - ID of the group.
	 * @param $user_id (int)  - ID of the user.
	 */
	public function add($group_id, $user_id)
	{
		/* Get the result from the operation. */
		$result = $this->Group->add_member($group_id, $user_id);

		if(!$result) /* If result is false then present an error. */
		{
			$data = array('error_message' => 'There was an issue adding that user to the group.');
		}
		else /* Otherwise show a success message. */
		{
			$data = array('success_message' => 'User added to the group.');
		}

		/* Set temp data and redirect to page. */
		$this->session->set_flashdata($data);
	    $this->session->keep_flashdata($data);

		redirect('/groups/'.$group_id);
	}
}