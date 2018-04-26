<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Model
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
        return $this->db->insert('users', $data);
    }
}