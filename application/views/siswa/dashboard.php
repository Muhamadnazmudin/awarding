<div class="container-fluid">

    <div
    class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Dashboard Siswa

        </h1>

    </div>


    <div class="row">

        <!-- Profile -->

        <div class="col-xl-4 col-md-6 mb-4">

            <div
            class="card border-left-primary shadow h-100 py-2">

                <div class="card-body">

                    <div class="text-center">

                        <img
                        src="<?= base_url('uploads/siswa/'.$siswa->foto); ?>"
                        width="120"
                        class="img-thumbnail rounded-circle mb-3">

                        <h5>

                            <?= $siswa->nama_siswa; ?>

                        </h5>

                        <small>

                            NISN:
                            <?= $siswa->nisn; ?>

                        </small>

                    </div>

                </div>

            </div>

        </div>


        <!-- Status Voting -->

        <div class="col-xl-4 col-md-6 mb-4">

            <div
            class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                    <h5>
                        Status Voting
                    </h5>

                    <?php if(
                        !empty(
                            $pengaturan
                        )
                        &&
                        $pengaturan
                        ->voting_status
                        =='buka'
                    ): ?>

                        <span
                        class="badge badge-success">

                            Voting Dibuka

                        </span>

                    <?php else: ?>

                        <span
                        class="badge badge-danger">

                            Voting Ditutup

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>


        <!-- Total Award -->

        <div class="col-xl-4 col-md-6 mb-4">

            <div
            class="card border-left-info shadow h-100 py-2">

                <div class="card-body">

                    <h5>
                        Total Kategori Award
                    </h5>

                    <h2>

                        <?= $total_kriteria; ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>


    <div class="card shadow">

        <div class="card-header">

            <h5>

                Mulai Voting

            </h5>

        </div>

        <div class="card-body">

            <?php if(
                !empty(
                    $pengaturan
                )
                &&
                $pengaturan
                ->voting_status
                =='buka'
            ): ?>

                <a
                href="<?= site_url('siswa/voting'); ?>"
                class="btn btn-primary btn-lg">

                    MULAI VOTING

                </a>

            <?php else: ?>

                <div
                class="alert alert-danger">

                    Voting belum dibuka

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>