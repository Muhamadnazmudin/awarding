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

    <div
    class="row">

    <?php foreach(
        $leader
        as $k
    ):

    $juara =
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
        'id_kriteria',
        $k->id_kriteria
    )
    ->group_by(
        'voting.id_guru'
    )
    ->order_by(
        'total_vote',
        'DESC'
    )
    ->limit(1)
    ->get()
    ->row();

    ?>

    <div
    class="col-md-4 mb-4">

        <div
        class="card shadow">

            <div
            class="card-header">

                <?= $k->nama_kriteria; ?>

            </div>

            <div
            class="card-body text-center">

                <?php if(
                    $juara
                ): ?>

                    <img
                    src="<?= base_url('uploads/guru/'.$juara->foto); ?>"
                    width="100"
                    class="rounded-circle img-thumbnail mb-3">

                    <h5>

                        🥇
                        <?= $juara->nama_guru; ?>

                    </h5>

                    <span
                    class="badge badge-success">

                        <?= $juara->total_vote; ?>

                        suara

                    </span>

                <?php else: ?>

                    <div
                    class="alert alert-warning">

                        Belum ada vote

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <?php endforeach; ?>

    </div>

</div>