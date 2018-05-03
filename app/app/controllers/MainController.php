<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends MY_Controller 
{
	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->redirect('/');
	}
}
