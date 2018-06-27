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
        $this->load->model('transactioncancelation');
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
            $data['part_subtotal'] = $this->partstransactiondetail->get_subtotal($id);
            $data['service_details'] = $this->servicetransactiondetail->get($id);
            $data['service_subtotal'] = $this->servicetransactiondetail->get_subtotal($id);
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
                $data['part_subtotal'] = $this->partstransactiondetail->get_subtotal($data['id']);
                $data['service_details'] = $this->servicetransactiondetail->get($data['id']);
                $data['service_subtotal'] = $this->servicetransactiondetail->get_subtotal($data['id']);

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
                if ($this->part->check_stock($xid_part, $jumlah)) {
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
        if ($this->session->userdata('isLoggedIn')) {
            if ($this->session->userdata('transactionOngoing')) {
                $id = $this->session->userdata('id');
                $dibayar = $this->input->post('dibayar');
                $keterangan = $this->input->post('keterangan');
                // ambil semua data transaksi part
                $parts_transaction_details = $this->partstransactiondetail->get($id);
                // ambil semua data transaksi service
                $service_transaction_details = $this->servicetransactiondetail->get($id);
                if ($this->input->post('action') == 'Selesai') {
                    // bila transaksi selesai
                    // ubah part_details menjadi sold
                    if ($parts_transaction_details != null) {
                        foreach ($parts_transaction_details as $row) {
                            $this->partdetail->set_status($row->part_serial_num, 'sold');
                        }
                    }
                    // tambah record jumlah servis mekanik
                    if ($service_transaction_details != null) {
                        foreach ($service_transaction_details as $row) {
                            $this->mechanic->inc_jumlah_servis($row->xid_mechanic);
                        }
                    }
                    // ubah jadi done
                    $this->transaction->done($id, $dibayar, $keterangan);
                    echo 'Sukses';
                    redirect(site_url('transactions/struk?id=' . $id));
                } else if ($this->input->post('action') == 'Batal') {
                    // bila transaksi batal
                    // ubah part_details menjadi available
                    if ($parts_transaction_details != null) {
                        foreach ($parts_transaction_details as $row) {
                            $this->partdetail->set_status($row->part_serial_num, 'available');
                        }
                    }
                    // ubah jadi cancelled
                    $this->transaction->cancel($id, $keterangan);
                    echo 'Batal';
                }
                $this->session->unset_userdata('transactionOngoing');
                $this->session->unset_userdata('id');
            }
        }
        echo "<script>window.close();</script>";
    }

    function struk()
    {
        if ($this->session->userdata('isLoggedIn')) {
            $id = $this->input->get('id');
            if ($id != null) {
                $data['transaction'] = $this->transaction->get($id);
                $data['part_details'] = $this->partstransactiondetail->get($id);
                $data['part_subtotal'] = $this->partstransactiondetail->get_subtotal($id);
                $data['service_details'] = $this->servicetransactiondetail->get($id);
                $data['service_subtotal'] = $this->servicetransactiondetail->get_subtotal($id);
                $this->load->view('struk', $data);
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function cancelation()
    {
        if ($this->session->userdata('isLoggedIn') && $this->session->userdata('jabatan') == 'kasir') {
            $id = $this->input->get('id');
            if ($id != null) {
                $data['id'] = $id;
                $data['transaction'] = $this->transaction->get($id);
                $data['part_details'] = $this->partstransactiondetail->get($id);
                $data['part_subtotal'] = $this->partstransactiondetail->get_subtotal($id);
                $data['service_details'] = $this->servicetransactiondetail->get($id);
                $data['service_subtotal'] = $this->servicetransactiondetail->get_subtotal($id);
                $this->load->view('template/header');
                $this->load->view('cancelation', $data);
                $this->load->view('template/footer');
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function submit_cancelation()
    {
        if ($this->session->userdata('isLoggedIn') && $this->session->userdata('jabatan') == 'kasir') {
            $xid_transaction = $this->input->post('id');
            $alasan = $this->input->post('alasan');
            if ($xid_transaction != null) {
                date_default_timezone_set('Asia/Jakarta');
                $time = date('Y-m-d H:i:s', time());
                $data = [
                    'xid_transaction' => $xid_transaction,
                    'username_kasir' => $this->session->userdata('username'),
                    'status' => 'waiting',
                    'alasan' => $alasan,
                    'submission_time' => $time
                ];
                if ($this->transactioncancelation->insert($data)) {
                    $this->transaction->submit_for_cancelation($xid_transaction);
                    echo 'Sukses';
                } else {
                    echo 'Gagal';
                }
            }
            echo '<br>';
        }
        echo 'Mohon tunggu untuk diarahkan kembali';
        echo '<script>setTimeout(function() {window.close()},3000)</script>';
    }

    function acc_cancelation()
    {
        if ($this->session->userdata('isLoggedIn') && $this->session->userdata('jabatan') == 'manajer') {
            $id = $this->input->get('id');
            $transaction_cancelation = $this->transactioncancelation->get($id);
            if ($id != null) {
                $xid_transaction = $transaction_cancelation[0]->xid_transaction;
                $data['id'] = $id;
                $data['alasan'] = $transaction_cancelation[0]->alasan;
                $data['transaction'] = $this->transaction->get($xid_transaction);
                $data['part_details'] = $this->partstransactiondetail->get($xid_transaction);
                $data['part_subtotal'] = $this->partstransactiondetail->get_subtotal($xid_transaction);
                $data['service_details'] = $this->servicetransactiondetail->get($xid_transaction);
                $data['service_subtotal'] = $this->servicetransactiondetail->get_subtotal($xid_transaction);
                $this->load->view('template/header');
                $this->load->view('acc_cancelation', $data);
                $this->load->view('template/footer');
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }
    }

    function finish_acc_cancelation()
    {
        if ($this->session->userdata('isLoggedIn') && $this->session->userdata('jabatan') == 'manajer') {
            $id = $this->input->post('id');
            $keterangan = $this->input->post('alasan');
            date_default_timezone_set('Asia/Jakarta');
            $time = date('Y-m-d H:i:s', time());
            $submit = $this->input->post('submit');
            if ($id != null) {
                $xid_transaction = $this->transactioncancelation->get($id)[0]->xid_transaction;
                if ($submit == 'Setujui') {
                    // ambil semua data transaksi part
                    $parts_transaction_details = $this->partstransactiondetail->get($xid_transaction);
                    // ambil semua data transaksi service
                    $service_transaction_details = $this->servicetransactiondetail->get($xid_transaction);
                    // ubah part_details menjadi available
                    if ($parts_transaction_details != null) {
                        foreach ($parts_transaction_details as $row) {
                            $this->partdetail->set_status($row->part_serial_num, 'available');
                        }
                    }
                    // kurangi jumlah servis mekanik
                    if ($service_transaction_details != null) {
                        foreach ($service_transaction_details as $row) {
                            $this->mechanic->dec_jumlah_servis($row->xid_mechanic);
                        }
                    }
                    // ubah jadi approve
                    $this->transaction->approve_cancelation($xid_transaction, $keterangan);
                    $this->transactioncancelation->approve($id, $time);
                    // update info transaction
                    echo 'Disetujui';
                } else {
                    $this->transaction->reject_cancelation($xid_transaction);
                    $this->transactioncancelation->reject($id, $time);
                    echo 'Ditolak';
                }
            }
            echo '<br>';
        }
        echo 'Mohon tunggu untuk diarahkan kembali';
        echo '<script>setTimeout(function() {window.close()},3000)</script>';
    }
}
