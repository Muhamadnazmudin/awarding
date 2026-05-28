<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (
            !$this->session
            ->userdata('logged_in')
        )
        {
            redirect('auth');
        }

        $this->load->model(
            'Siswa_model'
        );

        $this->load->library(
            'upload'
        );
        $this->load->library(
    'pagination'
);
    }

    public function index()
{
    $data['title'] =
    'Data Siswa';

    // PAGINATION
    $config['base_url'] =
    site_url(
        'admin/siswa/index'
    );

    $config['total_rows'] =
    $this->db
    ->count_all(
        'siswa'
    );

    $config['per_page'] =
    20;

    $config['uri_segment'] =
    4;
    $config['first_link'] = 'Awal';
$config['last_link'] = 'Akhir';
$config['next_link'] = '>';
$config['prev_link'] = '<';

    // styling bootstrap
    $config['full_tag_open'] =
'<nav class="mt-4">
<ul class="pagination justify-content-center">';

$config['full_tag_close'] =
'</ul>
</nav>';

$config['first_link'] =
'Awal';

$config['last_link'] =
'Akhir';

$config['next_link'] =
'>';

$config['prev_link'] =
'<';

$config['num_tag_open'] =
'<li class="page-item">';

$config['num_tag_close'] =
'</li>';

$config['cur_tag_open'] =
'<li class="page-item active">
<span class="page-link">';

$config['cur_tag_close'] =
'</span>
</li>';

$config['next_tag_open'] =
'<li class="page-item">';

$config['next_tag_close'] =
'</li>';

$config['prev_tag_open'] =
'<li class="page-item">';

$config['prev_tag_close'] =
'</li>';

$config['first_tag_open'] =
'<li class="page-item">';

$config['first_tag_close'] =
'</li>';

$config['last_tag_open'] =
'<li class="page-item">';

$config['last_tag_close'] =
'</li>';

$config['attributes'] =
[
    'class' => 'page-link'
];

    $this->pagination
    ->initialize($config);

    $page =
$this->uri
->segment(4)
?
$this->uri
->segment(4)
:
0;

    // siswa pagination
    $data['siswa'] =
    $this->db
    ->select(
        'siswa.*, jurusan.nama_jurusan, kelas.nama_kelas'
    )
    ->join(
        'jurusan',
        'jurusan.id_jurusan = siswa.id_jurusan',
        'left'
    )
    ->join(
        'kelas',
        'kelas.id_kelas = siswa.id_kelas',
        'left'
    )
    ->limit(
        $config['per_page'],
        $page
    )
    ->order_by(
        'nama_siswa',
        'ASC'
    )
    ->get('siswa')
    ->result();

    $data['pagination'] =
    $this->pagination
    ->create_links();

    $data['jurusan'] =
    $this->Siswa_model
    ->get_jurusan();

    $data['kelas'] =
    $this->Siswa_model
    ->get_kelas();

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
        'admin/siswa/index',
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
    $foto = 'default-user.png';

    // upload foto
    if(
        !empty(
            $_FILES['foto']['name']
        )
    )
    {
        $config['upload_path'] =
        './uploads/siswa/';

        $config['allowed_types'] =
        'jpg|jpeg|png';

        $config['encrypt_name'] =
        TRUE;

        $this->upload
        ->initialize($config);

        if(
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

    // ambil nisn dulu
    $nisn =
    $this->input
    ->post('nisn');

    // cek duplicate nisn
    $cek_nisn =
    $this->db
    ->where(
        'nisn',
        $nisn
    )
    ->get('siswa')
    ->row();

    if($cek_nisn)
    {
        $this->session
        ->set_flashdata(
            'error',
            'NISN sudah terdaftar'
        );

        redirect(
            'admin/siswa'
        );
    }

    $data = [

        'nis' =>
        $this->input
        ->post('nis'),

        'nisn' =>
        $nisn,

        'nik' =>
        $this->input
        ->post('nik'),

        'nama_siswa' =>
        $this->input
        ->post(
            'nama_siswa'
        ),

        'jk' =>
        $this->input
        ->post('jk'),

        'id_jurusan' =>
        $this->input
        ->post(
            'id_jurusan'
        ),

        'id_kelas' =>
        $this->input
        ->post(
            'id_kelas'
        ),

        'username' =>
        $nisn,

        'password' =>
        password_hash(
            $nisn,
            PASSWORD_DEFAULT
        ),

        'foto' =>
        $foto,

        'status' =>
        $this->input
        ->post(
            'status'
        )
    ];

    $this->Siswa_model
        ->insert($data);

    $this->session
    ->set_flashdata(
        'success',
        'Siswa berhasil ditambahkan'
    );

    redirect(
        'admin/siswa'
    );
}
    public function delete($id)
    {
        $this->Siswa_model
            ->delete($id);

        redirect(
            'admin/siswa'
        );
    }
    public function reset_password($id)
{
    $siswa = $this->db
        ->where(
            'id_siswa',
            $id
        )
        ->get('siswa')
        ->row();

    $password =
    password_hash(
        $siswa->nisn,
        PASSWORD_DEFAULT
    );

    $this->db
        ->where(
            'id_siswa',
            $id
        )
        ->update(
            'siswa',
            [
                'password' =>
                $password
            ]
        );

    redirect('admin/siswa');
}
public function template()
{
    $spreadsheet =
    new Spreadsheet();

    $sheet =
    $spreadsheet
    ->getActiveSheet();

    // HEADER
    $sheet->setCellValue('A1','nis');
    $sheet->setCellValue('B1','nisn');
    $sheet->setCellValue('C1','nik');
    $sheet->setCellValue('D1','nama_siswa');
    $sheet->setCellValue('E1','jk');
    $sheet->setCellValue('F1','jurusan');
    $sheet->setCellValue('G1','kelas');
    $sheet->setCellValue('H1','status');

    // contoh
    $sheet->setCellValue('A2','12345');
    $sheet->setCellValue('B2','1234567890');
    $sheet->setCellValue('C2','320112341234');
    $sheet->setCellValue('D2','Budi Santoso');
    $sheet->setCellValue('E2','L');
    $sheet->setCellValue('F2','Kuliner');
    $sheet->setCellValue('G2','XI Kuliner 1');
    $sheet->setCellValue('H2','aktif');

    foreach(range('A','H') as $col)
    {
        $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
    }

    if(ob_get_length())
    {
        ob_end_clean();
    }

    $filename =
    'template_import_siswa.xlsx';

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
public function import()
{
    if(empty($_FILES['file']['name']))
    {
        redirect('admin/siswa');
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
        if($i == 0)
        {
            continue;
        }

        $baris =
        $i + 1;

        $nis =
        trim($row[0]);

        $nisn =
        trim($row[1]);

        $nik =
        trim($row[2]);

        $nama =
        trim($row[3]);

        $jk =
        strtoupper(
            trim($row[4])
        );

        $jurusan_excel =
        trim($row[5]);

        $kelas_excel =
        trim($row[6]);

        $status =
        trim($row[7]);

        // cek JK
        if(
            !in_array(
                $jk,
                ['L','P']
            )
        )
        {
            $error_rows[] =
            'Baris '.$baris.
            ': JK harus L/P';

            $gagal++;
            continue;
        }

        // cek duplicate NISN
        $cek =
        $this->db
        ->where(
            'nisn',
            $nisn
        )
        ->get('siswa')
        ->row();

        if($cek)
        {
            $error_rows[] =
            'Baris '.$baris.
            ': NISN '
            .$nisn.
            ' sudah ada';

            $gagal++;
            continue;
        }

        // VALIDASI JURUSAN
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
            'Baris '.$baris.
            ': jurusan "'
            .$jurusan_excel.
            '" tidak ditemukan';

            $gagal++;
            continue;
        }

        // VALIDASI KELAS
        $kelas =
        $this->db
        ->where(
            'nama_kelas',
            $kelas_excel
        )
        ->get('kelas')
        ->row();

        if(!$kelas)
        {
            $error_rows[] =
            'Baris '.$baris.
            ': kelas "'
            .$kelas_excel.
            '" tidak ditemukan';

            $gagal++;
            continue;
        }

        $data = [

            'nis' =>
            $nis,

            'nisn' =>
            $nisn,

            'nik' =>
            $nik,

            'nama_siswa' =>
            $nama,

            'jk' =>
            $jk,

            'id_jurusan' =>
            $jurusan
            ->id_jurusan,

            'id_kelas' =>
            $kelas
            ->id_kelas,

            'username' =>
            $nisn,

            'password' =>
            password_hash(
                $nisn,
                PASSWORD_DEFAULT
            ),

            'foto' =>
'default-user.png',

            'status' =>
            $status
        ];

        $this->db
        ->insert(
            'siswa',
            $data
        );

        $berhasil++;
    }

    @unlink($path);

    $message =
    'Import berhasil :
    '.$berhasil.
    ' siswa,
    gagal :
    '.$gagal;

    if(!empty($error_rows))
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
        'admin/siswa'
    );
}
}