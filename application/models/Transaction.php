<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Model
{
    var $table;
    function __construct() {
        parent::__construct();
        $this->table = "transactions";
    }

    function get_all() {
        if ($result = $this->db->select('*')->from($this->table)->get()->result()) {
            return $result;
        } else {
            return null;
        }
    }

    function get($id) {
        if ($result = $this->db->select('*')->where('id',$id)->from($this->table)->get()->result()) {
            return $result;
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
}
