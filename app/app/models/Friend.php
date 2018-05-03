<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model to control friend related interactions such as adding/removing friends.
 *
 * @author Bailey Granam
 */
class Friend extends CI_Model
{
    /* Constuctor */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to send a friend request.
     * 
     * @param  $data (array) - The ID of the user and friend they want to add.
     * @return boolean       - True if success, false if fail.
     */
    public function add($data)
    {
        /* Check to see if user is already friends. */
        if($this->isFriends($data['friend_id']))
            return false;

        /* Insertion. */
        $this->db->insert('friends', array('user_id' => $data['user_id'], 'friend_id' => $data['friend_id']));

        return ($this->db->affected_rows() == 0) ? false : true;
    }

    /**
     * Method to remove a friend.
     *
     * @param  $id (int) - The ID of the friend the user wants to remove.
     * @return boolean   - True if success, false if fail.
     */
    public function remove($data)
    {
        $this->db->where('user_id', $data['user_id'])
                 ->where('friend_id', $data['friend_id']);
        $this->db->delete('friends');

        return ($this->db->affected_rows() == 0) ? false : true;
    }

    /**
     * Method to see if two users are already friends.
     *
     * @param  $data (array) - The ID of the user and friend they want to add.
     * @return boolean       - True if friends, false if not.
     */
    public function isFriends($data)
    {
        $this->db->from('friends')
                 ->where('friends.user_id', $data['user_id'])
                 ->where('friends.friend_id', $data['friend_id']);
        $data = $this->db->get();

        return ($data->num_rows() != 0);
    }

    /**
     * Method to retrieve all friends of the user. 
     *
     * @return object  - Data containing friends of a user.
     * @return boolean - False if no rows returned. 
     */
    public function get()
    {
        $data = $this->db->query(
            "SELECT users.user_id, users.username, users.first_name, users.last_name, users.avatar
             FROM users 
             LEFT JOIN friends 
             ON users.user_id = friends.friend_id 
             WHERE friends.user_id = {$this->session->user_id}
             UNION 
             SELECT users.user_id, users.username, users.first_name, users.last_name, users.avatar
             FROM users 
             LEFT JOIN friends 
             ON users.user_id = friends.user_id 
             WHERE friends.friend_id = {$this->session->user_id}"
         );

        return ($data->num_rows() != 0) ? $data->result() : false;
    }
}