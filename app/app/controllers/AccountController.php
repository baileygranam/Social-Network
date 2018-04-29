<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The AccountController class is used in controlling operations that
 * relate to user accounts. i.e posting, settings, etc.
 *
 * @author Bailey Granam
 */
class AccountController extends MY_Controller 
{
	/**
	 * The purpose of the constructor is to instantiate the AccountController 
	 * and required dependencies.
	 */
	public function __construct() 
	{
		parent::__construct();

		/* Load the Account model. */
        $this->load->model('Account');

        /* Load the Post mode. */
        $this->load->model('Post');
    }

   	/**
	 * Method to create a post.
	 *
	 * @access public
	 * @param $data - Data of the post.
	 */
	public function post()
	{
		/* Check if form was submitted, if not then redirect. */
		if(!$this->input->post())
			redirect('/dashboard');

		/* Set the form validation. */
		$this->form_validation->set_rules('caption', 'Caption', 'trim|required');

		/* Set the time zone for the created at date time. */
		date_default_timezone_set('America/New_York');

		/* Create $data array to send to the model to be inserted. */
		$data = array(
			'user_id'    => $this->session->user_id,
            'caption'    => $this->input->post('caption'),
            'created_at' => date("Y-m-d H:i:s")
        );

		/* If the validation fails or the post creation fails then false, otherwise true. */
		echo (!$this->validate() || !$this->Post->create($data)) ? false : true;
	}
}