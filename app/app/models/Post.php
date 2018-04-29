<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model
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
    public function create($data)
    {
        return $this->db->insert('posts', $data);
    }

    /**
     * Method to delete a post.
     * 
     * @access public
     * @param  $data   - Array of post data.
     * @return boolean - True if success, false if fail.
     */
    public function delete($data)
    {
        $this->db->set('isDeleted', 1);
        $this->db->where($data);
        return ($this->db->update('posts'));
    }
}