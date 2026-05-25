<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model');
        $this->load->library('session');
    }

    public function index()
    {
        // kalau sudah login
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }

        $this->load->view('auth/login');
    }

    public function login()
{
    $username =
    $this->input
    ->post(
        'username'
    );

    $password =
    $this->input
    ->post(
        'password'
    );

    // ==================
    // CEK ADMIN
    // ==================

    $admin =
    $this->Auth_model
    ->cek_admin(
        $username
    );

    if($admin)
    {
        if(
            password_verify(
                $password,
                $admin->password
            )
        )
        {
            $session = [

                'id_user' =>
                $admin->id_user,

                'nama' =>
                $admin->nama,

                'username' =>
                $admin->username,

                'role' =>
                'admin',

                'logged_in' =>
                true
            ];

            $this->session
            ->set_userdata(
                $session
            );

            redirect(
                'admin/dashboard'
            );
        }
    }

    // ==================
    // CEK SISWA
    // ==================

    $siswa =
    $this->Auth_model
    ->cek_siswa(
        $username
    );

    if($siswa)
    {
        if(
            password_verify(
                $password,
                $siswa->password
            )
        )
        {
            $session = [

                'id_siswa' =>
                $siswa
                ->id_siswa,

                'nama_siswa' =>
                $siswa
                ->nama_siswa,

                'nisn' =>
                $siswa
                ->nisn,

                'id_jurusan' =>
                $siswa
                ->id_jurusan,

                'id_kelas' =>
                $siswa
                ->id_kelas,

                'siswa_login'
                => true
            ];

            $this->session
            ->set_userdata(
                $session
            );

            redirect(
                'siswa/dashboard'
            );
        }
    }

    $this->session
    ->set_flashdata(
        'error',
        'Username atau password salah'
    );

    redirect('auth');
}
    public function logout()
    {
        $this->session->sess_destroy();

        redirect('auth');
    }
}