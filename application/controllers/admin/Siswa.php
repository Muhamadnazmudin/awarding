<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (
            !$this->session
            ->userdata('logged_in')
        )
        {
            redirect('auth');
        }

        $this->load->model(
            'Siswa_model'
        );

        $this->load->library(
            'upload'
        );
    }

    public function index()
    {
        $data['title'] =
        'Data Siswa';

        $data['siswa'] =
        $this->Siswa_model
        ->get_all();

        $data['jurusan'] =
        $this->Siswa_model
        ->get_jurusan();

        $data['kelas'] =
        $this->Siswa_model
        ->get_kelas();

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
            'admin/siswa/index',
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
    $foto = 'default.png';

    // upload foto
    if(
        !empty(
            $_FILES['foto']['name']
        )
    )
    {
        $config['upload_path'] =
        './uploads/siswa/';

        $config['allowed_types'] =
        'jpg|jpeg|png';

        $config['encrypt_name'] =
        TRUE;

        $this->upload
        ->initialize($config);

        if(
            $this->upload
            ->do_upload('foto')
        )
        {
            $upload =
            $this->upload
            ->data();

            $foto =
            $upload['file_name'];
        }
    }

    // ambil nisn dulu
    $nisn =
    $this->input
    ->post('nisn');

    // cek duplicate nisn
    $cek_nisn =
    $this->db
    ->where(
        'nisn',
        $nisn
    )
    ->get('siswa')
    ->row();

    if($cek_nisn)
    {
        $this->session
        ->set_flashdata(
            'error',
            'NISN sudah terdaftar'
        );

        redirect(
            'admin/siswa'
        );
    }

    $data = [

        'nis' =>
        $this->input
        ->post('nis'),

        'nisn' =>
        $nisn,

        'nik' =>
        $this->input
        ->post('nik'),

        'nama_siswa' =>
        $this->input
        ->post(
            'nama_siswa'
        ),

        'jk' =>
        $this->input
        ->post('jk'),

        'id_jurusan' =>
        $this->input
        ->post(
            'id_jurusan'
        ),

        'id_kelas' =>
        $this->input
        ->post(
            'id_kelas'
        ),

        'username' =>
        $nisn,

        'password' =>
        password_hash(
            $nisn,
            PASSWORD_DEFAULT
        ),

        'foto' =>
        $foto,

        'status' =>
        $this->input
        ->post(
            'status'
        )
    ];

    $this->Siswa_model
        ->insert($data);

    $this->session
    ->set_flashdata(
        'success',
        'Siswa berhasil ditambahkan'
    );

    redirect(
        'admin/siswa'
    );
}
    public function delete($id)
    {
        $this->Siswa_model
            ->delete($id);

        redirect(
            'admin/siswa'
        );
    }
    public function reset_password($id)
{
    $siswa = $this->db
        ->where(
            'id_siswa',
            $id
        )
        ->get('siswa')
        ->row();

    $password =
    password_hash(
        $siswa->nisn,
        PASSWORD_DEFAULT
    );

    $this->db
        ->where(
            'id_siswa',
            $id
        )
        ->update(
            'siswa',
            [
                'password' =>
                $password
            ]
        );

    redirect('admin/siswa');
}
}