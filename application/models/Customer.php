<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Model
{
    var $table;
    function __construct() {
        parent::__construct();
        $this->table = 'customers';
    }

    function get_all() {
        $this->db->select('*');
        $data = $this->db->get($this->table);

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function insert($data) {
        if ($this->db->insert($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }
}
