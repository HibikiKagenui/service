<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = "transactions";
    }

    function get_all()
    {
        $this->db->select('*');
        $data = $this->db->get($this->table);

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function get($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $data = $this->db->get($this->table);

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function insert($data)
    {
        if ($this->db->insert($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function done($id, $dibayar, $keterangan)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->db->set('status', 'done');
        $this->db->set('waktu_selesai', date('Y-m-d H:i:s', time()));
        $this->db->set('keterangan', $keterangan);
        $this->db->set('dibayar', $dibayar);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function cancel($id, $keterangan)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->db->set('status', 'canceled');
        $this->db->set('waktu_selesai', date('Y-m-d H:i:s', time()));
        $this->db->set('keterangan', $keterangan);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function submit_for_cancelation($id)
    {
        $this->db->set('status', 'waiting approval');
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function approve_cancelation($id, $keterangan)
    {
        $this->db->set('status', 'canceled');
        $this->db->set('keterangan', $keterangan);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function reject_cancelation($id)
    {
        $this->db->set('status', 'done');
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }


    function inc_total($biaya, $id)
    {
        $this->db->set('subtotal', 'subtotal + ' . $biaya, false);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function dec_total($biaya, $id)
    {
        $this->db->set('subtotal', 'subtotal - ' . $biaya, false);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }
}
