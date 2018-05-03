<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if(!empty($this->session->flashdata('success_message')))
{
	echo '<script type="text/javascript"> swal("Yay!","'.$this->session->flashdata('success_message').'", "success"); </script>';
}

?>