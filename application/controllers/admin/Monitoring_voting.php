<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_voting extends CI_Controller
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
        'Monitoring Voting';

        $total_kriteria =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->count_all_results(
            'kriteria_penghargaan'
        );

        $data['total_kriteria'] =
        $total_kriteria;

        $data['siswa'] =
        $this->db
        ->select('
            siswa.*,
            jurusan.nama_jurusan,
            kelas.nama_kelas
        ')
        ->from('siswa')
        ->join(
            'jurusan',
            'jurusan.id_jurusan =
            siswa.id_jurusan',
            'left'
        )
        ->join(
            'kelas',
            'kelas.id_kelas =
            siswa.id_kelas',
            'left'
        )
        ->where(
            'siswa.status',
            'aktif'
        )
        ->order_by(
            'nama_siswa',
            'ASC'
        )
        ->get()
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
            'admin/monitoring_voting/index',
            $data
        );

        $this->load->view(
            'admin/template/footer'
        );

        $this->load->view(
            'admin/template/script'
        );
    }


    public function reset($id_siswa)
    {
        $this->db
        ->where(
            'id_siswa',
            $id_siswa
        )
        ->delete(
            'voting'
        );

        $this->session
        ->set_flashdata(
            'success',
            'Voting siswa berhasil direset'
        );

        redirect(
            'admin/monitoring-voting'
        );
    }


    public function reset_all()
    {
        $this->db
        ->truncate(
            'voting'
        );

        $this->session
        ->set_flashdata(
            'success',
            'Semua voting berhasil direset'
        );

        redirect(
            'admin/monitoring-voting'
        );
    }
}