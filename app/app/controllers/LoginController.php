<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to handle user authentication procedures.
 *
 * @author Bailey Granam
 */
class LoginController extends MY_Controller 
{
	/* Constructor */
	public function __construct() 
	{
		parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->helper('form');
        $this->load->model('User');
    }

   	/**
	 * Method to load the login page for this controller.
	 */
	public function index()
	{
		$this->view('login/index.php');
	}

     /**
     * Method to login and authenticate a user.
     */
	public function login()
	{
		/* Redirect to login page is form was not submitted. */
		if(!$this->input->post())
			redirect('login');

		/* Set the form validation rules to ensure input validity. */
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		/* User submitted data to authenticate. */
		$data = array(
			'email'    => $this->input->post('email'),
			'password' => $this->input->post('password')
		);

		/* Check for input validation and user authentication. */
		if (!$this->validate() || !$this->User->authenticate($data)) 
		{
	        $this->session->set_flashdata('error', true);
			redirect('/login');
		}
		else
		{
			/* Retrieve the user's data. */
			$data = $this->User->get($data['email']);

	        /* Add user data to the session */
	        $this->session->set_userdata($data);

	        /* Redirect to the home page. */
			redirect('/');
		}
	}

	/**
	* Method to logout the user.
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}
}