<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model to retrieve/search users in the database.
 *
 * @author Bailey Granam
 */
class Search extends CI_Model
{
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Friend');
    }

    /**
     * Method to retrieve users based on search criteria. 
     *
     * @param  $data (String) - Value used to search for users.
     * @return $data - Array of user data.
     */
    public function get($data)
    {
        /* Define/build the query. */
        $this->db->select('user_id, first_name, last_name, username, avatar')
                 ->from('users')
                 ->or_like('first_name', $data)
                 ->or_like('last_name', $data)
                 ->or_like('username', $data)
                 ->limit(10);

        /* Retrieve the result. */
        $data = $this->db->get();

        /* If no results were found then return false. */
        if($data->num_rows() == 0) return false;

        /* Check to see if user is friend's with any of the searched users. */
        $data = $data->result();

        for($i = 0; $i < count($data); $i++)
        {
            $data[$i]->isFriend = $this->Friend->isFriends($this->sort_ids($data[$i]->user_id));
        }

        /* Return results. */
        return $data;
    }

    /**
     * Method to sort ID's such that user < friend.
     *
     * @return $data (array) - Data array containing ID's in increasing order.
     */
    private function sort_ids($id)
    {
        $user_id = ($this->session->user_id > $id) ? $id : $this->session->user_id;
        $friend_id = ($this->session->user_id > $id) ? $this->session->user_id : $id;

        $data = array('user_id' => $user_id, 'friend_id' => $friend_id);

        return $data;
    }
}