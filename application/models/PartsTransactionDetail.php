<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartsTransactionDetail extends CI_Model
{
    var $table;
    function __construct() {
        parent::__construct();
        $this->table = 'parts_transaction_details';
    }
    
    function get($xid_transaction) {
        $this->db->where('xid_transaction', $xid_transaction);
        $this->db->select('*');
        $data = $this->db->get($this->table);

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function insert($data) {
        if($this->db->insert($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete($xid_transaction) {
        $this->db->where('xid_transaction', $xid_transaction);
        $this->db->delete($this->table);
    }
}
