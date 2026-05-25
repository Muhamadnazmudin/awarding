<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (
            !$this->session
            ->userdata('logged_in')
        ) {
            redirect('auth');
        }

        $this->load->model(
            'Mapel_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Data Mata Pelajaran';

        $data['mapel'] =
        $this->Mapel_model
        ->get_all();

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
            'admin/mapel/index',
            $data
        );

        $this->load->view(
            'admin/template/footer'
        );

        $this->load->view(
            'admin/template/script'
        );
    }

    public function store()
    {
        $data = [

            'nama_mapel' =>
            $this->input->post(
                'nama_mapel'
            ),

            'status' =>
            $this->input->post(
                'status'
            )
        ];

        $this->Mapel_model
            ->insert($data);

        redirect('admin/mapel');
    }

    public function update()
    {
        $id =
        $this->input->post(
            'id_mapel'
        );

        $data = [

            'nama_mapel' =>
            $this->input->post(
                'nama_mapel'
            ),

            'status' =>
            $this->input->post(
                'status'
            )
        ];

        $this->Mapel_model
            ->update(
                $id,
                $data
            );

        redirect('admin/mapel');
    }

    public function delete($id)
    {
        $this->Mapel_model
            ->delete($id);

        redirect('admin/mapel');
    }
}