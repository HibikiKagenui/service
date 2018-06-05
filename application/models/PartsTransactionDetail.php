<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PartsTransactionDetail extends CI_Model
{
    var $table;
    function __construct() {
        parent::__construct();
        $this->table = 'parts_transaction_details';
    }
}
