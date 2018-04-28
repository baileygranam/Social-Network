<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller 
{
	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->view('dashboard/index.php');
	}

	


}
