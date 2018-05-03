<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller used for searching users.
 *
 * @author Bailey Granam
 */
class SearchController extends MY_Controller 
{

	/* Constuctor */
	public function __construct() 
	{
		parent::__construct();

        /* Load the Search model. */
        $this->load->model('Search');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->view('search/index.php');
	}

	/**
	 * Method to retrieve users based on search query.
	 */
	public function search()
	{
		$q = $this->input->get('q');
		$data['results'] = $this->Search->get($q);

		if(empty($data['results'])) 
		{
			$data = array('error_message' => 'No search results found!');
			$this->session->set_flashdata($data);
		}

		$this->view('search/index.php', $data);
	}
}
