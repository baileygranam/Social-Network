<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model to manage posts such as creation, deletion, and liking.
 *
 * @author Bailey Granam
 */
class Post extends CI_Model
{
    /* Constructor */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to create a new post.
     * 
     * @param  $data (array) - Array of post data.
     * @return int           - Post ID, if success.
     * @return boolean       - If false.
     */
    public function create($data)
    {
        $this->db->insert('posts', $data['post']);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    /**
     * Method to upload attachments to a post.
     */
    public function upload($data)
    {
        $this->db->insert('post_attachments', $data);
    }

    /**
     * Method to delete a post.
     * 
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
     * Method to like a post.
     * 
     * @param  $id     - ID of post to be liked.
     * @return boolean - True if success, false if fail.
     */
    public function like($id)
    {

        $this->db->from('post_likes')
                 ->where('post_likes.post_id', $id)
                 ->where('post_likes.user_id', $this->session->user_id);
        $data = $this->db->get();

        if($data->num_rows() == 0)
        {
            $data = array(
                'post_id' => $id,
                'user_id' => $this->session->user_id
            );
            $this->db->insert('post_likes', $data);
        }

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Method to retrieve a timeline of user/friend posts.
     * 
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
            $this->db->select('posts.post_id, posts.user_id, posts.caption, posts.created_at, users.username, users.first_name, users.last_name, users.avatar, post_attachments.file_name, post_attachments.file_type_id')
                     ->from('posts')
                     ->join('users', 'users.user_id = posts.user_id')
                     ->join('post_attachments', 'post_attachments.post_id = posts.post_id', 'LEFT')
                     ->where('posts.isDeleted', 0)
                     ->where_in('posts.post_id', $result)
                     ->order_by('posts.post_id', 'DESC');
            $data = ($this->db->get())->result();

            /* Get the number of likes on a post. */
            for($i = 0; $i < count($data); $i++)
            {
                $data[$i]->likes = $this->get_post_likes($data[$i]->post_id);
            }

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
                 ->join('friends', 'friends.friend_id = posts.user_id OR friends.user_id = posts.user_id', 'INNER')
                 ->where('friends.user_id', $this->session->user_id)
                 ->or_where('friends.friend_id', $this->session->user_id)
                 ->where('posts.isDeleted', 0)
                 ->order_by('posts.post_id', 'DESC');
        $data = $this->db->get();

        return $data;
    }

    /**
     * Method to retrieve the number of likes on a post. 
     * 
     * @param $id  - ID of post to retrieve likes.
     * @return int - Number of likes on a post.
     */
    private function get_post_likes($id)
    {
        $this->db->from('post_likes')
                 ->where('post_likes.post_id', $id);
        $data = $this->db->get();

        return ($data->num_rows());
    }

}