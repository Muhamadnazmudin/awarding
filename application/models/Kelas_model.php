<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    private $table = 'kelas';

    public function get_all()
    {
        return $this->db
            ->select('kelas.*, jurusan.nama_jurusan')
            ->from('kelas')
            ->join(
                'jurusan',
                'jurusan.id_jurusan = kelas.id_jurusan',
                'left'
            )
            ->order_by(
                'kelas.id_kelas',
                'ASC'
            )
            ->get()
            ->result();
    }

    public function get_jurusan()
    {
        return $this->db
            ->get('jurusan')
            ->result();
    }

    public function insert($data)
    {
        return $this->db
            ->insert(
                $this->table,
                $data
            );
    }

    public function update($id, $data)
    {
        return $this->db
            ->where(
                'id_kelas',
                $id
            )
            ->update(
                $this->table,
                $data
            );
    }

    public function delete($id)
    {
        return $this->db
            ->where(
                'id_kelas',
                $id
            )
            ->delete(
                $this->table
            );
    }
}