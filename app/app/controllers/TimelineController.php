<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to manage the user timeline.
 *
 * @author Bailey Granam
 */
class TimelineController extends MY_Controller 
{
	/** 
	 * The purpose of the constructor is to instantiate the TimelineController 
	 * and required dependencies. 
	 */
	public function __construct() 
	{
		parent::__construct();

        /* Load the Post model. */
        $this->load->model('Post');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		/* Grab the user's timeline. */
		$data['posts'] = $this->get_timeline();

		/* Load the timeline page and the timeline from templates. */
		$pages = array('timeline/index.php', 'templates/timeline.php');
		$this->view($pages, $data);
	}

	/**
	 * Method to retrieve the user's timeline.
	 *
	 * @return User Timeline
	 */
	private function get_timeline()
	{
		return ($this->Post->get_timeline());
	}
}
