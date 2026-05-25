<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function cek_admin(
        $username
    )
    {
        return $this->db
            ->where(
                'username',
                $username
            )
            ->get('users')
            ->row();
    }

    public function cek_siswa(
        $username
    )
    {
        return $this->db
            ->where(
                'username',
                $username
            )
            ->where(
                'status',
                'aktif'
            )
            ->get('siswa')
            ->row();
    }
}