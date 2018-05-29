<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
    var $table;
    function __construct()
    {
        parent::__construct();
        $this->table = "users";        
    }

    function get_all()
    {
        if ($result = $this->db->select('*')->from($this->table)->get()->result())
        {
            return $result;
        }
    }
}
