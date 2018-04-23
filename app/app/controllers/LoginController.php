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
        $this->load->helper('form');
        $this->load->model('Login');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->view('login/index.php');
	}

	/**
     * The authenticate() function is performed when a user submits the
     * login form. The information is loaded and proccessed through the
     * model. If the login is successful the user will be directed to
     * the dashboard. If the login fails then the user will be directed
     * to the login page with an error.
     */
	public function authenticate()
	{
		/* User submitted data to authenticate. */
		$data = array(
			'email'    => $this->input->post('email'),
			'password' => $this->input->post('password')
		);

		/* Check for input validation and user authentication. */
		if (!$this->validate() || !$this->Login->login($data)) 
		{
            $this->session->set_flashdata('error', true);
			redirect('/login');
			return false;
		}
		else
		{
			/* Retrieve the user's data. */
			$data = $this->Login->fetchUserData($data['email']);

            /* Add user data to the session */
            $this->session->set_userdata($data);

            /* Redirect to the home page. */
			redirect('/home');
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
