<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to manage/view the user's friends.
 *
 * @author Bailey Granam
 */
class FriendController extends MY_Controller 
{
	/* Constuctor */
	public function __construct() 
	{
		parent::__construct();

        /* Load the Friend model. */
        $this->load->model('Friend');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		/* Grab all the friends of the user. */
		$data['friends'] = $this->Friend->get();

		/* Load the default page displaying the friends list. */
		$this->view('friends/index.php', $data);
	}

	/**
	 * Method to add a friend given an ID.
	 *
	 * @param $id (int) - ID of the friend to be added. 
	 */
	public function add($id)
	{
		/* Exit if the user is attempting to add themselves as a friend. */
		if($id == $this->session->user_id)
		{
			$data['error_message'] = 'You can not add yourself as a friend!';
		}
		else
		{
			/* Arrange the ID's in such a way that user id < friend id. */
			$data = $this->sort_ids($id);

			/* Execute the request to add a friend. */
			$result = $this->Friend->add($data);

			/* Set the message to display to the user in case of success/failure. */
			if($result)
				$data = array('success_message' => 'Friend successfully added!');
			else
				$data = array('error_message' => 'There was an error adding that user!');
		}
		
		/* Save the result message to session and redirect to the friends list. */
		$this->session->set_flashdata($data);
		$this->session->keep_flashdata($data);
		redirect('/friends');
	}

	/**
	 * Method to remove a friend.
	 *
	 * @param $id (int) - ID of friend to be removed. 
	 */
	public function remove($id)
	{
		/* Exit if the user is attempting to remove themselves as a friend. */
		if($id == $this->session->user_id)
		{	
			$data['error_message'] = 'Unknown error occured!';
		}
		else
		{
			/* Arrange the ID's in such a way that user id < friend id. */
			$data = $this->sort_ids($id);

			/* Execute the request to remove a friend. */
			$result = $this->Friend->remove($data);

			/* Set the message to display to the user in case of success/failure. */
			if($result)
				$data = array('success_message' => 'Friend successfully removed!');
			else
				$data = array('error_message' => 'There was an error removing that user!');
		}

		/* Save the result message to session and redirect to the friends list. */
		$this->session->set_flashdata($data);
		$this->session->keep_flashdata($data);
		redirect('/friends');
	}

	/**
	 * Method to sort ID's such that user < friend.
	 *
	 * @return $data (array) - Data array containing ID's in increasing order.
	 */
	private function sort_ids($id)
	{
		$user_id = ($this->session->user_id > $id) ? $id : $this->session->user_id;
		$friend_id = ($this->session->user_id > $id) ? $this->session->user_id : $id;

		$data = array('user_id' => $user_id, 'friend_id' => $friend_id);

		return $data;
	}
}