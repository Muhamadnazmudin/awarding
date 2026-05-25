<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

    <?= $this->session
    ->flashdata('success'); ?>

</div>

<?php endif; ?>


<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Monitoring Voting

            <a
            href="<?= site_url('admin/monitoring-voting/reset-all'); ?>"
            class="btn btn-danger btn-sm float-right"
            onclick="return confirm(
            'Yakin reset SEMUA voting siswa?'
            )">

                Reset Semua Voting

            </a>

        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table
            class="table table-bordered"
            id="dataTable">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th width="160">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;

                foreach(
                    $siswa
                    as $s
                ):

                $jumlah_vote =
                $this->db
                ->where(
                    'id_siswa',
                    $s->id_siswa
                )
                ->count_all_results(
                    'voting'
                );

                ?>

                <tr>

                    <td>
                        <?= $no++; ?>
                    </td>

                    <td width="80">

                        <img
                        src="<?= base_url('uploads/siswa/'.$s->foto); ?>"
                        width="60"
                        class="img-thumbnail">

                    </td>

                    <td>

                        <?= $s->nama_siswa; ?>

                    </td>

                    <td>

                        <?= $s->nama_jurusan; ?>

                    </td>

                    <td>

                        <?= $s->nama_kelas; ?>

                    </td>

                    <td>

                        <b>

                        <?= $jumlah_vote; ?>

                        /
                        <?= $total_kriteria; ?>

                        </b>

                    </td>

                    <td>

                        <?php if(
                            $jumlah_vote
                            >=
                            $total_kriteria
                        ): ?>

                            <span
                            class="badge badge-success">

                                Selesai

                            </span>

                        <?php elseif(
                            $jumlah_vote
                            > 0
                        ): ?>

                            <span
                            class="badge badge-warning">

                                Proses

                            </span>

                        <?php else: ?>

                            <span
                            class="badge badge-danger">

                                Belum Vote

                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <a
                        href="<?= site_url('admin/monitoring-voting/reset/'.$s->id_siswa); ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm(
                        'Reset voting siswa ini?'
                        )">

                            Reset Voting

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>