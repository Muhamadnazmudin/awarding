<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    public function get_all()
    {
        return $this->db
            ->select('
                kriteria_penghargaan.*,
                jurusan.nama_jurusan
            ')
            ->from(
                'kriteria_penghargaan'
            )
            ->join(
                'jurusan',
                'jurusan.id_jurusan =
                kriteria_penghargaan.id_jurusan',
                'left'
            )
            ->order_by(
                'id_kriteria',
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

    public function insert($data)
    {
        return $this->db
            ->insert(
                'kriteria_penghargaan',
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
                'id_kriteria',
                $id
            )
            ->update(
                'kriteria_penghargaan',
                $data
            );
    }

    public function delete($id)
    {
        return $this->db
            ->where(
                'id_kriteria',
                $id
            )
            ->delete(
                'kriteria_penghargaan'
            );
    }
}