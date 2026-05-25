<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun extends CI_Controller
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
            'Tahun_model'
        );
    }

    public function index()
    {
        $data['title'] =
        'Tahun Pelajaran';

        $data['tahun'] =
        $this->Tahun_model
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
            'admin/tahun/index',
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
    if(
        $this->input
        ->post('status')
        == 'aktif'
    )
    {
        $this->db
        ->update(
            'tahun_pelajaran',
            [
                'status' =>
                'nonaktif'
            ]
        );
    }

    $data = [

        'tahun_pelajaran' =>
        $this->input
        ->post(
            'tahun_pelajaran'
        ),

        'status' =>
        $this->input
        ->post(
            'status'
        )
    ];

    $this->db
    ->insert(
        'tahun_pelajaran',
        $data
    );

    redirect(
        'admin/tahun'
    );
}

    public function update()
{
    $id =
    $this->input
    ->post(
        'id_tahun'
    );

    if(
        $this->input
        ->post('status')
        == 'aktif'
    )
    {
        $this->db
        ->update(
            'tahun_pelajaran',
            [
                'status' =>
                'nonaktif'
            ]
        );
    }

    $data = [

        'tahun_pelajaran' =>
        $this->input
        ->post(
            'tahun_pelajaran'
        ),

        'status' =>
        $this->input
        ->post(
            'status'
        )
    ];

    $this->db
    ->where(
        'id_tahun',
        $id
    )
    ->update(
        'tahun_pelajaran',
        $data
    );

    redirect(
        'admin/tahun'
    );
}
    public function delete($id)
    {
        $this->db
        ->where(
            'id_tahun',
            $id
        )
        ->delete(
            'tahun_pelajaran'
        );

        redirect(
            'admin/tahun'
        );
    }
}