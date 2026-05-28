<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_voting extends CI_Controller
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

        $this->load->model(
            'Pengaturan_voting_model'
        );
    }

    public function index()
{
    $this->Pengaturan_voting_model
    ->auto_close_voting();

    $data['title'] =
    'Pengaturan Voting';

    $data['pengaturan'] =
    $this->Pengaturan_voting_model
    ->get_data();

    $data['tahun'] =
    $this->Pengaturan_voting_model
    ->get_tahun();

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
        'admin/pengaturan_voting/index',
        $data
    );

    $this->load->view(
        'admin/template/footer'
    );

    $this->load->view(
        'admin/template/script'
    );
}

    public function save()
{
    $tanggal_mulai =
    date(
        'Y-m-d',
        strtotime(
            $this->input
            ->post('tanggal_mulai')
        )
    );

    $tanggal_selesai =
    date(
        'Y-m-d',
        strtotime(
            $this->input
            ->post('tanggal_selesai')
        )
    );

    $today =
    date('Y-m-d');

    $status =
    $this->input
    ->post(
        'voting_status'
    );

    // paksa tutup jika sudah lewat
    if ($today > $tanggal_selesai)
    {
        $status =
        'tutup';
    }

    $data = [

        'id_tahun' =>
        $this->input
        ->post(
            'id_tahun'
        ),

        'voting_status' =>
        $status,

        'tanggal_mulai' =>
        $tanggal_mulai,

        'tanggal_selesai' =>
        $tanggal_selesai,

        'keterangan' =>
        $this->input
        ->post(
            'keterangan'
        )
    ];

    $this->Pengaturan_voting_model
    ->update($data);

    $this->session
    ->set_flashdata(
        'success',
        'Pengaturan voting berhasil disimpan'
    );

    redirect(
        'admin/pengaturan-voting'
    );
}
}