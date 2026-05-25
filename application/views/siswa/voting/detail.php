<div class="container-fluid">

    <h3 class="mb-4">

        <?= $kriteria->nama_kriteria; ?>

    </h3>

    <div class="row">

        <?php foreach($guru as $g): ?>

        <div
        class="col-md-4 mb-4">

            <div
            class="card shadow text-center">

                <div
                class="card-body">

                    <img
                    src="<?= base_url('uploads/guru/'.$g->foto); ?>"
                    width="120"
                    class="img-thumbnail rounded-circle mb-3">

                    <h5>

                        <?= $g->nama_guru; ?>

                    </h5>

                    <small>

                        <?= ucfirst($g->tipe_guru); ?>

                    </small>

                    <hr>

                    <form
                    action="<?= site_url('siswa/voting/store'); ?>"
                    method="post">

                        <input
                        type="hidden"
                        name="id_kriteria"
                        value="<?= $kriteria->id_kriteria; ?>">

                        <input
                        type="hidden"
                        name="id_guru"
                        value="<?= $g->id_guru; ?>">

                        <button
                        class="btn btn-primary btn-block"
                        onclick="return confirm('Pilih guru ini?')">

                            PILIH GURU

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>