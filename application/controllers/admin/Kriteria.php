<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller
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
            'Kriteria_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Kriteria Penghargaan';

        $data['kriteria'] =
        $this->Kriteria_model
        ->get_all();

        $data['jurusan'] =
        $this->Kriteria_model
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
            'admin/kriteria/index',
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
        $id_jurusan = NULL;

        if(
            $this->input
            ->post(
                'tipe_guru'
            )
            == 'jurusan'
        )
        {
            $id_jurusan =
            $this->input
            ->post(
                'id_jurusan'
            );
        }

        $data = [

            'nama_kriteria' =>
            $this->input
            ->post(
                'nama_kriteria'
            ),

            'tipe_guru' =>
            $this->input
            ->post(
                'tipe_guru'
            ),

            'id_jurusan' =>
            $id_jurusan,

            'jk' =>
            $this->input
            ->post('jk'),

            'status' =>
            $this->input
            ->post(
                'status'
            )
        ];

        $this->Kriteria_model
        ->insert($data);

        redirect(
            'admin/kriteria'
        );
    }

    public function update()
    {
        $id =
        $this->input
        ->post(
            'id_kriteria'
        );

        $id_jurusan = NULL;

        if(
            $this->input
            ->post(
                'tipe_guru'
            )
            == 'jurusan'
        )
        {
            $id_jurusan =
            $this->input
            ->post(
                'id_jurusan'
            );
        }

        $data = [

            'nama_kriteria' =>
            $this->input
            ->post(
                'nama_kriteria'
            ),

            'tipe_guru' =>
            $this->input
            ->post(
                'tipe_guru'
            ),

            'id_jurusan' =>
            $id_jurusan,

            'jk' =>
            $this->input
            ->post('jk'),

            'status' =>
            $this->input
            ->post(
                'status'
            )
        ];

        $this->Kriteria_model
        ->update(
            $id,
            $data
        );

        redirect(
            'admin/kriteria'
        );
    }

    public function delete($id)
    {
        $this->Kriteria_model
        ->delete($id);

        redirect(
            'admin/kriteria'
        );
    }
}