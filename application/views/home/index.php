<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1">

<title>

<?= $title; ?>

</title>

<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
rel="stylesheet">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:
    #f5f7fb;
    font-family:
    'Segoe UI',
    sans-serif;
}

/* HERO */

.hero{
    background:
    linear-gradient(
    135deg,
    #224abe,
    #4e73df
    );
    color:white;
    padding:
    100px 20px;
    position:
    relative;
    overflow:hidden;
}

.hero::before{
    content:'';
    position:absolute;
    width:400px;
    height:400px;
    background:
    rgba(
        255,
       255,
       255,
        .08
    );
    border-radius:
    50%;
    top:-150px;
    right:-150px;
}

.hero h1{
    font-size:52px;
    font-weight:800;
}

.hero p{
    font-size:20px;
    opacity:.95;
}

.btn-login{
    background:white;
    color:#224abe;
    border-radius:
    50px;
    padding:
    14px 35px;
    font-weight:bold;
    transition:.3s;
}

.btn-login:hover{
    transform:
    translateY(-2px);
    box-shadow:
    0 10px 25px
    rgba(
        0,0,0,.15
    );
}

/* CARD */

.card-modern{
    border:none;
    border-radius:
    25px;
    box-shadow:
    0 10px 30px
    rgba(
        0,0,0,.08
    );
}

.section-title{
    font-size:34px;
    font-weight:700;
    color:#224abe;
}

.icon-box{
    width:80px;
    height:80px;
    border-radius:
    20px;
    background:
    linear-gradient(
    135deg,
    #4e73df,
    #224abe
    );
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    color:white;
    font-size:30px;
}

/* TIMELINE */

.timeline-box{
    background:
    linear-gradient(
    135deg,
    #4e73df,
    #224abe
    );
    color:white;
    border-radius:
    25px;
    padding:30px;
}

footer{
    background:#224abe;
    color:white;
    padding:30px;
}

@media(max-width:768px){

.hero h1{
    font-size:34px;
}

.hero{
    text-align:center;
}

.section-title{
    font-size:28px;
}

}

</style>

</head>

<body>


<!-- HERO -->

<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-7">

<h5
class="mb-3">

🎉 HARLAH
SMK NEGERI 1 CILIMUS

</h5>

<h1>

Awarding
Guru Terfavorit

</h1>

<p class="mt-4">

Dalam rangka
Hari Lahir
<b>
SMK Negeri 1 Cilimus
</b>,

untuk pertama kalinya
sejak berdiri
pada tahun
<b>2012</b>,

sekolah
menyelenggarakan
kegiatan
<b>
Awarding Guru
Terfavorit
</b>

sebagai bentuk
apresiasi terhadap
dedikasi,
inspirasi,
dan kontribusi
para pendidik
dalam membentuk
generasi unggul.

</p>

<a
href="<?= site_url('auth'); ?>"
class="btn btn-login btn-lg mt-4">

<i class="fas fa-sign-in-alt">

</i>

LOGIN SEKARANG

</a>

</div>

<div
class="col-lg-5 text-center">

<!-- <img
src="<?= base_url('assets/img/hero-school.png'); ?>"
class="img-fluid"
style="max-height:380px;"> -->

</div>

</div>

</div>

</section>



<!-- TENTANG -->

<section class="py-5">

<div class="container">

<div class="text-center mb-5">

<h2
class="section-title">

Tentang Awarding

</h2>

</div>

<div
class="card card-modern p-5">

<p
class="text-center mb-0"
style="
font-size:18px;
line-height:2;
">

Momentum
Hari Lahir
SMK Negeri 1 Cilimus

menjadi tonggak
sejarah baru
dalam budaya
apresiasi pendidikan.

Melalui kegiatan ini,
peserta didik diberikan
kesempatan untuk
memberikan penghargaan
kepada guru-guru terbaik
yang telah menjadi
inspirasi,
motivasi,
serta teladan
di lingkungan sekolah.

</p>

</div>

</div>

</section>



<!-- PENGUMUMAN -->

<section class="pb-5">

<div class="container">

<h2
class="section-title text-center mb-5">

📢 Pengumuman

</h2>

<div
class="card card-modern p-4">

<?= !empty($pengaturan->keterangan)
? $pengaturan->keterangan
: 'Belum ada pengumuman'; ?>

</div>

</div>

</section>



<!-- PERATURAN -->

<section class="pb-5">

<div class="container">

<h2
class="section-title text-center mb-5">

Peraturan Voting

</h2>

<div class="row">

<?php
$rules = [

'1 siswa hanya dapat memilih 1 guru per kategori.',

'Voting tidak dapat diubah setelah dikirim.',

'Gunakan akun siswa resmi.',

'Guru jurusan mengikuti jurusan siswa.',

'Guru umum berlaku untuk seluruh siswa.',

'Keputusan hasil voting bersifat final.'
];

foreach($rules as $r):
?>

<div
class="col-md-4 mb-4">

<div
class="card card-modern p-4 h-100 text-center">

<div class="icon-box mb-3">

<i
class="fas fa-check">

</i>

</div>

<?= $r; ?>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>



<!-- TIMELINE -->

<section class="pb-5">

<div class="container">

<div
class="timeline-box text-center">

<h2>

📅 Jadwal Voting

</h2>

<hr style="background:white;">

<p>

Mulai :

<b>

<?= date(
'd F Y',
strtotime(
$pengaturan
->tanggal_mulai
)
); ?>

</b>

</p>

<p>

Selesai :

<b>

<?= date(
'd F Y',
strtotime(
$pengaturan
->tanggal_selesai
)
); ?>

</b>

</p>


<!-- COUNTDOWN -->

<div class="mt-4">

<h4 class="mb-4">

⏳ Countdown Voting

</h4>

<div
class="row justify-content-center">

<div class="col-3 col-md-2">

<div
class="bg-white text-dark rounded-lg py-3 shadow">

<h2 id="days">
0
</h2>

<small>Hari</small>

</div>

</div>

<div class="col-3 col-md-2">

<div
class="bg-white text-dark rounded-lg py-3 shadow">

<h2 id="hours">
0
</h2>

<small>Jam</small>

</div>

</div>

<div class="col-3 col-md-2">

<div
class="bg-white text-dark rounded-lg py-3 shadow">

<h2 id="minutes">
0
</h2>

<small>Menit</small>

</div>

</div>

<div class="col-3 col-md-2">

<div
class="bg-white text-dark rounded-lg py-3 shadow">

<h2 id="seconds">
0
</h2>

<small>Detik</small>

</div>

</div>

</div>

<p
id="statusVoting"
class="mt-4 font-weight-bold">

</p>

</div>

</div>

</div>

</section>



<footer class="text-center">

<h5>

SMK Negeri 1 Cilimus

</h5>

<p class="mb-0">

© <?= date('Y'); ?>

Awarding Guru
Terfavorit

</p>

</footer>

<script>

const endDate =
new Date(
'<?= $pengaturan->tanggal_selesai; ?> 23:59:59'
).getTime();

const startDate =
new Date(
'<?= $pengaturan->tanggal_mulai; ?> 00:00:00'
).getTime();

const timer =
setInterval(function(){

    const now =
    new Date().getTime();

    const status =
    document.getElementById(
        'statusVoting'
    );

    // BELUM DIMULAI
    if(now < startDate)
    {
        status.innerHTML =
        '🟡 Voting belum dimulai';

        return;
    }

    const distance =
    endDate - now;

    // SUDAH SELESAI
    if(distance < 0)
    {
        clearInterval(timer);

        document.getElementById(
            'days'
        ).innerHTML = 0;

        document.getElementById(
            'hours'
        ).innerHTML = 0;

        document.getElementById(
            'minutes'
        ).innerHTML = 0;

        document.getElementById(
            'seconds'
        ).innerHTML = 0;

        status.innerHTML =
        '🔴 Voting telah berakhir';

        return;
    }

    const days =
    Math.floor(
        distance /
        (
            1000 * 60 * 60 * 24
        )
    );

    const hours =
    Math.floor(
        (
            distance %
            (
                1000 * 60 * 60 * 24
            )
        )
        /
        (
            1000 * 60 * 60
        )
    );

    const minutes =
    Math.floor(
        (
            distance %
            (
                1000 * 60 * 60
            )
        )
        /
        (
            1000 * 60
        )
    );

    const seconds =
    Math.floor(
        (
            distance %
            (
                1000 * 60
            )
        )
        / 1000
    );

    document
    .getElementById(
        'days'
    )
    .innerHTML =
    days;

    document
    .getElementById(
        'hours'
    )
    .innerHTML =
    hours;

    document
    .getElementById(
        'minutes'
    )
    .innerHTML =
    minutes;

    document
    .getElementById(
        'seconds'
    )
    .innerHTML =
    seconds;

    status.innerHTML =
    '🟢 Voting sedang berlangsung';

},1000);

</script>
</body>
</html>