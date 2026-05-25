<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_voting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(
            !$this->session
            ->userdata(
                'logged_in'
            )
        )
        {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] =
        'Hasil Voting';

        $data['kriteria'] =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->get(
            'kriteria_penghargaan'
        )
        ->result();

        $this->load->view(
            'admin/template/header',
            $data
        );

        $this->load->view(
            'admin/template/sidebar'
        );

        $this->load->view(
            'admin/template/topbar'
        );

        $this->load->view(
            'admin/hasil_voting/index',
            $data
        );

        $this->load->view(
            'admin/template/footer'
        );

        $this->load->view(
            'admin/template/script'
        );
    }
}