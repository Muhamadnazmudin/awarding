<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        'Dashboard Admin';

        // total siswa
        $data['total_siswa'] =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->count_all_results(
            'siswa'
        );

        // total guru
        $data['total_guru'] =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->count_all_results(
            'guru'
        );

        // total kategori
        $data['total_kriteria'] =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->count_all_results(
            'kriteria_penghargaan'
        );

        // siswa sudah voting
        $data['sudah_voting'] =
        $this->db
        ->distinct()
        ->select(
            'id_siswa'
        )
        ->get('voting')
        ->num_rows();

        // belum voting
        $data['belum_voting'] =
        $data['total_siswa']
        -
        $data['sudah_voting'];

        // progress %
        $data['progress'] =

        $data['total_siswa']
        > 0

        ?

        round(

            (
                $data['sudah_voting']
                /
                $data['total_siswa']
            ) * 100

        )

        :

        0;

        // leader sementara
        $data['leader'] =
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
            'admin/dashboard/index',
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