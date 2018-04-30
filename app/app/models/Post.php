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
     * @param  $id     - ID of post to be deleted.
     * @return boolean - True if success, false if fail.
     */
    public function delete($id)
    {
        $this->db->set('isDeleted', 1)
                 ->where('user_id', $this->session->user_id)
                 ->where('post_id', $id);
        return ($this->db->update('posts'));
    }

    /**
     * Method to retrieve a timeline of user/friend posts.
     * 
     * @access public
     * @return $data  - Timeline of posts.
     */
    public function get_timeline()
    {
        $this->db->select('*')
                 ->from('posts')
                 ->join('users', 'posts.user_id = users.user_id', 'INNER')
                 ->where('users.user_id', $this->session->user_id)
                 ->where('posts.isDeleted', 0)
                 ->order_by('posts.post_id', 'DESC');
        $data = $this->db->get();

        return $data;
    }

}