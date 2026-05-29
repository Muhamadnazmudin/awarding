<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;
class Hasil_voting extends CI_Controller
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
        'Hasil Voting';

        $data['kriteria'] =
        $this->db
        ->where(
            'status',
            'aktif'
        )
        ->get(
            'kriteria_penghargaan'
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
            'admin/hasil_voting/index',
            $data
        );

        $this->load->view(
            'admin/template/footer'
        );

        $this->load->view(
            'admin/template/script'
        );
    }
    public function export_pdf()
{
    $data['kriteria'] =
    $this->db
    ->where(
        'status',
        'aktif'
    )
    ->get(
        'kriteria_penghargaan'
    )
    ->result();

    $html = '

    <style>

    @page{
        margin:25px;
    }

    body{
        font-family:sans-serif;
        font-size:12px;
    }

    h2,h3{
        text-align:center;
        margin:0;
    }

    table{
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
    }

    table,
    th,
    td{
        border:1px
        solid #000;
    }

    th{
        background:#f2f2f2;
    }

    th,
    td{
        padding:10px;
        font-size:12px;
    }

    .judul{
        text-align:center;
        margin-bottom:20px;
    }

    .kategori{
        font-size:18px;
        font-weight:bold;
        margin-top:10px;
        margin-bottom:15px;
    }

    .footer{
        margin-top:20px;
        font-size:11px;
    }

    </style>
    ';

    foreach(
        $data['kriteria']
        as $k
    )
    {
        $hasil =
        $this->db
        ->select('
            guru.nama_guru,
            COUNT(voting.id_guru)
            as total_vote
        ')
        ->from('voting')
        ->join(
            'guru',
            'guru.id_guru =
            voting.id_guru'
        )
        ->where(
            'voting.id_kriteria',
            $k->id_kriteria
        )
        ->group_by(
            'voting.id_guru'
        )
        ->order_by(
            'total_vote',
            'DESC'
        )
        ->get()
        ->result();

        $html .= '

        <div
        style="
        page-break-after:
        always;
        ">

            <div
            class="judul">

                <h2>

                    LAPORAN HASIL
                    VOTING GURU
                    TERFAVORIT

                </h2>

                <h3>

                    SMK NEGERI 1
                    CILIMUS

                </h3>

            </div>

            <hr>

            <div
            class="footer">

                Tanggal Cetak :
                '.date('d-m-Y H:i').'

            </div>

            <div
            class="kategori">

                '.$k->nama_kriteria.'

            </div>

            <table>

                <thead>

                    <tr>

                        <th width="120">

                            Peringkat

                        </th>

                        <th>

                            Nama Guru

                        </th>

                        <th width="120">

                            Total Vote

                        </th>

                    </tr>

                </thead>

                <tbody>
        ';

        if(
            empty($hasil)
        )
        {
            $html .= '

            <tr>

                <td
                colspan="3"
                align="center">

                    Belum ada voting

                </td>

            </tr>
            ';
        }
        else
        {
            $rank = 1;

            foreach(
                $hasil
                as $h
            )
            {
                if($rank == 1)
                {
                    $medal =
                    'Favorit 1';
                }
                elseif($rank == 2)
                {
                    $medal =
                    'Favorit 2';
                }
                elseif($rank == 3)
                {
                    $medal =
                    'Favorit 3';
                }
                else
                {
                    $medal =
                    'Rank '.$rank;
                }

                $html .= '

                <tr>

                    <td
                    align="center"
                    style="
                    font-weight:bold;
                    ">

                        '.$medal.'

                    </td>

                    <td>

                        '.$h->nama_guru.'

                    </td>

                    <td
                    align="center">

                        '.$h->total_vote.'
                        suara

                    </td>

                </tr>
                ';

                $rank++;
            }
        }

        $html .= '

                </tbody>

            </table>

        </div>
        ';
    }

    $options =
    new Options();

    $options
    ->set(
        'isRemoteEnabled',
        true
    );

    $dompdf =
    new Dompdf(
        $options
    );

    $dompdf
    ->loadHtml(
        $html
    );

    $dompdf
    ->setPaper(
        'A4',
        'portrait'
    );

    $dompdf
    ->render();

    $dompdf
    ->stream(
        'laporan_hasil_voting.pdf',
        [
            'Attachment'
            => false
        ]
    );
}
}