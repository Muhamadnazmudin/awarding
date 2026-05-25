<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
            'Jurusan_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Data Jurusan';

        $data['jurusan'] =
        $this->Jurusan_model
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
            'admin/jurusan/index',
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
            'kode_jurusan' =>
            $this->input->post(
                'kode_jurusan'
            ),

            'nama_jurusan' =>
            $this->input->post(
                'nama_jurusan'
            ),

            'status' =>
            $this->input->post(
                'status'
            )
        ];

        $this->Jurusan_model
            ->insert($data);

        redirect(
            'admin/jurusan'
        );
    }

    public function update()
    {
        $id =
        $this->input->post(
            'id_jurusan'
        );

        $data = [

            'kode_jurusan' =>
            $this->input->post(
                'kode_jurusan'
            ),

            'nama_jurusan' =>
            $this->input->post(
                'nama_jurusan'
            ),

            'status' =>
            $this->input->post(
                'status'
            )
        ];

        $this->Jurusan_model
            ->update(
                $id,
                $data
            );

        redirect(
            'admin/jurusan'
        );
    }

    public function delete($id)
    {
        $this->Jurusan_model
            ->delete($id);

        redirect(
            'admin/jurusan'
        );
    }
}