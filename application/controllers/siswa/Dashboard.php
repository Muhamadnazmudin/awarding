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
                'siswa_login'
            )
        )
        {
            redirect('auth');
        }
    }

    public function index()
    {
        $id_siswa =
        $this->session
        ->userdata(
            'id_siswa'
        );

        $data['title'] =
        'Dashboard Siswa';

        // data siswa
        $data['siswa'] =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->get('siswa')
        ->row();

        // pengaturan voting
        $data['pengaturan'] =
        $this->db
        ->get(
            'pengaturan_voting'
        )
        ->row();

        // total kategori sesuai jurusan siswa
        $data['total_kriteria'] =
        $this->db
        ->group_start()

            ->where(
                'tipe_guru',
                'umum'
            )

            ->or_group_start()

                ->where(
                    'tipe_guru',
                    'jurusan'
                )

                ->where(
                    'id_jurusan',
                    $data['siswa']
                    ->id_jurusan
                )

            ->group_end()

        ->group_end()

        ->where(
            'status',
            'aktif'
        )

        ->count_all_results(
            'kriteria_penghargaan'
        );

        // progress voting siswa
        $jumlah_vote =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->count_all_results(
            'voting'
        );

        $data['jumlah_vote'] =
        $jumlah_vote;

        $data['status_vote'] =
        (
            $jumlah_vote >=
            $data['total_kriteria']
            &&
            $data['total_kriteria']
            > 0
        )
        ?
        'Selesai'
        :
        'Belum';

        $this->load->view(
            'siswa/template/header',
            $data
        );

        $this->load->view(
            'siswa/template/sidebar'
        );

        $this->load->view(
            'siswa/template/topbar'
        );

        $this->load->view(
            'siswa/dashboard',
            $data
        );

        $this->load->view(
            'siswa/template/footer'
        );

        $this->load->view(
            'siswa/template/script'
        );
    }
}