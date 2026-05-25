<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller
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
            'Kelas_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Data Kelas';

        $data['kelas'] =
        $this->Kelas_model
        ->get_all();

        $data['jurusan'] =
        $this->Kelas_model
        ->get_jurusan();

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
            'admin/kelas/index',
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

            'nama_kelas' =>
            $this->input->post(
                'nama_kelas'
            ),

            'tingkat' =>
            $this->input->post(
                'tingkat'
            ),

            'id_jurusan' =>
            $this->input->post(
                'id_jurusan'
            ),

            'status' =>
            $this->input->post(
                'status'
            )
        ];

        $this->Kelas_model
            ->insert($data);

        redirect('admin/kelas');
    }

    public function update()
    {
        $id =
        $this->input->post(
            'id_kelas'
        );

        $data = [

            'nama_kelas' =>
            $this->input->post(
                'nama_kelas'
            ),

            'tingkat' =>
            $this->input->post(
                'tingkat'
            ),

            'id_jurusan' =>
            $this->input->post(
                'id_jurusan'
            ),

            'status' =>
            $this->input->post(
                'status'
            )
        ];

        $this->Kelas_model
            ->update(
                $id,
                $data
            );

        redirect('admin/kelas');
    }

    public function delete($id)
    {
        $this->Kelas_model
            ->delete($id);

        redirect('admin/kelas');
    }
}