<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voting extends CI_Controller
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

        // cek pengaturan voting
        $pengaturan =
        $this->db
        ->get(
            'pengaturan_voting'
        )
        ->row();

        // jika voting ditutup
        if(
            !$pengaturan
            ||
            $pengaturan
            ->voting_status
            != 'buka'
        )
        {
            $this->session
            ->set_flashdata(
                'error',
                'Voting belum dibuka'
            );

            redirect(
                'siswa/dashboard'
            );
        }

        // data siswa
        $siswa =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->get('siswa')
        ->row();

        $data['title'] =
        'Voting Guru';

        $data['pengaturan'] =
        $pengaturan;

        // filter kriteria
        $this->db
        ->where(
            'status',
            'aktif'
        );

        $this->db
        ->group_start();

        // guru umum
        $this->db
        ->where(
            'tipe_guru',
            'umum'
        );

        // semua guru
        $this->db
        ->or_where(
            'tipe_guru',
            'semua'
        );

        // guru jurusan siswa
        $this->db
        ->or_group_start();

        $this->db
        ->where(
            'tipe_guru',
            'jurusan'
        );

        $this->db
        ->where(
            'id_jurusan',
            $siswa
            ->id_jurusan
        );

        $this->db
        ->group_end();

        $this->db
        ->group_end();

        $data['kriteria'] =
        $this->db
        ->get(
            'kriteria_penghargaan'
        )
        ->result();

        // voting siswa
        $data['voted'] =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->get(
            'voting'
        )
        ->result_array();

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
            'siswa/voting/index',
            $data
        );

        $this->load->view(
            'siswa/template/footer'
        );

        $this->load->view(
            'siswa/template/script'
        );
    }


    public function detail($id_kriteria)
    {
        // cek voting buka/tutup
        $pengaturan =
        $this->db
        ->get(
            'pengaturan_voting'
        )
        ->row();

        if(
            !$pengaturan
            ||
            $pengaturan
            ->voting_status
            != 'buka'
        )
        {
            $this->session
            ->set_flashdata(
                'error',
                'Voting belum dibuka'
            );

            redirect(
                'siswa/dashboard'
            );
        }

        $id_siswa =
        $this->session
        ->userdata(
            'id_siswa'
        );

        // data siswa
        $siswa =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->get('siswa')
        ->row();

        // data kriteria
        $kriteria =
        $this->db
        ->where(
            'id_kriteria',
            $id_kriteria
        )
        ->get(
            'kriteria_penghargaan'
        )
        ->row();

        if(!$kriteria)
        {
            redirect(
                'siswa/voting'
            );
        }

        // pastikan siswa hanya bisa akses kriteria miliknya
        $boleh = false;

        if(
            $kriteria
            ->tipe_guru
            == 'umum'
            ||
            $kriteria
            ->tipe_guru
            == 'semua'
        )
        {
            $boleh = true;
        }

        if(
            $kriteria
            ->tipe_guru
            == 'jurusan'
            &&
            $kriteria
            ->id_jurusan
            == $siswa
            ->id_jurusan
        )
        {
            $boleh = true;
        }

        if(!$boleh)
        {
            redirect(
                'siswa/voting'
            );
        }

        // cek sudah voting
        $cek =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->where(
            'id_kriteria',
            $id_kriteria
        )
        ->get(
            'voting'
        )
        ->row();

        if($cek)
        {
            redirect(
                'siswa/voting'
            );
        }

        // filter guru
        $this->db
        ->where(
            'status',
            'aktif'
        );

        // guru jurusan
        if(
            $kriteria
            ->tipe_guru
            == 'jurusan'
        )
        {
            $this->db
            ->where(
                'tipe_guru',
                'jurusan'
            );

            $this->db
            ->where(
                'id_jurusan',
                $kriteria
                ->id_jurusan
            );
        }

        // guru umum
        elseif(
            $kriteria
            ->tipe_guru
            == 'umum'
        )
        {
            $this->db
            ->where(
                'tipe_guru',
                'umum'
            );

            if(
                !empty(
                    $kriteria
                    ->jk
                )
            )
            {
                $this->db
                ->where(
                    'jk',
                    $kriteria
                    ->jk
                );
            }
        }

        // semua guru
        else
        {
            if(
                !empty(
                    $kriteria
                    ->jk
                )
            )
            {
                $this->db
                ->where(
                    'jk',
                    $kriteria
                    ->jk
                );
            }
        }

        $data['guru'] =
        $this->db
        ->get('guru')
        ->result();

        $data['title'] =
        'Pilih Guru';

        $data['kriteria'] =
        $kriteria;

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
            'siswa/voting/detail',
            $data
        );

        $this->load->view(
            'siswa/template/footer'
        );

        $this->load->view(
            'siswa/template/script'
        );
    }


    public function store()
    {
        // proteksi voting ditutup
        $pengaturan =
        $this->db
        ->get(
            'pengaturan_voting'
        )
        ->row();

        if(
            !$pengaturan
            ||
            $pengaturan
            ->voting_status
            != 'buka'
        )
        {
            redirect(
                'siswa/dashboard'
            );
        }

        $id_siswa =
        $this->session
        ->userdata(
            'id_siswa'
        );

        $id_kriteria =
        $this->input
        ->post(
            'id_kriteria'
        );

        // anti duplicate vote
        $cek =
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->where(
            'id_kriteria',
            $id_kriteria
        )
        ->get(
            'voting'
        )
        ->row();

        if($cek)
        {
            redirect(
                'siswa/voting'
            );
        }

        $data = [

            'id_siswa' =>
            $id_siswa,

            'id_kriteria' =>
            $id_kriteria,

            'id_guru' =>
            $this->input
            ->post(
                'id_guru'
            )
        ];

        $this->db
        ->insert(
            'voting',
            $data
        );

        redirect(
            'siswa/voting'
        );
    }
}