<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
	/**
	 * Class Constructor
	 */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to create a new user.
     * 
     * @access public
     * @param  $data   - Array of user data.
     * @return boolean - True if success, false if fail.
     */
    public function create_user($data)
    {
        /* Hash Password using Bcrypt. */
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        /* Return result of registration. */
        return $this->db->insert('users', $data);
    }

    /**
     * Method to authenticate a user's credentials. 
     *
     * @access public
     * @param $data - Array of user data.
     * @return boolean - True if success, false if fail.
     */
    public function authenticate_user($data) 
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
     * Method to retrieve a user's common data. 
     *
     * @access public
     * @param $email - Email of a user.
     * @return $data - Array of user data.
     */
    public function get_user($email)
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