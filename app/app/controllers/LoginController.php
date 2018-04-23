<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends MY_Controller 
{

	/**
	 * The purpose of the constructor is to instantiate the LoginController 
	 * and required dependencies.
	 */
	public function __construct() 
	{
		parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->helper(array('form', 'url'));
        $this->load->model('Login');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->view('login/index.php');
	}

	public function authenticate()
	{
		/* Run the form validation to check if provided input is valid. */
		if (!$this->validate()) 
		{
			/* Respond to AJAX request with a value of false. */
			echo false;
			return false;
		}

		/* User submitted data to authenticate. */
		$data = array(
			'email'    => $this->input->post('email'),
			'password' => $this->input->post('password')
		);

		if($this->Login->login($data))
		{
			echo true;
		}
		else
		{
			echo false;
		}


		
	}

	/**
	 * Method to validate the form data provided by the user.
	 * @return True if form data is valid, false otherwise.
	 */
	private function validate()
	{
		/* Set the form validation rules to ensure input validity. */
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		/* Return the result of the form validation. */
		return ($this->form_validation->run());
	}
}
