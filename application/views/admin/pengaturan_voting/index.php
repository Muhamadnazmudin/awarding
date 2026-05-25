<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

    <?= $this->session
    ->flashdata('success'); ?>

</div>

<?php endif; ?>


<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h5 class="m-0 font-weight-bold text-primary">

            Pengaturan Voting

        </h5>

    </div>

    <div class="card-body">

        <form
        action="<?= site_url('admin/pengaturan_voting/save'); ?>"
        method="post">

            <div class="form-group">

                <label>
                    Tahun Pelajaran
                </label>

                <select
                name="id_tahun"
                class="form-control"
                required>

                    <option value="">
                        Pilih Tahun
                    </option>

                    <?php foreach($tahun as $t): ?>

                    <option
                    value="<?= $t->id_tahun; ?>"
                    <?= (!empty($pengaturan->id_tahun)
                    && $pengaturan->id_tahun
                    == $t->id_tahun)
                    ? 'selected' : ''; ?>>

                        <?= $t->tahun_pelajaran; ?>

                    </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Status Voting
                </label>

                <select
                name="voting_status"
                class="form-control">

                    <option
                    value="buka"
                    <?= (!empty($pengaturan->voting_status)
                    && $pengaturan->voting_status
                    == 'buka')
                    ? 'selected' : ''; ?>>

                        Buka

                    </option>

                    <option
                    value="tutup"
                    <?= (!empty($pengaturan->voting_status)
                    && $pengaturan->voting_status
                    == 'tutup')
                    ? 'selected' : ''; ?>>

                        Tutup

                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Tanggal Mulai
                </label>

                <input
                type="date"
                name="tanggal_mulai"
                class="form-control"
                value="<?= $pengaturan->tanggal_mulai ?? ''; ?>">

            </div>


            <div class="form-group">

                <label>
                    Tanggal Selesai
                </label>

                <input
                type="date"
                name="tanggal_selesai"
                class="form-control"
                value="<?= $pengaturan->tanggal_selesai ?? ''; ?>">

            </div>


            <div class="form-group">

                <label>
                    Pengumuman /
                    Keterangan
                </label>

                <textarea
                name="keterangan"
                class="form-control"
                rows="4"><?= $pengaturan->keterangan ?? ''; ?></textarea>

            </div>


            <button
            class="btn btn-primary">

                Simpan Pengaturan

            </button>

        </form>

    </div>

</div>