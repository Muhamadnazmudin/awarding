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
    background:#f5f7fb;
    font-family:'Segoe UI',sans-serif;
    overflow-x:hidden;
    color:#2d3748;
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
    position:relative;
    overflow:hidden;
    padding:90px 0 70px;
}

.hero::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    border-radius:50%;
    background:
    rgba(255,255,255,.06);
    top:-180px;
    right:-180px;
}

.hero-badge{
    background:
    rgba(255,255,255,.12);
    display:inline-block;
    padding:10px 18px;
    border-radius:50px;
    font-size:14px;
    margin-bottom:20px;
    backdrop-filter:blur(10px);
    font-weight:600;
}

.hero h1{
    font-size:56px;
    font-weight:800;
    line-height:1.1;
    margin-bottom:20px;
}

.hero-desc{
    font-size:20px;
    line-height:1.9;
    opacity:.95;
    max-width:700px;
}

/* BUTTON LOGIN */

.login-wrapper{
    text-align:center;
    margin-top:35px;
}

.btn-login{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    background:#0d6efd;
    color:white !important;
    border:none;
    border-radius:60px;
    padding:14px 28px;
    font-weight:700;
    font-size:17px;
    text-decoration:none;
    box-shadow:
    0 10px 25px
    rgba(13,110,253,.25);
    transition:.3s;
    width:auto;
}

.btn-login:hover{
    background:#0b5ed7;
    transform:translateY(-2px);
    text-decoration:none;
    color:white;
}

/* CARD */

.card-modern{
    border:none;
    border-radius:25px;
    box-shadow:
    0 10px 30px
    rgba(0,0,0,.08);
}

.section-title{
    font-size:38px;
    font-weight:800;
    color:#224abe;
}

.icon-box{
    width:75px;
    height:75px;
    border-radius:20px;
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
    font-size:28px;
}

/* TIMELINE */

.timeline-box{
    background:
    linear-gradient(
    135deg,
    #224abe,
    #4e73df
    );
    color:white;
    border-radius:30px;
    padding:45px 25px;
}

.count-box{
    background:white;
    color:#224abe;
    border-radius:20px;
    padding:18px 10px;
    box-shadow:
    0 8px 20px
    rgba(0,0,0,.1);
}

.count-box h2{
    font-weight:800;
    margin:0;
}

footer{
    background:#224abe;
    color:white;
    padding:35px;
    margin-top:50px;
}

/* MOBILE */

@media(max-width:768px){

.hero{
    padding:65px 20px 55px;
    text-align:left;
}

.hero-badge{
    font-size:12px;
}

.hero h1{
    font-size:38px;
    line-height:1.15;
}

.hero-desc{
    font-size:17px;
    line-height:1.8;
}

.btn-login{
    width:100%;
    padding:16px;
    font-size:17px;
}

.section-title{
    font-size:28px;
}

.card-modern{
    border-radius:22px;
}

.timeline-box{
    padding:30px 20px;
}

.count-box{
    padding:14px 8px;
    margin-bottom:12px;
}

.count-box h2{
    font-size:24px;
}

.login-wrapper{
    margin-top:25px;
}

}

</style>

</head>

<body>


<!-- HERO -->

<section class="hero">

<div class="container">

<div class="row">

<div class="col-lg-8">

<div class="hero-badge">

🎉 HARLAH
SMK NEGERI 1 CILIMUS

</div>

<h1>

Awarding Guru
Terfavorit

</h1>

<p class="hero-desc">

Dalam rangka
Hari Lahir
<b>
SMK Negeri 1 Cilimus
</b>,

untuk pertama kalinya
sejak berdiri pada
tahun <b>2012</b>,

sekolah menyelenggarakan

<b>
Awarding Guru Terfavorit
</b>

sebagai bentuk apresiasi
kepada para guru atas
dedikasi, inspirasi,
dan kontribusi dalam
membentuk generasi unggul.

</p>

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
class="count-box">

<h2 id="days">
0
</h2>

<small>Hari</small>

</div>

</div>

<div class="col-3 col-md-2">

<div
class="count-box">

<h2 id="hours">
0
</h2>

<small>Jam</small>

</div>

</div>

<div class="col-3 col-md-2">

<div
class="count-box">

<h2 id="minutes">
0
</h2>

<small>Menit</small>

</div>

</div>

<div class="col-3 col-md-2">

<div
class="count-box">

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

<!-- BUTTON LOGIN -->

<div class="login-wrapper">

<a
href="<?= site_url('auth'); ?>"
class="btn-login">

<i class="fas fa-sign-in-alt"></i>

<span>LOGIN SEKARANG</span>

</a>

</div>

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