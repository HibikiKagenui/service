<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
    var $table;
    function __construct() {
        parent::__construct();
        $this->table = "users";
    }

    function login($username, $password) {
        $this->db->select('*');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        
        $user = $this->db->get($this->table);
        
        if($user->num_rows() > 0) {
            return $user;
        } else {
            return FALSE;
        }
    }
}
