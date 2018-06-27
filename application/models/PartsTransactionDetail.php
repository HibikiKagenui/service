<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartsTransactionDetail extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'parts_transaction_details';
    }

    function get($xid_transaction)
    {
        $this->db->select('parts_transaction_details.*');
        $this->db->select('parts.nama');
        $this->db->from('parts_transaction_details, parts');
        $this->db->where('parts.id', 'parts_transaction_details.xid_part', false);
        $this->db->where('xid_transaction', $xid_transaction);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function get_subtotal($xid_transaction)
    {
        $this->db->select('sum(harga) as subtotal');
        $this->db->where('xid_transaction', $xid_transaction);
        $data = $this->db->get($this->table);

        if ($data->num_rows() > 0) {
            return $data->result()[0]->subtotal;
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

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
