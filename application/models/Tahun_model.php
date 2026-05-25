<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_model extends CI_Model
{
    public function get_all()
    {
        return $this->db
        ->order_by(
            'id_tahun',
            'DESC'
        )
        ->get(
            'tahun_pelajaran'
        )
        ->result();
    }
}