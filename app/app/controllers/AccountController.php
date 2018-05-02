<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The AccountController class is used in controlling operations that
 * relate to user accounts. i.e posting, settings, etc.
 *
 * @author Bailey Granam
 */
class AccountController extends MY_Controller 
{
	/**
	 * The purpose of the constructor is to instantiate the AccountController 
	 * and required dependencies.
	 */
	public function __construct() 
	{
		parent::__construct();

		/* Load the Account model. */
        $this->load->model('Account');

        /* Load the Post mode. */
        $this->load->model('Post');
    }

   	/**
	 * Method to create a post.
	 *
	 * @access public
	 * @param $data - Data of the post.
	 */
	public function create_post()
	{        
		/* Check if form was submitted, if not then redirect. */
		if(!$this->input->post())
			redirect('/dashboard');

		/* Set the form validation. */
		$this->form_validation->set_rules('caption', 'Caption', 'trim|required');

		/* Set the time zone for the created at date time. */
		date_default_timezone_set('America/New_York');

        /* Run the form validation. */
        if(!$this->validate())
    	{
    		echo false;
    		return;
    	}

        /* Create $data array to send to the model to be inserted. */
        $data['post'] = array(
            'user_id'    => $this->session->user_id,
            'caption'    => $this->input->post('caption'),
            'created_at' => date("Y-m-d H:i:s")
        );

        /* Get the result from creating the post. */
        $result = $this->Post->create($data);

        /* Check to see if a file was selected to be uploaded.*/
        if (isset($_FILES['file']['name'])) 
        {
            /* Upload the file and retrieve the result. */
            $file_name = $this->upload_file(); 
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            /* Check whether file is an image, video, or audio. */
            $image_extensions = array('gif', 'png', 'jpeg', 'jpg');
            $video_extensions = array('mp4', 'mov', 'wmv', 'avi');
            $audio_extensions = array('mp3', 'wav');

            if(in_array($file_extension, $image_extensions))
                $file_type_id = 1;
            else if(in_array($file_extension, $video_extensions))
                $file_type_id = 2;
            else if(in_array($file_extension, $audio_extensions))
                $file_type_id = 3;

            if(!empty($file_name))
            {
                $data = array(
                    'post_id'      => $result,
                    'file_name'    => $file_name,
                    'file_type_id' => $file_type_id
                );

                /* Insert attachment information into the database. */
                $this->Post->upload($data);
            }
        }

        /* If the result returned empty then echo false. */
        if(empty($result))
        {
        	echo false;
        	return;
        }

        echo true;
	}

    /**
     * Method to upload a file from a post.
     *
     * @return string  - File name if upload passed.
     * @return boolean - False if upload failed.
     */
	private function upload_file()
	{
		/* File upload properties. */
		$config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|mp4|mov|wmv|avi|mp3';
        $config['max_filename'] = '255';
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '102400'; //100 MB

        /* Load the file upload library with the provided configurations. */
        $this->load->library('upload', $config);

        /* If the upload was successful then return the file name. Otherwise, return false. */
        if($this->upload->do_upload('file'))
        {
            return $this->upload->data('file_name');
        }

        return false;
	}
}