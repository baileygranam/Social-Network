<?php

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
}
