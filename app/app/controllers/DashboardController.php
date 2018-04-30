<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller 
{
	/**
	 * The purpose of the constructor is to instantiate the DashboardController 
	 * and required dependencies.
	 */
	public function __construct() 
	{
		parent::__construct();

        /* Load the Post mode. */
        $this->load->model('Post');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['posts'] = $this->get_timeline();
		$pages = array('dashboard/index.php', 'templates/timeline.php');
		$this->view($pages, $data);
	}

	/**
	 * Method to retrieve posts to display on dashboard.
	 * @return User Timeline
	 */
	private function get_timeline()
	{
		return ($this->Post->get_timeline());
	}
}
