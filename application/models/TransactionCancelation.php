<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 26-Jun-18
 * Time: 11:48 AM
 */

class TransactionCancelation extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'transaction_cancelations';
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

    function approve($id, $time)
    {
        $this->db->set('status', 'approved');
        $this->db->set('accepted_time', $time);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    function reject($id, $time)
    {
        $this->db->set('status', 'rejected');
        $this->db->set('accepted_time', $time);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }
}