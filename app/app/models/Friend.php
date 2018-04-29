<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friend extends CI_Model
{
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to send a friend request.
     * 
     * @access public
     * @param  $data   - Array containing the user id and the friend id.
     * @return boolean - True if success, false if fail.
     */
    public function send_friend_request($data)
    {
        /* Return result of insertion. */
        return $this->db->insert('friends', $data);
    }

    /**
     * Method to accept a friend request.
     *
     * @access public
     * @param  $data   - Array containing the user id and the friend id.
     * @return boolean - True if success, false if fail.
     */
    public function accept_friend_request($data)
    {
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('friend_id', $data['friend_id']);
        $this->db->update('friends', array('status' => 1));
    }

    /**
     * Method to remove a friend.
     *
     * @access public
     * @param  $data   - Array containing the user id and the friend id.
     * @return boolean - True if success, false if fail.
     */
    public function remove_friend($data)
    {
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('friend_id', $data['friend_id']);
        $this->db->update('friends', array('status' => 2));
    }
}