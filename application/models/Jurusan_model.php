<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_model extends CI_Model
{
    private $table = 'jurusan';

    public function get_all()
    {
        return $this->db
            ->order_by(
                'id_jurusan',
                'DESC'
            )
            ->get($this->table)
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where(
                'id_jurusan',
                $id
            )
            ->get($this->table)
            ->row();
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
                'id_jurusan',
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
                'id_jurusan',
                $id
            )
            ->delete(
                $this->table
            );
    }
}