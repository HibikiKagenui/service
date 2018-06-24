<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 18-Jun-18
 * Time: 5:42 PM
 */

class PartDetail extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'part_details';
    }


    function get($xid_part)
    {
        $this->db->select('*');
        $this->db->where('xid_part', $xid_part);
        $data = $this->db->get($this->table);

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function get_detail($id)
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

    function update($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function check_stock($xid_part, $jumlah)
    {
        $this->db->select('count(id) as qty');
        $this->db->where('xid_part', $xid_part);

        $data = $this->db->get($this->table);

        if ($data->result()[0]->qty >= $jumlah) {
            return true;
        } else {
            return null;
        }
    }

    function get_available($xid_part, $jumlah)
    {
        $this->db->select('parts.id');
        $this->db->select('parts.nama');
        $this->db->select('parts.harga');
        $this->db->select('part_details.part_serial_num');
        $this->db->from('parts, part_details');
        $this->db->where('parts.id', $xid_part);
        $this->db->where('parts.id', 'part_details.xid_part', false);
        $this->db->where('part_details.status', 'available');
        $this->db->limit($jumlah);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function set_status($part_serial_num, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('part_serial_num', $part_serial_num);
        if ($this->db->update($this->table)) {
            return true;
        } else {
            return false;
        }
    }
}