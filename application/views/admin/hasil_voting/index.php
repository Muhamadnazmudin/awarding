<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">

        Hasil Voting Guru

    </h1>

    <div class="row">

    <?php foreach(
        $kriteria
        as $k
    ):

    $hasil =
    $this->db
    ->select('
        guru.*,
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
    ->get()
    ->result();

    ?>

    <div
    class="col-xl-6 col-lg-6 mb-4">

        <div
        class="card shadow">

            <div
            class="card-header py-3">

                <h6
                class="m-0 font-weight-bold text-primary">

                    <?= $k->nama_kriteria; ?>

                </h6>

            </div>

            <div
            class="card-body">

                <?php if(
                    empty($hasil)
                ): ?>

                    <div
                    class="alert alert-warning">

                        Belum ada voting

                    </div>

                <?php else: ?>

                    <div
                    class="table-responsive">

                        <table
                        class="table table-bordered">

                            <thead>

                                <tr>

                                    <th>
                                        Ranking
                                    </th>

                                    <th>
                                        Guru
                                    </th>

                                    <th>
                                        Vote
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                            <?php
                            $rank = 1;

                            foreach(
                                $hasil
                                as $h
                            ):
                            ?>

                            <tr>

                                <td width="100">

                                    <?php if(
                                        $rank
                                        == 1
                                    ): ?>

                                        🥇

                                    <?php elseif(
                                        $rank
                                        == 2
                                    ): ?>

                                        🥈

                                    <?php elseif(
                                        $rank
                                        == 3
                                    ): ?>

                                        🥉

                                    <?php else: ?>

                                        <?= $rank; ?>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <img
                                    src="<?= base_url('uploads/guru/'.$h->foto); ?>"
                                    width="50"
                                    class="img-thumbnail mr-2">

                                    <?= $h->nama_guru; ?>

                                </td>

                                <td>

                                    <span
                                    class="badge badge-success">

                                        <?= $h->total_vote; ?>

                                        suara

                                    </span>

                                </td>

                            </tr>

                            <?php
                            $rank++;
                            endforeach;
                            ?>

                            </tbody>

                        </table>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <?php endforeach; ?>

    </div>

</div>