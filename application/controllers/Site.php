<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('customer');
        $this->load->model('part');
        $this->load->model('service');
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
            $data['customer'] = $this->customer->get_all();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('home', $data);
            $this->load->view('template/footer');
        } else {
            redirect(site_url('site/login'));
        }
    }
    
    function parts() {
        if($this->session->userdata('isLoggedIn')) {
            $data['part'] = $this->part->get_all();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('parts', $data);
            $this->load->view('template/footer');
        } else {
            redirect(site_url('site/login'));
        }
    }
    
    function services() {
        if($this->session->userdata('isLoggedIn')) {
            $data['service'] = $this->service->get_all();
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('services', $data);
            $this->load->view('template/footer');
        } else {
            redirect(site_url('site/login'));
        }
    }

    function mechanics() {
        if($this->session->userdata('isLoggedIn')) {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('mechanics');
            $this->load->view('template/footer');
        } else {
            redirect(site_url('site/login'));
        }
    }
    
    function testing() {
        echo uniqid('TRN');
    }
}