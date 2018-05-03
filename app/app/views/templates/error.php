<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if(!empty($this->session->flashdata('error_message')))
{
	echo '<script type="text/javascript"> swal("Whoops!","'.$this->session->flashdata('error_message').'", "error"); </script>';
}

?>