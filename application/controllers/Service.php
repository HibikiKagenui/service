<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    function index()
    {
        echo "<center><h1><b>under construction...</b></h1></center>";
    }

    function user_json()
    {
        $data = $this->User->get_all();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));        
    }
}
