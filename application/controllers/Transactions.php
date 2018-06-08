<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('transaction');
        $this->load->model('partstransactiondetail');
        $this->load->model('servicetransactiondetail');
    }
    
    function index() {
        redirect('transactions/new');
    }
    
    function history() {
        if($this->session->userdata('isLoggedIn')) {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            echo 'Under construction';
            $this->load->view('template/footer');
        } else {
            redirect(site_url());
        }
    }
    
    function detail() {
        if($this->session->userdata('isLoggedIn')) {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            echo 'Under construction';
            $this->load->view('template/footer');
        } else {
            redirect(site_url());
        }
    }
    
    
    function new() {
        if($this->session->userdata('isLoggedIn')) {
            if($this->session->userdata('processingTransaction')) {
                $id = $this->session->userdata('id');
                $xid_customer = $this->session->userdata('xid_customer');
                
                $data['id'] = $id;
                $data['xid_customer'] = $xid_customer;
                $data['parts'] = $this->partstransactiondetail->get($xid_customer);
                $data['services'] = $this->servicetransactiondetail->get($xid_customer);
                $this->load->view('template/header');
                $this->load->view('new-transaction', $data);
                $this->load->view('template/footer');            
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }
    
    function insert_part() {
        if($this->session->userdata('isLoggedIn')) {
            if($this->session->userdata('processingTransaction')) {
                $xid_transaction = $this->session->userdata('id');
                $xid_part = $this->input->post('id');
                $jumlah = $this->input->post('jumlah');
                
                // cek stok, bila stok memenuhi, lanjut
                // bila tidak, langsung redirect ke form lagi
                
                echo $xid_transaction.'<br>';
                echo $xid_part.'<br>';
                echo $jumlah.'<br>';
                // redirect(site_url('transactions/new'));
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }
    
    function insert_service() {
        if($this->session->userdata('isLoggedIn')) {
            if($this->session->userdata('processingTransaction')) {
                $xid_transaction = $this->session->userdata('id');
                $xid_service = $this->input->post('id');
                $xid_mechanic = $this->input->post('mechanic');
                
                // insert
                // jumlah servis mechanic ditambah 1
                
                echo $xid_transaction.'<br>';
                echo $xid_service.'<br>';
                echo $xid_mechanic.'<br>';
                // redirect(site_url('transactions/new'));
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }
    
    function finish() {
        $id = $this->session->userdata('id');
        if ($this->input->post('action') == 'Selesai') {
            $jenis_kendaraan = $this->input->post('jenis_kendaraan');
            $this->transaction->set_jenis($id,$jenis_kendaraan);
            $this->transaction->set_done($id);
            echo 'Sukses';
        } else if ($this->input->post('action') == 'Batal') {
            $this->partstransactiondetail->delete($id);
            $this->servicetransactiondetail->delete($id);
            $this->transaction->delete($id);
            echo 'Batal';
        }
        $this->session->unset_userdata('processingTransaction');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('time');
        $this->session->unset_userdata('xid_customer');
        redirect(site_url());
    }
}
