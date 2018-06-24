<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('transaction');
        $this->load->model('part');
        $this->load->model('partdetail');
        $this->load->model('partstransactiondetail');
        $this->load->model('service');
        $this->load->model('mechanic');
        $this->load->model('servicetransactiondetail');
    }

    function index()
    {
        redirect('transactions/new');
    }

    function detail()
    {
        if ($this->session->userdata('isLoggedIn')) {
            $id = $this->input->get('id');
            $data['transaction'] = $this->transaction->get($id);
            $data['part_details'] = $this->partstransactiondetail->get($id);
            $data['service_details'] = $this->servicetransactiondetail->get($id);
            $this->load->view('template/header');
            $this->load->view('transaction_detail', $data);
            $this->load->view('template/footer');
        } else {
            redirect(site_url());
        }
    }

    function new()
    {
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('transactionOngoing')) {
                $data['id'] = $this->session->userdata('id');
                $data['transaction'] = $this->transaction->get($data['id']);

                $data['parts'] = $this->part->get_all();
                $data['services'] = $this->service->get_all();
                $data['mechanics'] = $this->mechanic->get_all();

                $data['part_details'] = $this->partstransactiondetail->get($data['id']);
                $data['service_details'] = $this->servicetransactiondetail->get($data['id']);

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

    function insert_part()
    {
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('transactionOngoing')) {
                $xid_transaction = $this->session->userdata('id');
                $xid_part = $this->input->post('id_part');
                $jumlah = $this->input->post('jumlah');

                // cek ketersediaan stok
                if ($this->partdetail->check_stock($xid_part, $jumlah)) {
                    // ambil serial number part yang tersedia
                    $data = $this->partdetail->get_available($xid_part, $jumlah);
                    if ($data != null) {
                        $detail = [
                            'xid_part' => $xid_part,
                            'xid_transaction' => $xid_transaction
                        ];
                        foreach ($data as $row) {
                            // masukkan ke tabel partstransactiondetails
                            $detail['part_serial_num'] = $row->part_serial_num;
                            $detail['harga'] = $row->harga;
                            $this->partstransactiondetail->insert($detail);
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', 'Stok tidak mencukupi');
                }
                redirect(site_url('transactions/new'));
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function delete_part()
    {
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('transactionOngoing')) {
                $id = $this->input->get('id');
                $this->partstransactiondetail->delete($id);
                redirect(site_url('transactions/new'));
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function insert_service()
    {
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('transactionOngoing')) {
                $xid_transaction = $this->session->userdata('id');
                $xid_service = $this->input->post('id_service');
                $xid_mechanic = $this->input->post('id_mechanic');

                $biaya = $this->service->get($xid_service)[0]->biaya;

                $detail = [
                    'xid_service' => $xid_service,
                    'biaya' => $biaya,
                    'xid_mechanic' => $xid_mechanic,
                    'xid_transaction' => $xid_transaction
                ];

                // insert
                $this->servicetransactiondetail->insert($detail);

                redirect(site_url('transactions/new'));
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function delete_service()
    {
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('transactionOngoing')) {
                $id = $this->input->get('id');
                $this->servicetransactiondetail->delete($id);
                redirect(site_url('transactions/new'));
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function finish()
    {
        $id = $this->session->userdata('id');
        $dibayar = $this->input->post('dibayar');
        if ($this->input->post('action') == 'Selesai') {
            $this->transaction->done($id, $dibayar);
            echo 'Sukses';
        } else if ($this->input->post('action') == 'Batal') {
//            // ubah part yang booked menjadi available
//            $serial = $this->partstransactiondetail->get($id);
//            if($serial != null) {
//                foreach ($serial as $row) {
//                    $this->partdetail->set_status($row->part_serial_num, 'available');
//                }
//            }
            $this->partstransactiondetail->cancel($id);
            $this->servicetransactiondetail->cancel($id);
            $this->transaction->delete($id);
            echo 'Batal';
        }
        $this->session->unset_userdata('transactionOngoing');
        $this->session->unset_userdata('id');
        redirect(site_url());
    }
}
