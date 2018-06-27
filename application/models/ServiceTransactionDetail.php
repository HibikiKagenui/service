<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceTransactionDetail extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'service_transaction_details';
    }

    function get($xid_transaction)
    {
        $this->db->select('service_transaction_details.*');
        $this->db->select('services.nama as nama_service');
        $this->db->select('mechanics.nama as mechanic');
        $this->db->from('service_transaction_details, services, mechanics');
        $this->db->where('services.id', 'service_transaction_details.xid_service', false);
        $this->db->where('mechanics.id', 'service_transaction_details.xid_mechanic', false);
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
        $this->db->select('sum(biaya) as subtotal');
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

    function cancel($xid_transaction)
    {
        $this->db->where('xid_transaction', $xid_transaction);
        $this->db->delete($this->table);
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}
