<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Model
{
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to create a new post.
     * 
     * @access public
     * @param  $data   - Array of post data.
     * @return boolean - True if success, false if fail.
     */
    public function create_post($data)
    {
        return $this->db->insert('posts', $data);
    }
}