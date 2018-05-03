<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model to control group operations such as creation, getting groups, adding members, etc.
 *
 * @author Bailey Granam
 */
class Group extends CI_Model
{
    /* Constructor */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to create a new group.
     * 
     * @param  $data   - Array of group data.
     * @return int     - ID of group, if success.
     * @return boolean - False if fail.
     */
    public function create($data)
    {
        $this->db->insert('groups', $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }


    /**
     * Method to retrieve a groups data. 
     *
     * @return $id (int) - ID of group.
     */
    public function get_group($id = null)
    {
        $this->db->select('users.username, groups.group_id, groups.title, groups.description')
                 ->from('groups')
                 ->join('group_members', 'group_members.group_id = groups.group_id')
                 ->join('users', 'users.user_id = groups.owner_id')
                 ->where('group_members.user_id', $this->session->user_id);

        if($id != null) $this->db->where('groups.group_id', $id);

        $data = $this->db->get();

        return ($data->num_rows() > 0) ? $data : false;
    }

    /**
     * Method to get users of a group.
     *
     * @param $id (int) - ID of the group.
     * @return object  - Member data if members exist for a group.
     * @return boolean - False if no users exist in a group.
     */
    public function get_members($id)
    {
        $this->db->select('users.user_id, users.username, users.first_name, users.last_name, users.avatar')
                 ->from('group_members')
                 ->join('users', 'group_members.user_id = users.user_id')
                 ->where('group_members.group_id', $id);

        $data = $this->db->get();

        return ($data->num_rows() > 0) ? $data->result() : false;
    }

    /**
     * Method to get NON users of a group.
     *
     * @param $id (int) - ID of the group.
     * @return object  - User data of users who are not in the group.
     * @return boolean - False if all users are in the group.
     */
    public function get_non_members($id)
    {
        $this->db->select('users.user_id, users.username, users.first_name, users.last_name, users.avatar')
                 ->from('users')
                 ->join('group_members', 'group_members.user_id = users.user_id AND group_members.group_id ='.$id, 'LEFT')
                 ->where('group_members.user_id', NULL);

        $data = $this->db->get();

        return ($data->num_rows() > 0) ? $data->result() : false;
    }

    /**
     * Method to add a new user to the group.
     *
     * @param $group_id (int) - ID of the group.
     * @param $user_id (int)  - ID of the user to add.
     * @return boolean - True if success, false if fail.
     */
    public function add_member($group_id, $user_id)
    {
        /* If user already in group then exit. */
        if($this->isGroupMember($group_id, $user_id)) return false;

        $this->db->where('groups.owner_id', $this->session->user_id)
                 ->where('groups.group_id', $group_id);
        $this->db->insert('group_members', array('group_id' => $group_id, 'user_id' => $user_id));

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Method to check if a user is a member.
     *
     * @param $group_id (int) - ID of the group.
     * @param $user_id (int)  - ID of the user to add.
     * @return boolean - True if success, false if fail.
     */
    private function isGroupMember($group_id, $user_id)
    {
        $this->db->select('*')
                 ->from('group_members')
                 ->where('group_id', $group_id)
                 ->where('user_id', $user_id);

        $data = $this->db->get();

        return ($data->num_rows() > 0) ? true : false;
    }
}