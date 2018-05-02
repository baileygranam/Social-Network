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
     * @return int     - Post ID, if success.
     * @return boolean - If false.
     */
    public function create($data)
    {
        $this->db->insert('posts', $data['post']);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function upload($data)
    {
        $this->db->insert('post_attachments', $data);
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
     * @return $data   - Timeline of posts.
     * @return boolean - False if no posts found.
     */
    public function get_timeline()
    {
        /* Get the result array of id's of both user and user friend posts. */
        $user_posts = $this->get_user_posts()->result_array();
        $friend_posts = $this->get_friend_posts()->result_array();

        /* Merge the id arrays. */
        $posts = array_merge($user_posts, $friend_posts);

        /* Flatted the multidimensional array to just post id's. */
        $count = 0;
        foreach(new RecursiveIteratorIterator(new RecursiveArrayIterator($posts)) as $v) 
        {
            $result[$count] = $v;
            $count++;
        }

        /* 
         * If the result array is not empty then query for all posts where the post_id is in
         * the $result array.
         */
        if(!empty($result))
        {
            $this->db->select('posts.caption, posts.created_at, users.username, users.first_name, users.last_name, users.avatar')
                     ->from('posts')
                     ->join('users', 'users.user_id = posts.user_id')
                     ->where('posts.isDeleted', 0)
                     ->where_in('posts.post_id', $result)
                     ->order_by('posts.post_id', 'DESC');
            $data = $this->db->get();

            return $data;
        }

        return false; /* Return false if no post id's found in $result array. */
    }

    /**
     * Method to retrieve the id's of posts made by a user.
     *
     * @return object - Result of database query.
     */
    private function get_user_posts()
    {
        $this->db->select('posts.post_id')
                 ->from('posts')
                 ->where('posts.user_id', $this->session->user_id)
                 ->where('posts.isDeleted', 0)
                 ->order_by('posts.post_id', 'DESC');
        $data = $this->db->get();

        return $data;
    }

    /**
     * Method to retrieve the id's of posts made by a user's friend.
     *
     * @return object - Result of database query.
     */
    private function get_friend_posts()
    {
        $this->db->select('posts.post_id')
                 ->from('posts')
                 ->join('friends', 'friends.friend_id = posts.user_id', 'INNER')
                 ->where('friends.user_id', $this->session->user_id)
                 ->where('posts.isDeleted', 0)
                 ->where('friends.status', 1)
                 ->order_by('posts.post_id', 'DESC');
        $data = $this->db->get();

        return $data;
    }

}