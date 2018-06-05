<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    function index() {
        redirect('site/login');
    }

    function login() {
        if($this->session->userdata('isLoggedIn')) {
            redirect(site_url('site/home'));
        } else {
            $this->load->view('template/header');
            $this->load->view('login');
            $this->load->view('template/footer');            
        }
    }

    function home() {
        if($this->session->userdata('isLoggedIn')) {
            $this->load->view('template/header');
            $this->load->view('home');
            $this->load->view('template/footer');
        } else {
            redirect(site_url('site/login'));
        }
    }

    function testing() {
        echo uniqid('TRN');
    }
}