<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic extends CI_Model
{
    var $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'mechanics';
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

    function update($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function inc_jumlah_servis($id)
    {
        $this->db->set('jumlah_servis', 'jumlah_servis + 1', false);
        $this->db->where('id', $id);
        if ($this->db->update($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    function dec_jumlah_servis($id)
    {
        $this->db->set('jumlah_servis', 'jumlah_servis - 1', false);
        $this->db->where('id', $id);
        if ($this->db->update($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    function get_performance($id, $year)
    {
        $data = $this->db->query(
            "SELECT a.bulan as bulan, IFNULL(b.jumlah,0) as jumlah
                FROM (
                        SELECT 'January' bulan
                            UNION ALL
                            SELECT 'February' bulan
                            UNION ALL
                            SELECT 'March' bulan
                            UNION ALL
                            SELECT 'April' bulan
                            UNION ALL
                            SELECT 'May' bulan
                            UNION ALL
                            SELECT 'June' bulan
                            UNION ALL
                            SELECT 'July' bulan
                            UNION ALL
                            SELECT 'August' bulan
                            UNION ALL
                            SELECT 'September' bulan
                            UNION ALL
                            SELECT 'October' bulan
                            UNION ALL
                            SELECT 'November' bulan
                            UNION ALL
                            SELECT 'December' bulan
                    ) as a
                LEFT JOIN (
                        SELECT MONTHNAME(transactions.waktu_selesai) as bulan, count(service_transaction_details.id) as jumlah
                            FROM mechanics, transactions, service_transaction_details
                            WHERE mechanics.id = '" . $id . "'
                            AND year(transactions.waktu_selesai) = '" . $year . "'
                            AND service_transaction_details.xid_mechanic = mechanics.id
                            AND service_transaction_details.xid_transaction = transactions.id
                            GROUP BY month(transactions.waktu_selesai)
                    )as b
                ON a.bulan = b.bulan"
        );

        if ($data != null) {
            return $data->result();
        } else {
            return null;
        }
    }
}
