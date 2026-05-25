<?php
defined('BASEPATH')
OR exit('No direct script access allowed');

class User extends CI_Controller
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
        'Management User';

        $data['users'] =
        $this->db
        ->where(
            'role',
            'admin'
        )
        ->order_by(
            'id_user',
            'DESC'
        )
        ->get(
            'users'
        )
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
            'admin/user/index',
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
        $cek =
        $this->db
        ->where(
            'username',
            $this->input
            ->post(
                'username'
            )
        )
        ->get(
            'users'
        )
        ->row();

        if($cek)
        {
            $this->session
            ->set_flashdata(
                'error',
                'Username sudah digunakan'
            );

            redirect(
                'admin/user'
            );
        }

        $data = [

            'nama' =>
            $this->input
            ->post(
                'nama'
            ),

            'username' =>
            $this->input
            ->post(
                'username'
            ),

            'password' =>
            password_hash(
                $this->input
                ->post(
                    'password'
                ),
                PASSWORD_DEFAULT
            ),

            'role' =>
            'admin'
        ];

        $this->db
        ->insert(
            'users',
            $data
        );

        redirect(
            'admin/user'
        );
    }


    public function reset_password($id)
    {
        $password =
        password_hash(
            'admin123',
            PASSWORD_DEFAULT
        );

        $this->db
        ->where(
            'id_user',
            $id
        )
        ->update(
            'users',
            [
                'password' =>
                $password
            ]
        );

        redirect(
            'admin/user'
        );
    }


    public function delete($id)
    {
        // cegah admin utama kehapus
        if($id == 1)
        {
            redirect(
                'admin/user'
            );
        }

        $this->db
        ->where(
            'id_user',
            $id
        )
        ->delete(
            'users'
        );

        redirect(
            'admin/user'
        );
    }
    public function update()
{
    $id =
    $this->input
    ->post(
        'id_user'
    );

    $cek =
    $this->db
    ->where(
        'username',
        $this->input
        ->post(
            'username'
        )
    )
    ->where(
        'id_user !=',
        $id
    )
    ->get(
        'users'
    )
    ->row();

    if($cek)
    {
        $this->session
        ->set_flashdata(
            'error',
            'Username sudah digunakan'
        );

        redirect(
            'admin/user'
        );
    }

    $data = [

        'nama' =>
        $this->input
        ->post(
            'nama'
        ),

        'username' =>
        $this->input
        ->post(
            'username'
        )
    ];

    $this->db
    ->where(
        'id_user',
        $id
    )
    ->update(
        'users',
        $data
    );

    redirect(
        'admin/user'
    );
}
}