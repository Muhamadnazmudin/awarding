<div class="container-fluid">

    <h1
    class="h3 mb-4 text-gray-800">

        Dashboard Admin

    </h1>


    <div class="row">

        <!-- total siswa -->

        <div
        class="col-xl-3 col-md-6 mb-4">

            <div
            class="card border-left-primary shadow h-100 py-2">

                <div
                class="card-body">

                    <h5>
                        Total Siswa
                    </h5>

                    <h2>

                        <?= $total_siswa; ?>

                    </h2>

                </div>

            </div>

        </div>


        <!-- sudah voting -->

        <div
        class="col-xl-3 col-md-6 mb-4">

            <div
            class="card border-left-success shadow h-100 py-2">

                <div
                class="card-body">

                    <h5>
                        Sudah Voting
                    </h5>

                    <h2>

                        <?= $sudah_voting; ?>

                    </h2>

                </div>

            </div>

        </div>


        <!-- belum -->

        <div
        class="col-xl-3 col-md-6 mb-4">

            <div
            class="card border-left-danger shadow h-100 py-2">

                <div
                class="card-body">

                    <h5>
                        Belum Voting
                    </h5>

                    <h2>

                        <?= $belum_voting; ?>

                    </h2>

                </div>

            </div>

        </div>


        <!-- kategori -->

        <div
        class="col-xl-3 col-md-6 mb-4">

            <div
            class="card border-left-info shadow h-100 py-2">

                <div
                class="card-body">

                    <h5>
                        Kategori Award
                    </h5>

                    <h2>

                        <?= $total_kriteria; ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>



    <!-- Progress -->

    <div
    class="card shadow mb-4">

        <div
        class="card-header">

            Progress Voting

        </div>

        <div
        class="card-body">

            <h4>

                <?= $progress; ?>%

            </h4>

            <div
            class="progress">

                <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width:
                <?= $progress; ?>%">

                </div>

            </div>

        </div>

    </div>

<div class="card shadow mb-4">

    <div
    class="card-header py-3">

        <h5
        class="m-0 font-weight-bold text-primary">

            📊 Detail Progress Voting
            per Kriteria

        </h5>

    </div>

    <div class="card-body">

        <div
        class="table-responsive">

            <table
            class="table table-bordered">

                <thead
                class="thead-light">

                    <tr>

                        <th>
                            Kriteria
                        </th>

                        <th width="180">
                            Sudah Voting
                        </th>

                        <th width="180">
                            Belum Voting
                        </th>

                        <th width="220">
                            Progress
                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach(
    $leader
    as $k
):

// =========================
// TOTAL TARGET SISWA
// =========================

// guru jurusan
if(
    $k->tipe_guru
    == 'jurusan'
)
{
    $target_siswa =
    $this->db
    ->where(
        'status',
        'aktif'
    )
    ->where(
        'id_jurusan',
        $k->id_jurusan
    )
    ->count_all_results(
        'siswa'
    );
}

// guru umum / semua
else
{
    $target_siswa =
    $this->db
    ->where(
        'status',
        'aktif'
    )
    ->count_all_results(
        'siswa'
    );
}


// =========================
// SUDAH VOTING
// =========================

$sudah =
$this->db
->where(
    'id_kriteria',
    $k->id_kriteria
)
->group_by(
    'id_siswa'
)
->get('voting')
->num_rows();


// =========================
// BELUM VOTING
// =========================

$belum =
$target_siswa
- $sudah;


// =========================
// PERSENTASE
// =========================

$persen =
$target_siswa > 0
?
round(
    (
        $sudah
        /
        $target_siswa
    ) * 100
)
:
0;

?>

                <tr>

                    <td>

                        <b>

                        <?= $k
                        ->nama_kriteria; ?>

                        </b>

                    </td>

                    <td>

                        <span
                        class="badge badge-success p-2">

                            <?= $sudah; ?>

/

<?= $target_siswa; ?>

siswa
                        </span>

                    </td>

                    <td>

                        <span
                        class="badge badge-danger p-2">

                            <?= $belum; ?>

                            siswa

                        </span>

                    </td>

                    <td>

    <div class="d-flex
    justify-content-between
    mb-1">

        <small
        class="font-weight-bold
        text-primary">

            <?= $persen; ?>%

        </small>

        <small
        class="text-muted">

            <?= $sudah; ?>

            /
            
            <?= $target_siswa; ?>

        </small>

    </div>

    <div
    class="progress"
    style="
    height:18px;
    border-radius:20px;
    background:#eaecf4;
    ">

        <div
        class="progress-bar
        bg-info
        progress-bar-striped
        progress-bar-animated"

        role="progressbar"

        style="
        width:
        <?= $persen; ?>%;
        border-radius:20px;
        font-size:11px;
        font-weight:bold;
        ">

            <?= $persen; ?>%

        </div>

    </div>

</td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

    <!-- leader sementara -->

    <div class="card shadow mb-4">

    <div
    class="card-header py-3">

        <h5
        class="m-0 font-weight-bold
        text-primary">

            🏆 Leaderboard Awarding

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

        <?php foreach(
            $leader as $k
        ):

        $ranking =
        $this->db
        ->select('
            guru.nama_guru,
            guru.foto,
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
        ->limit(5)
        ->get()
        ->result();

        ?>

        <div
        class="col-lg-6 mb-4">

            <div
            class="card border-left-warning shadow h-100">

                <div
                class="card-header">

                    <b>

                        <?= $k
                        ->nama_kriteria; ?>

                    </b>

                </div>

                <div
                class="card-body">

                    <?php if(
                        $ranking
                    ): ?>

                        <?php
                        foreach(
                            $ranking
                            as $i => $r
                        ):
                        ?>

                        <div
                        class="d-flex align-items-center mb-3">

                            <div
                            class="mr-3">

                                <span
                                class="badge badge-warning p-2">

                                    #<?= $i+1; ?>

                                </span>

                            </div>

                            <div
                            class="foto-ranking">

                                <img
                                src="<?= base_url(
                                'uploads/guru/'
                                .$r->foto
                                ); ?>"

                                class="foto-ranking-img">

                            </div>

                            <div
                            class="flex-grow-1 ml-3">

                                <b>

                                    <?= $r
                                    ->nama_guru; ?>

                                </b>

                                <br>

                                <small
                                class="text-muted">

                                    <?= $r
                                    ->total_vote; ?>

                                    suara

                                </small>

                                <div
                                class="progress mt-1">

                                    <div
                                    class="progress-bar bg-success"

                                    style="width:
                                    <?= min(
                                        100,
                                        $r->total_vote
                                        * 2
                                    ); ?>%">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div
                        class="alert alert-warning">

                            Belum ada voting

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

        </div>

    </div>

</div>



<style>

.foto-ranking{
    width:55px;
    height:55px;
    border-radius:12px;
    overflow:hidden;
    border:2px solid #eee;
    background:#fff;
}

.foto-ranking-img{
    width:100%;
    height:100%;
    object-fit:cover;
}

</style>