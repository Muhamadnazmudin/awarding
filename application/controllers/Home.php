<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['title'] =
        'Awarding Guru Terfavorit';

        // pengaturan voting
        $data['pengaturan'] =
        $this->db
        ->get(
            'pengaturan_voting'
        )
        ->row();

        // tahun aktif
        $data['tahun'] =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->get(
            'tahun_pelajaran'
        )
        ->row();

        $this->load->view(
            'home/index',
            $data
        );
    }
}