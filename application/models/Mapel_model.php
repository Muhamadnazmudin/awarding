<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    private $table = 'mapel';

    public function get_all()
    {
        return $this->db
            ->order_by(
                'id_mapel',
                'DESC'
            )
            ->get($this->table)
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
                'id_mapel',
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
                'id_mapel',
                $id
            )
            ->delete(
                $this->table
            );
    }
}