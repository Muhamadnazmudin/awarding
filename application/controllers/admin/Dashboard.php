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

    // total siswa aktif
    $data['total_siswa'] =
    $this->db
    ->where(
        'status',
        'aktif'
    )
    ->count_all_results(
        'siswa'
    );

    // total kategori aktif
    $data['total_kriteria'] =
    $this->db
    ->where(
        'status',
        'aktif'
    )
    ->count_all_results(
        'kriteria_penghargaan'
    );

    // ambil siswa aktif
    $siswa =
    $this->db
    ->where(
        'status',
        'aktif'
    )
    ->get('siswa')
    ->result();

    $sudah = 0;
    $belum = 0;
    $progress_total = 0;

    foreach($siswa as $s)
    {
        // hitung jatah kriteria siswa
        $jatah =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->group_start()
            ->where(
                'tipe_guru',
                'umum'
            )
            ->or_where(
                'tipe_guru',
                'semua'
            )
            ->or_group_start()
                ->where(
                    'tipe_guru',
                    'jurusan'
                )
                ->where(
                    'id_jurusan',
                    $s->id_jurusan
                )
            ->group_end()
        ->group_end()
        ->count_all_results(
            'kriteria_penghargaan'
        );

        // vote siswa
        $vote =
        $this->db
        ->where(
            'id_siswa',
            $s->id_siswa
        )
        ->count_all_results(
            'voting'
        );

        $progress_total += $vote;

        // selesai semua
        if(
            $vote >= $jatah
            &&
            $jatah > 0
        )
        {
            $sudah++;
        }
        else
        {
            $belum++;
        }
    }

    $data['sudah_voting'] =
    $sudah;

    $data['belum_voting'] =
    $belum;

    // progress %
    $maksimal_vote =
    array_sum(
        array_map(
            function($s){

                $CI =& get_instance();

                return $CI->db
                ->where(
                    'status',
                    'aktif'
                )
                ->group_start()
                    ->where(
                        'tipe_guru',
                        'umum'
                    )
                    ->or_where(
                        'tipe_guru',
                        'semua'
                    )
                    ->or_group_start()
                        ->where(
                            'tipe_guru',
                            'jurusan'
                        )
                        ->where(
                            'id_jurusan',
                            $s->id_jurusan
                        )
                    ->group_end()
                ->group_end()
                ->count_all_results(
                    'kriteria_penghargaan'
                );

            },
            $siswa
        )
    );

    $data['progress'] =
    $maksimal_vote > 0
    ?
    round(
        (
            $progress_total
            /
            $maksimal_vote
        ) * 100
    )
    :
    0;

    // leaderboard
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