<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends MY_Controller 
{
	/**
	 * The purpose of the constructor is to instantiate the RegisterController 
	 * and required dependencies.
	 */
	public function __construct() 
	{
		parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->helper('form');
        $this->load->model('User');
    }

    /**
	 * Method to load the registration page for this controller.
	 *
	 * @access public
	 */
	public function index()
	{
		$this->view('register/index.php');
	}

   /**
    * Method to register a new user.
    * 
    * @access public
    */
    public function register()
    {
    	/* Redirect to register page is form was not submitted. */
		if(!$this->input->post())
		{
			redirect('register');
		}

    	/* Set the form validation rules to ensure input validity. */
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[35]|alpha_numeric');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[35]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[12]|is_unique[users.username]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[255]');

        /* Set the form validation error messages. */
        $this->form_validation->set_message('is_unique',  'This {field} is already taken.');
        $this->form_validation->set_message('min_length', '{field} must be at least {param} characters.');
        $this->form_validation->set_message('max_length', '{field} must be less than {param} characters.');

        /* Set the error message delimiters. */
		$this->form_validation->set_error_delimiters('<p><i class="fas fa-exclamation-circle"></i> ', '</p>');

        /* Data to be registered. */
    	$data = array(
    		'email'      => $this->input->post('email'),
        	'first_name' => $this->input->post('first_name'),
        	'last_name'  => $this->input->post('last_name'),
        	'username'   => $this->input->post('username'),
        	'password'   => $this->input->post('password')
        );

		/* Check for input validation and if registration passed.
		 * If failed go back to registration form with errors.
		 */
    	if (!$this->validate() || !($this->User->create_user($data))) 
    	{
    		$this->session->set_flashdata('error', true);
    		$errors = form_error('first_name') . ' ' . form_error('last_name') . ' ' . form_error('email') . ' ' . form_error('username') . ' ' . form_error('password');
    		$this->session->set_flashdata('error_message', $errors);
			$this->index();
    	}
    	else 
    	{
    		$this->auto_login($data['email']);
    	}
    }

    /**
     * Method to automatically login a user without a password. 
     * Used for post-registration login.
     *
     * @access private
     */
    private function auto_login($email)
    {
        /* Retrieve the user's data. */
        $data = $this->User->get_user($email);

        /* Add user data to the session */
        $this->session->set_userdata($data);

        /* Redirect to the home page. */
        redirect('/home');
    }
}
