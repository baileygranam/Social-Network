<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller 
{
	/**
	 * The purpose of the constructor is to instantiate the UserController 
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
	 * Method to load a given page for this controller. (Route Specific).
	 *
	 * @access public
	 */
	public function index($page)
	{
		$this->view($page.'/index.php');
	}

	/**
    * Method to register a new user.
    * 
    * @access public
    */
    public function register()
    {
    	/* Set the form validation rules to ensure input validity. */
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[35]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[35]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60], callback_checkEmailExists[email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[12], callback_checkUsernameExists[username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[255]');

        /* Data to be registered. */
    	$data = array(
    		'email'      => $this->input->post('email'),
        	'first_name' => $this->input->post('first_name'),
        	'last_name'  => $this->input->post('last_name'),
        	'username'   => $this->input->post('username'),
        	'password'   => $this->input->post('password')
        );
		/* Check for input validation and if registration passed. */
    	if (!$this->validate() || !($this->User->create_user($data))) 
    	{
    		$this->session->set_flashdata('error', true);
    		$this->session->set_flashdata('error_message', 'Registration Failed!');
			redirect('/register');
    	}
    	else
    	{
    		redirect('/login');
    	}
    }

   	/**
     * Method to login and authenticate a user.
     *
     * @access public
     */
	public function login()
	{
		/* Set the form validation rules to ensure input validity. */
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		/* User submitted data to authenticate. */
		$data = array(
			'email'    => $this->input->post('email'),
			'password' => $this->input->post('password')
		);

		/* Check for input validation and user authentication. */
		if (!$this->validate() || !$this->User->authenticate_user($data)) 
		{
            $this->session->set_flashdata('error', true);
			redirect('/login');
		}
		else
		{
			/* Retrieve the user's data. */
			$data = $this->User->get_user($data['email']);

            /* Add user data to the session */
            $this->session->set_userdata($data);

            /* Redirect to the home page. */
			redirect('/home');
		}
	}

	/**
	* Method to logout the user.
	*
	* @access public
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}

	/**
	 * Method to validate the form data provided by the user.
	 *
	 * @access private
	 * @return True if form is valid, false otherwise.
	 */
	private function validate()
	{
		return ($this->form_validation->run());
	}

	/**
	 * Method to check if a username exists.
	 *
	 * @access private
	 * @param $username - username of a user. 
	 * @return True if exists, false if not.
	 */
	private function checkUsernameExists($username)
	{
		return ($this->User->checkUsernameExists($username));
	}

	/**
	 * Method to check if an email exists.
	 *
	 * @access private
	 * @param $email - Email of a user. 
	 * @return True if exists, false if not.
	 */
	private function checkEmailExists($email)
	{
		return ($this->User->checkEmailExists($email));
	}
}
