<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'parts';
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

    function insert($data)
    {
        if ($this->db->insert($this->table, $data)) {
            return true;
        } else {
            return false;
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

    function update($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function check_stock($id, $jumlah)
    {
        $this->db->select('stok');
        $this->db->where('id', $id);

        $data = $this->db->get($this->table);

        if ($data->result()[0]->stok >= $jumlah) {
            return true;
        } else {
            return false;
        }
    }
}
