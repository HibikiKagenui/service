<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 8:32 PM
 */

class Laporan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_master($month, $year)
    {
        $data = $this->db->query("
            SELECT a.*, ifnull(b.subtotal_pembelian,0) AS subtotal_pembelian, ifnull(c.subtotal_servis,0) AS subtotal_servis FROM 
            (
                SELECT transactions.id, transactions.xid_customer AS id_pelanggan, customers.nama AS nama_pelanggan, transactions.hanya_pembelian, transactions.waktu_selesai, transactions.total, transactions.dibayar
                FROM transactions, customers
                WHERE transactions.xid_customer = customers.id 
                AND month(transactions.waktu_selesai) = '" . $month . "' 
                AND year(transactions.waktu_selesai) = '" . $year . "'
            ) AS a
            LEFT JOIN
            (
              SELECT xid_transaction, sum(harga) AS subtotal_pembelian FROM parts_transaction_details GROUP BY xid_transaction
            ) AS b ON a.id = b.xid_transaction
            LEFT JOIN
            (
              SELECT xid_transaction, sum(biaya) AS subtotal_servis FROM service_transaction_details GROUP BY xid_transaction
            ) AS c ON a.id = c.xid_transaction
        ");

        if ($data != null) {
            return $data->result();
        } else {
            return null;
        }
    }

    function get_part_details($month, $year)
    {
        $this->db->select('parts_transaction_details.*');
        $this->db->select('parts.nama');
        $this->db->from('parts_transaction_details, transactions, parts');
        $this->db->where('parts_transaction_details.xid_transaction', 'transactions.id', false);
        $this->db->where('parts_transaction_details.xid_part', 'parts.id', false);
        $this->db->where('month(transactions.waktu_selesai)', $month);
        $this->db->where('year(transactions.waktu_selesai)', $year);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }

    function get_service_details($month, $year)
    {
        $this->db->select('service_transaction_details.*');
        $this->db->select('services.nama as nama_servis');
        $this->db->select('mechanics.nama as nama_mekanik');
        $this->db->from('service_transaction_details, transactions, services, mechanics');
        $this->db->where('service_transaction_details.xid_transaction', 'transactions.id', false);
        $this->db->where('service_transaction_details.xid_service', 'services.id', false);
        $this->db->where('service_transaction_details.xid_mechanic', 'mechanics.id', false);
        $this->db->where('month(transactions.waktu_selesai)', $month);
        $this->db->where('year(transactions.waktu_selesai)', $year);
        $data = $this->db->get();

        if ($data->num_rows() > 0) {
            return $data->result();
        } else {
            return null;
        }
    }
}