<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">
            Dashboard Siswa
        </h1>

    </div>

    <div class="row">

        <!-- Profile -->
        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-center">

                        <?php

$foto_default =
base_url(
    'assets/img/default-user.png'
);

?>

<img
src="<?= !empty($siswa->foto)
? base_url('uploads/siswa/'.$siswa->foto)
: $foto_default; ?>"
width="120"
height="120"
class="img-thumbnail rounded-circle mb-3 shadow-sm"
style="object-fit:cover;"
onerror="this.src='<?= $foto_default; ?>'">
                        <h5 class="font-weight-bold mb-1">
                            <?= $siswa->nama_siswa; ?>
                        </h5>

                        <small class="text-muted d-block">
                            NISN:
                            <?= $siswa->nisn; ?>
                        </small>

                    </div>

                </div>

            </div>

        </div>

        <!-- Status Voting -->
        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                    <h5 class="font-weight-bold mb-3">
                        Status Voting
                    </h5>

                    <?php if(
                        !empty($pengaturan)
                        &&
                        $pengaturan->voting_status == 'buka'
                    ): ?>

                        <span class="badge badge-success p-2">
                            Voting Dibuka
                        </span>

                    <?php else: ?>

                        <span class="badge badge-danger p-2">
                            Voting Ditutup
                        </span>

                    <?php endif; ?>

                    <hr>

                    <small class="text-muted">
                        Status Progress:
                    </small>

                    <div class="mt-2">

                        <?php if($status_vote == 'Selesai'): ?>

                            <span class="badge badge-success">
                                Semua Voting Selesai
                            </span>

                        <?php else: ?>

                            <span class="badge badge-warning">
                                Belum Selesai
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

        <!-- Total Award -->
        <div class="col-xl-4 col-md-6 mb-4">

            <div class="card border-left-info shadow h-100 py-2">

                <div class="card-body text-center">

                    <h5 class="font-weight-bold">
                        Total Kategori Award
                    </h5>

                    <h1 class="font-weight-bold text-info mt-3">
                        <?= $total_kriteria; ?>
                    </h1>

                    <small class="text-muted">
                        Kategori yang wajib dipilih
                    </small>

                </div>

            </div>

        </div>

    </div>


    <!-- Timeline Voting -->
    <div class="card shadow mb-4">

        <div
        class="card-header py-3 d-flex justify-content-between align-items-center">

            <h5 class="m-0 font-weight-bold text-primary">

                Timeline Voting

            </h5>

            <?php if($status_vote == 'Selesai'): ?>

                <span class="badge badge-success">
                    Selesai
                </span>

            <?php else: ?>

                <span class="badge badge-warning">
                    Belum Selesai
                </span>

            <?php endif; ?>

        </div>

        <div class="card-body">

            <?php
            $persen =
            ($total_kriteria > 0)
            ?
            ($jumlah_vote / $total_kriteria) * 100
            :
            0;
            ?>

            <div class="d-flex justify-content-between mb-2">

                <strong>
                    Progress Voting
                </strong>

                <strong>
                    <?= $jumlah_vote; ?>
                    /
                    <?= $total_kriteria; ?>
                </strong>

            </div>

            <!-- Progress -->
            <div
            class="progress mb-4"
            style="height:25px; border-radius:20px;">

                <div
                class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                role="progressbar"
                style="width: <?= $persen; ?>%;">

                    <?= round($persen); ?>%

                </div>

            </div>

            <!-- Timeline -->
            <div class="timeline-wrapper">

                <?php for($i = 1; $i <= $total_kriteria; $i++): ?>

                    <?php if($i <= $jumlah_vote): ?>

                        <div class="timeline-item done">

                            <div class="timeline-icon success">

                                <i class="fas fa-check"></i>

                            </div>

                            <div>

                                <strong>
                                    Voting ke-<?= $i; ?>
                                </strong>

                                <br>

                                <small class="text-success">
                                    Sudah dilakukan
                                </small>

                            </div>

                        </div>

                    <?php else: ?>

                        <div class="timeline-item pending">

                            <div class="timeline-icon waiting">

                                <i class="fas fa-clock"></i>

                            </div>

                            <div>

                                <strong>
                                    Voting ke-<?= $i; ?>
                                </strong>

                                <br>

                                <small class="text-muted">
                                    Belum dilakukan
                                </small>

                            </div>

                        </div>

                    <?php endif; ?>

                <?php endfor; ?>

            </div>

            <!-- Alert -->
            <?php if($status_vote == 'Selesai'): ?>

                <div class="alert alert-success mt-4 mb-0">

                    🎉
                    Selamat!
                    Semua voting telah selesai dilakukan.

                </div>

            <?php else: ?>

                <div class="alert alert-info mt-4 mb-0">

                    Kamu masih perlu menyelesaikan
                    <strong>

                        <?= $total_kriteria - $jumlah_vote; ?>

                    </strong>

                    voting lagi.

                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- Mulai Voting -->
    <div class="card shadow">

        <div class="card-header">

            <h5 class="m-0 font-weight-bold text-primary">

                Mulai Voting

            </h5>

        </div>

        <div class="card-body text-center">

            <?php if(
                !empty($pengaturan)
                &&
                $pengaturan->voting_status == 'buka'
            ): ?>

                <a
                href="<?= site_url('siswa/voting'); ?>"
                class="btn btn-primary btn-lg btn-block shadow-sm">

                    <i class="fas fa-vote-yea mr-2"></i>

                    MULAI VOTING

                </a>

            <?php else: ?>

                <div class="alert alert-danger mb-0">

                    Voting belum dibuka

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>


<style>

.timeline-wrapper{
    position:relative;
}

.timeline-item{
    display:flex;
    align-items:center;
    margin-bottom:20px;
    position:relative;
}

.timeline-item:not(:last-child)::before{
    content:'';
    position:absolute;
    left:22px;
    top:45px;
    width:3px;
    height:40px;
    background:#d1d3e2;
}

.timeline-icon{
    width:45px;
    height:45px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    margin-right:15px;
    flex-shrink:0;
    box-shadow:0 2px 8px rgba(0,0,0,.15);
}

.timeline-icon.success{
    background:#1cc88a;
}

.timeline-icon.waiting{
    background:#858796;
}

.timeline-item.done{
    opacity:1;
}

.timeline-item.pending{
    opacity:.8;
}

.progress{
    background:#eaecf4;
}

.card{
    border:none;
    border-radius:15px;
}

.btn-primary{
    border-radius:12px;
}

@media(max-width:768px){

    .h3{
        font-size:22px;
    }

    .timeline-item{
        align-items:flex-start;
    }

    .timeline-item:not(:last-child)::before{
        left:20px;
    }

    .progress{
        height:20px !important;
    }

    .btn-lg{
        font-size:16px;
        padding:14px;
    }

}

</style>