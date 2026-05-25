<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function get_all()
    {
        return $this->db
            ->select('
                siswa.*,
                jurusan.nama_jurusan,
                kelas.nama_kelas
            ')
            ->from('siswa')
            ->join(
                'jurusan',
                'jurusan.id_jurusan =
                siswa.id_jurusan',
                'left'
            )
            ->join(
                'kelas',
                'kelas.id_kelas =
                siswa.id_kelas',
                'left'
            )
            ->order_by(
                'id_siswa',
                'DESC'
            )
            ->get()
            ->result();
    }

    public function get_jurusan()
    {
        return $this->db
            ->where(
                'status',
                'aktif'
            )
            ->get('jurusan')
            ->result();
    }

    public function get_kelas()
    {
        return $this->db
            ->where(
                'status',
                'aktif'
            )
            ->get('kelas')
            ->result();
    }

    public function insert($data)
    {
        return $this->db
            ->insert(
                'siswa',
                $data
            );
    }

    public function update(
        $id,
        $data
    )
    {
        return $this->db
            ->where(
                'id_siswa',
                $id
            )
            ->update(
                'siswa',
                $data
            );
    }

    public function delete($id)
    {
        return $this->db
            ->where(
                'id_siswa',
                $id
            )
            ->delete(
                'siswa'
            );
    }
}