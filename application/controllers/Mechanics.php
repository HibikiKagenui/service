<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 24-Jun-18
 * Time: 6:17 PM
 */

class Mechanics extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mechanic');
    }

    function performance()
    {
        if ($this->session->userdata('isLoggedIn')) {
            $id = $this->input->get('id');
            $year = $this->input->get('year');
            if ($id != null && $year != null) {
                $data['id'] = $id;
                $data['year'] = $year;
                $dataset = $this->mechanic->get_performance($id, $year);

                foreach ($dataset as $row) {
                    $bulan[] = $row->bulan;
                    $jumlah[] = $row->jumlah;
                }
                $data['bulan'] = $bulan;
                $data['jumlah'] = $jumlah;

                $this->load->view('template/header');
                $this->load->view('template/sidebar');
                $this->load->view('mechanic_performance', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect(site_url());
        }
    }
}