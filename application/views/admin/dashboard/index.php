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