<div class="container-fluid">

    <div
    class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Voting Guru

        </h1>

    </div>

    <?php if(
        $this->session
        ->flashdata('error')
    ): ?>

    <div
    class="alert alert-danger">

        <?= $this->session
        ->flashdata('error'); ?>

    </div>

    <?php endif; ?>


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
            class="card shadow h-100 border-0">

                <div
                class="card-body text-center">

                    <div class="mb-3">

                        <div
                        style="
                        width:80px;
                        height:80px;
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
                        box-shadow:
                        0 4px 12px
                        rgba(
                            78,
                            115,
                            223,
                            .25
                        );
                        ">

                            <i
                            class="fas fa-award fa-2x text-white">

                            </i>

                        </div>

                    </div>

                    <h5
                    class="font-weight-bold mb-3"
                    style="
                    min-height:65px;
                    ">

                        <?= $k->nama_kriteria; ?>

                    </h5>

                    <hr>

                    <?php if(
                        $k->tipe_guru
                        == 'jurusan'
                    ): ?>

                        <span
                        class="badge badge-info px-3 py-2">

                            Guru Jurusan

                        </span>

                    <?php elseif(
                        $k->tipe_guru
                        == 'umum'
                    ): ?>

                        <span
                        class="badge badge-primary px-3 py-2">

                            Guru Umum

                        </span>

                    <?php else: ?>

                        <span
                        class="badge badge-dark px-3 py-2">

                            Semua Guru

                        </span>

                    <?php endif; ?>


                    <div
                    class="mt-4">

                        <!-- SUDAH VOTE -->
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


                        <!-- VOTING DITUTUP -->
                        <?php elseif(
                            empty(
                                $pengaturan
                            )
                            ||
                            $pengaturan
                            ->voting_status
                            != 'buka'
                        ): ?>

                            <button
                            class="btn btn-secondary btn-block"
                            disabled>

                                <i
                                class="fas fa-lock">

                                </i>

                                Voting Ditutup

                            </button>


                        <!-- VOTING DIBUKA -->
                        <?php else: ?>

                            <a
                            href="<?= site_url('siswa/voting/detail/'.$k->id_kriteria); ?>"
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

        <?php endforeach; ?>

    </div>

</div>