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
        $data = [

            'id_tahun' =>
            $this->input
            ->post(
                'id_tahun'
            ),

            'voting_status' =>
            $this->input
            ->post(
                'voting_status'
            ),

            'tanggal_mulai' =>
            $this->input
            ->post(
                'tanggal_mulai'
            ),

            'tanggal_selesai' =>
            $this->input
            ->post(
                'tanggal_selesai'
            ),

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