<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('customer');
        $this->load->model('part');
        $this->load->model('service');
        $this->load->model('transaction');
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
    
    function insert_customer() {
        $id = uniqid('CST-');
        $nama = $this->input->post('nama');
        $no_ktp = $this->input->post('no_ktp');
        $alamat = $this->input->post('alamat');
        $no_kontak = $this->input->post('no_kontak');
        $gender = $this->input->post('gender');
        
        $data = [
            'id' => $id,
            'nama' => $nama,
            'no_ktp' => $no_ktp,
            'alamat' => $alamat,
            'no_kontak' => $no_kontak,
            'gender' => $gender
        ];
        
        if ($this->customer->insert($data)) {
            echo 'Sukses';
        }
        
        redirect(site_url());
    }

    function insert_part() {
        $id = uniqid('PRT-');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $stok = 0;

        $data = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok
        ];

        if ($this->part->insert($data)) {
            echo 'Sukses';
        }
        
        redirect(site_url('site/parts'));
    }

    function insert_service() {
        $id = uniqid('SRV-');
        $nama = $this->input->post('nama');
        $biaya = $this->input->post('biaya');

        $data = [
            'id' => $id,
            'nama' => $nama,
            'biaya' => $biaya
        ];

        if ($this->service->insert($data)) {
            echo 'Sukses';
        }
        
        redirect(site_url('site/services'));
    }

    function new_transaction() {
        // get id customer
        $xid_customer = $this->input->get('id');
        // auto generate transaction id
        $id = uniqid('TRN-');
        // get jenis kendaraan
        $jenis_kendaraan = '-';
        // set waktu
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s', time());
        // set jumlah terbayar = 0
        $jumlah_terbayar = 0;
        // set status = pending
        $status = 'pending';
        
        $data = [
            'id' => $id,
            'jenis_kendaraan' => $jenis_kendaraan,
            'waktu' => $waktu,
            'jumlah_terbayar' => $jumlah_terbayar,
            'status' => $status,
            'xid_customer' => $xid_customer
        ];
        
        // insert
        if($this->transaction->insert($data)) {
            echo 'Sukses';
            $arr = [
                'processingTransaction' => true,
                'id' => $id,
                'waktu' => $waktu,
                'xid_customer' => $xid_customer
            ];
            $this->session->set_userdata($arr);            
            redirect(site_url('transactions/new'));
        } else {
            echo 'Gagal';
            redirect(site_url());
        }
    }
}