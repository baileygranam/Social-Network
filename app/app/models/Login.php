<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model
{
	/**
	 * Class Constructor
	 */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * The login function is used to authenticate a user.
     *
     * @param $data - An array containing user data.
     * @return True if authentication passed, false otherwise.
     */
    public function login($data) 
    {
    	/* Define/build the query. */
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('email', $data['email']);

        /* Retrieve the result. */
        $result = $this->db->get();

        /* Check to see if a result exists. */
        if($result->num_rows() != 1) return false;

        /* Retrieve the hashed password. */
        $hashedPassword = $result->row()->password;

        /* Check to see if user provided password matches the hashed password. */
       	$verify = password_verify($data['password'], $hashedPassword);

       	/* Return status of login authentication. */
       	return ($verify);
    }

    /**
     * Method to fetch data of an authenticated user.
     * @param $email - Email of the user.
     * @return $data - Array of user data. 
     */
    public function fetchUserData($email)
    {
    	/* Define/build the query. */
    	$this->db->select('user_id, email, first_name, last_name, username');
        $this->db->from('users');
        $this->db->where('email', $email);

        /* Retrieve the result. */
        $result = $this->db->get();

        /* Check to see if a result exists. */
        if($result->num_rows() != 1) return false;

        /* Retrieve the row. */
        $result = $result->row();

        $data = array(
        	'user_id'    => $result->user_id,
        	'email'      => $result->email,
        	'first_name' => $result->first_name,
        	'last_name'  => $result->last_name,
        	'username'   => $result->username
        );

        return ($data);
    }
}
