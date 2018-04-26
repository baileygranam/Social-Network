<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->CI = & get_instance();
    }
    
    /** 
    * The view() method loads the appropriate view based
    * on the requested page url. 
    *
    * @param $page - The page(s) to be rendered in the view.
    */
    public function view($page, $data = NULL) 
    {
        /* Check to ensure the page exists. Otherwise display an error. */
        if(!file_exists(APPPATH . 'views/'.$page)) 
        {
            show_404();
        }
        
        /* Load the header template file. */
        $this->load->view('templates/header', $data);

        /* Load the pages requested by the controller. */
        for($i = 0; $i < count($page); $i++)
        {
            $this->load->view($page);
        }

        /* Load the footer template file. */
        $this->load->view('templates/footer');   
    }
    
}