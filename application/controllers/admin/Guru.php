<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Guru_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = 'Data Guru';

        $data['guru'] =
        $this->Guru_model->get_all();

        $data['jurusan'] =
        $this->Guru_model->get_jurusan();

        $data['mapel'] =
        $this->Guru_model->get_mapel();

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
            'admin/guru/index',
            $data
        );

        $this->load->view(
            'admin/template/footer'
        );

        $this->load->view(
            'admin/template/script'
        );
    }

    public function store()
    {
        $foto = 'default.png';

        // upload foto
        if (!empty($_FILES['foto']['name']))
        {
            $config['upload_path'] =
            './uploads/guru/';

            $config['allowed_types'] =
            'jpg|jpeg|png';

            $config['encrypt_name'] =
            TRUE;

            $config['max_size'] = 2048;

            $this->upload->initialize(
                $config
            );

            if (
                $this->upload
                ->do_upload('foto')
            )
            {
                $upload =
                $this->upload
                ->data();

                $foto =
                $upload['file_name'];
            }
        }

        $id_jurusan = NULL;

        if (
            $this->input
            ->post('tipe_guru')
            == 'jurusan'
        )
        {
            $id_jurusan =
            $this->input
            ->post('id_jurusan');
        }

        $data = [

            'nik' =>
            $this->input
            ->post('nik'),

            'nama_guru' =>
            $this->input
            ->post('nama_guru'),

            'jk' =>
            $this->input
            ->post('jk'),

            'tipe_guru' =>
            $this->input
            ->post('tipe_guru'),

            'id_jurusan' =>
            $id_jurusan,

            'foto' =>
            $foto,

            'no_hp' =>
            $this->input
            ->post('no_hp'),

            'alamat' =>
            $this->input
            ->post('alamat'),

            'status' =>
            $this->input
            ->post('status')
        ];

        $id_guru =
        $this->Guru_model
        ->insert($data);

        // insert multi mapel
        $mapel =
        $this->input
        ->post('mapel');

        if ($mapel)
        {
            $this->Guru_model
            ->insert_mapel(
                $id_guru,
                $mapel
            );
        }

        redirect('admin/guru');
    }

    public function update()
    {
        $id =
        $this->input
        ->post('id_guru');

        $guru = $this->db
            ->where(
                'id_guru',
                $id
            )
            ->get('guru')
            ->row();

        $foto =
        $guru->foto;

        // upload foto baru
        if (
            !empty(
                $_FILES['foto']
                ['name']
            )
        )
        {
            $config['upload_path'] =
            './uploads/guru/';

            $config['allowed_types'] =
            'jpg|jpeg|png';

            $config['encrypt_name'] =
            TRUE;

            $config['max_size'] =
            2048;

            $this->upload
            ->initialize(
                $config
            );

            if (
                $this->upload
                ->do_upload('foto')
            )
            {
                // hapus foto lama
                if (
                    $guru->foto !=
                    'default.png'
                )
                {
                    @unlink(
                        './uploads/guru/'
                        .$guru->foto
                    );
                }

                $upload =
                $this->upload
                ->data();

                $foto =
                $upload['file_name'];
            }
        }

        $id_jurusan = NULL;

        if (
            $this->input
            ->post(
                'tipe_guru'
            )
            == 'jurusan'
        )
        {
            $id_jurusan =
            $this->input
            ->post(
                'id_jurusan'
            );
        }

        $data = [

            'nik' =>
            $this->input
            ->post('nik'),

            'nama_guru' =>
            $this->input
            ->post(
                'nama_guru'
            ),

            'jk' =>
            $this->input
            ->post('jk'),

            'tipe_guru' =>
            $this->input
            ->post(
                'tipe_guru'
            ),

            'id_jurusan' =>
            $id_jurusan,

            'foto' =>
            $foto,

            'no_hp' =>
            $this->input
            ->post('no_hp'),

            'alamat' =>
            $this->input
            ->post('alamat'),

            'status' =>
            $this->input
            ->post('status')
        ];

        $this->Guru_model
            ->update(
                $id,
                $data
            );

        // reset mapel
        $this->Guru_model
            ->delete_mapel(
                $id
            );

        $mapel =
        $this->input
        ->post('mapel');

        if ($mapel)
        {
            $this->Guru_model
            ->insert_mapel(
                $id,
                $mapel
            );
        }

        redirect('admin/guru');
    }

    public function delete($id)
    {
        $guru = $this->db
            ->where(
                'id_guru',
                $id
            )
            ->get('guru')
            ->row();

        // hapus foto
        if (
            $guru->foto !=
            'default.png'
        )
        {
            @unlink(
                './uploads/guru/'
                .$guru->foto
            );
        }

        $this->Guru_model
            ->delete($id);

        redirect('admin/guru');
    }

    public function import()
{
    if(empty($_FILES['file']['name']))
    {
        redirect('admin/guru');
    }

    $config['upload_path'] =
    './uploads/excel/';

    $config['allowed_types'] =
    'xlsx|xls|csv';

    $config['encrypt_name'] =
    TRUE;

    $this->upload
    ->initialize($config);

    if(
        !$this->upload
        ->do_upload('file')
    )
    {
        die(
            $this->upload
            ->display_errors()
        );
    }

    $file =
    $this->upload
    ->data();

    $path =
    './uploads/excel/'
    .$file['file_name'];

    $spreadsheet =
    IOFactory::load($path);

    $sheet =
    $spreadsheet
    ->getActiveSheet()
    ->toArray();

    $berhasil = 0;
    $gagal = 0;

    $error_rows = [];

    foreach($sheet as $i => $row)
    {
        // skip header
        if($i == 0)
        {
            continue;
        }

        $baris = $i + 1;

        $nik =
        trim($row[0]);

        $nama =
        trim($row[1]);

        $jk =
        strtoupper(
            trim($row[2])
        );

        $tipe =
        strtolower(
            trim($row[3])
        );

        $jurusan_excel =
        trim($row[4]);

        $mapel_excel =
        trim($row[5]);

        $no_hp =
        trim($row[6]);

        $alamat =
        trim($row[7]);

        $status =
        trim($row[8]);

        // VALIDASI TIPE
        if(
            !in_array(
                $tipe,
                ['umum','jurusan']
            )
        )
        {
            $error_rows[] =
            "Baris ".$baris.
            ": tipe guru tidak valid";

            $gagal++;
            continue;
        }

        // VALIDASI JK
        if(
            !in_array(
                $jk,
                ['L','P']
            )
        )
        {
            $error_rows[] =
            "Baris ".$baris.
            ": jenis kelamin harus L/P";

            $gagal++;
            continue;
        }

        // cek nik duplicate
        $cek =
        $this->db
        ->where(
            'nik',
            $nik
        )
        ->get('guru')
        ->row();

        if($cek)
        {
            $error_rows[] =
            "Baris ".$baris.
            ": NIK ".$nik.
            " sudah ada";

            $gagal++;
            continue;
        }

        // VALIDASI JURUSAN
        $id_jurusan = NULL;

        if(
            $tipe ==
            'jurusan'
        )
        {
            $jurusan =
            $this->db
            ->where(
                'nama_jurusan',
                $jurusan_excel
            )
            ->get('jurusan')
            ->row();

            if(!$jurusan)
            {
                $error_rows[] =
                "Baris ".$baris.
                ": jurusan '"
                .$jurusan_excel.
                "' tidak ditemukan";

                $gagal++;
                continue;
            }

            $id_jurusan =
            $jurusan
            ->id_jurusan;
        }

        // INSERT GURU
        $guru = [

            'nik' =>
            $nik,

            'nama_guru' =>
            $nama,

            'jk' =>
            $jk,

            'tipe_guru' =>
            $tipe,

            'id_jurusan' =>
            $id_jurusan,

            'foto' =>
            'default.png',

            'no_hp' =>
            $no_hp,

            'alamat' =>
            $alamat,

            'status' =>
            $status
        ];

        $this->db
        ->insert(
            'guru',
            $guru
        );

        $id_guru =
        $this->db
        ->insert_id();

        // VALIDASI MAPEL
        if(
            !empty(
                $mapel_excel
            )
        )
        {
            $mapel_arr =
            explode(
                ',',
                $mapel_excel
            );

            foreach(
                $mapel_arr
                as $m
            )
            {
                $m = trim($m);

                $mapel =
                $this->db
                ->where(
                    'nama_mapel',
                    $m
                )
                ->get('mapel')
                ->row();

                if(!$mapel)
                {
                    $error_rows[] =
                    "Baris ".$baris.
                    ": mapel '".$m.
                    "' tidak ditemukan";

                    continue;
                }

                $this->db
                ->insert(
                    'guru_mapel',
                    [

                    'id_guru' =>
                    $id_guru,

                    'id_mapel' =>
                    $mapel
                    ->id_mapel
                    ]
                );
            }
        }

        $berhasil++;
    }

    @unlink($path);

    $message =
    'Import berhasil :
    '.$berhasil.
    ' guru,
    gagal :
    '.$gagal;

    if(
        !empty(
            $error_rows
        )
    )
    {
        $message .=
        '<br><br>'
        .implode(
            '<br>',
            $error_rows
        );
    }

    $this->session
    ->set_flashdata(
        'success',
        $message
    );

    redirect(
        'admin/guru'
    );
}
    public function template()
{
    $spreadsheet =
    new Spreadsheet();

    $sheet =
    $spreadsheet
    ->getActiveSheet();

    // HEADER
    $sheet->setCellValue('A1', 'nik');
    $sheet->setCellValue('B1', 'nama_guru');
    $sheet->setCellValue('C1', 'jk');
    $sheet->setCellValue('D1', 'tipe_guru');
    $sheet->setCellValue('E1', 'jurusan');
    $sheet->setCellValue('F1', 'mapel');
    $sheet->setCellValue('G1', 'no_hp');
    $sheet->setCellValue('H1', 'alamat');
    $sheet->setCellValue('I1', 'status');

    // contoh guru umum
    $sheet->setCellValue('A2', '123456789');
    $sheet->setCellValue('B2', 'Budi Santoso');
    $sheet->setCellValue('C2', 'L');
    $sheet->setCellValue('D2', 'umum');
    $sheet->setCellValue('E2', '');
    $sheet->setCellValue(
        'F2',
        'Matematika,Bahasa Indonesia'
    );
    $sheet->setCellValue('G2', '08123456789');
    $sheet->setCellValue('H2', 'Bandung');
    $sheet->setCellValue('I2', 'aktif');

    // contoh guru jurusan
    $sheet->setCellValue('A3', '987654321');
    $sheet->setCellValue('B3', 'Siti Aminah');
    $sheet->setCellValue('C3', 'P');
    $sheet->setCellValue('D3', 'jurusan');
    $sheet->setCellValue('E3', 'Kuliner');
    $sheet->setCellValue(
        'F3',
        'Produk Kuliner'
    );
    $sheet->setCellValue('G3', '0811111111');
    $sheet->setCellValue('H3', 'Cimahi');
    $sheet->setCellValue('I3', 'aktif');

    // auto width
    foreach(range('A', 'I') as $col)
    {
        $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
    }

    // bersihkan output buffer
    if(ob_get_length())
    {
        ob_end_clean();
    }

    $filename =
    'template_import_guru.xlsx';

    header(
        'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );

    header(
        'Content-Disposition: attachment; filename="'.$filename.'"'
    );

    header(
        'Cache-Control: max-age=0'
    );

    $writer =
    IOFactory::createWriter(
        $spreadsheet,
        'Xlsx'
    );

    $writer->save(
        'php://output'
    );

    exit;
}
}