<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceTransactionDetail extends CI_Model
{
    var $table;
    function __construct() {
        parent::__construct();
        $this->table = 'service_transaction_details';
    }
}
