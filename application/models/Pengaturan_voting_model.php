<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_voting_model extends CI_Model
{
    public function get_data()
    {
        return $this->db
            ->select('
                pengaturan_voting.*,
                tahun_pelajaran.tahun_pelajaran
            ')
            ->from(
                'pengaturan_voting'
            )
            ->join(
                'tahun_pelajaran',
                'tahun_pelajaran.id_tahun =
                pengaturan_voting.id_tahun',
                'left'
            )
            ->get()
            ->row();
    }

    public function get_tahun()
    {
        return $this->db
            ->where(
                'status',
                'aktif'
            )
            ->get(
                'tahun_pelajaran'
            )
            ->result();
    }

    public function update($data)
    {
        $cek =
        $this->db
        ->get(
            'pengaturan_voting'
        )
        ->row();

        if($cek)
        {
            return $this->db
                ->update(
                    'pengaturan_voting',
                    $data
                );
        }
        else
        {
            return $this->db
                ->insert(
                    'pengaturan_voting',
                    $data
                );
        }
    }
    public function auto_close_voting()
{
    $pengaturan =
    $this->get_data();

    if (!$pengaturan)
    {
        return;
    }

    $today =
    date('Y-m-d');

    $tanggal_mulai =
    date(
        'Y-m-d',
        strtotime(
            $pengaturan
            ->tanggal_mulai
        )
    );

    $tanggal_selesai =
    date(
        'Y-m-d',
        strtotime(
            $pengaturan
            ->tanggal_selesai
        )
    );

    // sebelum tanggal mulai = tutup
    if ($today < $tanggal_mulai)
    {
        $this->db
        ->update(
            'pengaturan_voting',
            [
                'voting_status' =>
                'tutup'
            ]
        );

        return;
    }

    // lewat tanggal selesai = tutup
    if ($today > $tanggal_selesai)
    {
        $this->db
        ->update(
            'pengaturan_voting',
            [
                'voting_status' =>
                'tutup'
            ]
        );

        return;
    }
}
}