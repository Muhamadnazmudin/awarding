<div class="container-fluid">

    <div
    class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Voting Guru

        </h1>

    </div>


    <div class="row">

        <?php

        $id_voted =
        array_column(
            $voted,
            'id_kriteria'
        );

        foreach(
            $kriteria
            as $k
        ):

        $sudah_vote =
        in_array(
            $k->id_kriteria,
            $id_voted
        );

        ?>

        <div
        class="col-xl-4 col-md-6 mb-4">

            <div
            class="card shadow h-100">

                <div
                class="card-body">

                    <div
                    class="text-center">

                        <i
                        class="fas fa-award fa-3x text-warning mb-3">

                        </i>

                        <h5>

                            <?= $k->nama_kriteria; ?>

                        </h5>

                        <hr>

                        <?php if(
                            $k->tipe_guru
                            =='jurusan'
                        ): ?>

                            <span
                            class="badge badge-info">

                                Guru Jurusan

                            </span>

                        <?php elseif(
                            $k->tipe_guru
                            =='umum'
                        ): ?>

                            <span
                            class="badge badge-primary">

                                Guru Umum

                            </span>

                        <?php else: ?>

                            <span
                            class="badge badge-dark">

                                Semua Guru

                            </span>

                        <?php endif; ?>


                        <div
                        class="mt-3">

                            <?php if(
                                $sudah_vote
                            ): ?>

                                <button
                                class="btn btn-success btn-block"
                                disabled>

                                    <i
                                    class="fas fa-check-circle">

                                    </i>

                                    Sudah Voting

                                </button>

                            <?php else: ?>

                                <a
                                href="<?= site_url('siswa/voting/'.$k->id_kriteria); ?>"
                                class="btn btn-primary btn-block">

                                    <i
                                    class="fas fa-vote-yea">

                                    </i>

                                    Mulai Voting

                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>