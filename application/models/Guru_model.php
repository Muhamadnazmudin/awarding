<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function get_all()
    {
        return $this->db
            ->select('guru.*, jurusan.nama_jurusan')
            ->from('guru')
            ->join(
                'jurusan',
                'jurusan.id_jurusan = guru.id_jurusan',
                'left'
            )
            ->order_by(
                'guru.id_guru',
                'DESC'
            )
            ->get()
            ->result();
    }

    public function get_jurusan()
    {
        return $this->db
            ->where('status','aktif')
            ->get('jurusan')
            ->result();
    }

    public function get_mapel()
    {
        return $this->db
            ->where('status','aktif')
            ->get('mapel')
            ->result();
    }

    public function insert($data)
    {
        $this->db->insert(
            'guru',
            $data
        );

        return $this->db
            ->insert_id();
    }

    public function insert_mapel(
        $id_guru,
        $mapel
    )
    {
        foreach($mapel as $m)
        {
            $this->db->insert(
                'guru_mapel',
                [
                    'id_guru' => $id_guru,
                    'id_mapel' => $m
                ]
            );
        }
    }

    public function delete_mapel(
        $id_guru
    )
    {
        return $this->db
            ->where(
                'id_guru',
                $id_guru
            )
            ->delete(
                'guru_mapel'
            );
    }

    public function update(
        $id,
        $data
    )
    {
        return $this->db
            ->where(
                'id_guru',
                $id
            )
            ->update(
                'guru',
                $data
            );
    }

    public function delete($id)
    {
        $this->db
            ->where(
                'id_guru',
                $id
            )
            ->delete(
                'guru_mapel'
            );

        return $this->db
            ->where(
                'id_guru',
                $id
            )
            ->delete(
                'guru'
            );
    }
}