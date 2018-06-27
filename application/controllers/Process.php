<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('customer');
        $this->load->model('part');
        $this->load->model('partdetail');
        $this->load->model('service');
        $this->load->model('transaction');
        $this->load->model('mechanic');
    }

    function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->user->login($username, $password);

        if ($result != null) {
            $arSession = [
                'isLoggedIn' => TRUE,
                'username' => $result[0]->username,
                'password' => $result[0]->password,
                'nama' => $result[0]->nama,
                'jabatan' => $result[0]->jabatan
            ];

            $this->session->set_userdata($arSession);
        } else {
            $this->session->set_flashdata('message', 'Username dan/atau password salah');
        }
        redirect(site_url('site/login'));
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    function insert_customer()
    {
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

    function update_customer()
    {
        $id = $this->input->post('id');
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

        if ($this->customer->update($id, $data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/customers'));
    }

    function insert_part()
    {
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

    function update_part()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');

        $data = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok
        ];

        if ($this->part->update($id, $data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/parts'));
    }

    function insert_part_detail()
    {
        $part_serial_num = $this->input->post('part_serial_num');
        $status = $this->input->post('status');
        $xid_part = $this->input->post('xid_part');

        $data = [
            'part_serial_num' => $part_serial_num,
            'status' => $status,
            'xid_part' => $xid_part
        ];

        if ($this->partdetail->insert($data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/part_details?id=' . $xid_part));
    }

    function update_part_detail()
    {
        $id = $this->input->post('id');
        $part_serial_num = $this->input->post('part_serial_num');
        $status = $this->input->post('status');
        $xid_part = $this->input->post('xid_part');

        $data = [
            'part_serial_num' => $part_serial_num,
            'status' => $status,
        ];

        if ($this->partdetail->update($id, $data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/part_details?id=' . $xid_part));
    }

    function insert_service()
    {
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

    function update_service()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $biaya = $this->input->post('biaya');

        $data = [
            'id' => $id,
            'nama' => $nama,
            'biaya' => $biaya
        ];

        if ($this->service->update($id, $data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/services'));
    }

    function insert_mechanic()
    {
        $id = uniqid('MEK-');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $no_kontak = $this->input->post('no_kontak');
        $gender = $this->input->post('gender');
        $gaji = $this->input->post('gaji');
        $jumlah_servis = 0;

        $data = [
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_kontak' => $no_kontak,
            'gender' => $gender,
            'gaji' => $gaji,
            'jumlah_servis' => $jumlah_servis
        ];

        if ($this->mechanic->insert($data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/mechanics'));
    }

    function update_mechanic()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $no_kontak = $this->input->post('no_kontak');
        $gender = $this->input->post('gender');
        $gaji = $this->input->post('gaji');
        $jumlah_servis = $this->input->post('jumlah_servis');

        $data = [
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_kontak' => $no_kontak,
            'gender' => $gender,
            'gaji' => $gaji,
            'jumlah_servis' => $jumlah_servis
        ];

        if ($this->mechanic->update($id, $data)) {
            echo 'Sukses';
        }

        redirect(site_url('site/mechanics'));
    }

    function new_transaction()
    {
        // auto generate transaction id
        $id = uniqid('TRN-');
        if (!$this->input->post('awanama')) {
            // get jenis kendaraan
            $jenis_kendaraan = $this->input->post('jenis_kendaraan');
            // nomor polisi
            $nomor_polisi = $this->input->post('nomor_polisi');
            // keluhan
            $keluhan = $this->input->post('keluhan');
            // hanya pembelian false (0)
            $hanya_pembelian = 0;
            $purchase_only = false;
        } else {
            $jenis_kendaraan = null;
            $nomor_polisi = null;
            $keluhan = null;
            $hanya_pembelian = 1;
            $purchase_only = true;
        }
        // set waktu mulai
        date_default_timezone_set('Asia/Jakarta');
        $waktu_mulai = date('Y-m-d H:i:s', time());
        // set jumlah terbayar = 0
        $total = 0;
        // set status = pending
        $status = 'pending';
        // get id customer
        $xid_customer = $this->input->post('id');
        // username kasir
        $username_kasir = $this->session->userdata('username');

        $data = [
            'id' => $id,
            'hanya_pembelian' => $hanya_pembelian,
            'jenis_kendaraan' => $jenis_kendaraan,
            'nomor_polisi' => $nomor_polisi,
            'keluhan' => $keluhan,
            'waktu_mulai' => $waktu_mulai,
            'total' => $total,
            'status' => $status,
            'xid_customer' => $xid_customer,
            'username_kasir' => $username_kasir
        ];

        // insert
        if ($this->transaction->insert($data)) {
            echo 'Sukses';
            $session_data = [
                'transactionOngoing' => true,
                'id' => $id,
                'purchaseOnly' => $purchase_only
            ];
            $this->session->set_userdata($session_data);
            redirect(site_url('transactions/new'));
        } else {
            echo 'Gagal';
            redirect(site_url());
        }
    }

    function laporan()
    {
        $month = $this->input->get('month');
        $year = $this->input->get('year');

        $this->load->model('laporan');
        // metadata
        $data['month'] = $month;
        $data['year'] = $year;

        date_default_timezone_set('Asia/Jakarta');
        $data['creation_time'] = date('Y-m-d H:i:s', time());
        // transaction data
        $data['master'] = $this->laporan->get_master($month, $year);
        $data['part_details'] = $this->laporan->get_part_details($month, $year);
        $data['service_details'] = $this->laporan->get_service_details($month, $year);
        // part detail log data
        $data['part_detail_log'] = $this->laporan->get_part_detail_log($month, $year);
        // transaction cancelation data
        $data['transaction_cancelations'] = $this->laporan->get_transaction_cancelations($month, $year);

        $this->load->view('laporan', $data);
    }
}