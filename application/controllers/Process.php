<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user');
    }

    function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

		$record = $this->user->login($username,$password);
		
		if ($record) {
			$row = $record->row();
			$arSession = [
				'isLoggedIn' => TRUE,
				'username' => $row->username,
                'password' => $row->password,
                'nama' => $row->nama,
                'jabatan' => $row->jabatan
			];
			
			$this->session->set_userdata($arSession);
		}
        redirect(site_url());
    }

    function logout() {
   		$this->session->sess_destroy();
        redirect(site_url());
    }

    function insert_transaction() {
        // auto generate transaction id
        // get jenis kendaraan
        // set waktu
        // set jumlah terbayar = 0
        // set status = pending
        // get id customer

        // insert
        
        // redirect ke form transaksi 2
    }
}