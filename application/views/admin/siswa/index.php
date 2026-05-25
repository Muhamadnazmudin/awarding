<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Data Siswa

            <button
            class="btn btn-primary btn-sm float-right"
            data-toggle="modal"
            data-target="#modalTambah">

                Tambah Siswa

            </button>

        </h6>
<a
href="<?= site_url('admin/siswa/template'); ?>"
class="btn btn-success btn-sm">

    Download Template

</a>

<button
class="btn btn-info btn-sm"
data-toggle="modal"
data-target="#modalImport">

    Import Excel

</button>
    </div>
    
<?php if($this->session->flashdata('error')): ?>

<div class="alert alert-danger">

    <?= $this->session
    ->flashdata('error'); ?>

</div>

<?php endif; ?>
    <div class="card-body">

        <div class="table-responsive">

            <table
            class="table table-bordered"
            id="dataTable">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th width="180">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;
                foreach($siswa as $s):
                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td width="80">

                        <img
                        src="<?= base_url('uploads/siswa/'.$s->foto); ?>"
                        width="60"
                        class="img-thumbnail">

                    </td>

                    <td><?= $s->nis; ?></td>

                    <td><?= $s->nisn; ?></td>

                    <td><?= $s->nama_siswa; ?></td>

                    <td><?= $s->jk; ?></td>

                    <td><?= $s->nama_jurusan; ?></td>

                    <td><?= $s->nama_kelas; ?></td>

                    <td>

                        <?php if($s->status=='aktif'): ?>

                            <span class="badge badge-success">
                                Aktif
                            </span>

                        <?php else: ?>

                            <span class="badge badge-danger">
                                Nonaktif
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <button
                        class="btn btn-info btn-sm"
                        onclick="resetPassword(
                        '<?= $s->id_siswa; ?>'
                        )">

                            Reset Password

                        </button>

                        <a
                        href="<?= site_url('admin/siswa/delete/'.$s->id_siswa); ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus siswa?')">

                            Hapus

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>



<!-- MODAL TAMBAH -->

<div
class="modal fade"
id="modalTambah">

    <div class="modal-dialog modal-lg">

        <form
        action="<?= site_url('admin/siswa/store'); ?>"
        method="post"
        enctype="multipart/form-data">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>
                        Tambah Siswa
                    </h5>

                    <button
                    type="button"
                    class="close"
                    data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>NIS</label>

                                <input
                                type="text"
                                name="nis"
                                class="form-control"
                                required>

                            </div>

                            <div class="form-group">

                                <label>NISN</label>

                                <input
                                type="text"
                                name="nisn"
                                class="form-control"
                                required>

                            </div>

                            <div class="form-group">

                                <label>NIK</label>

                                <input
                                type="text"
                                name="nik"
                                class="form-control">

                            </div>

                            <div class="form-group">

                                <label>
                                    Nama Siswa
                                </label>

                                <input
                                type="text"
                                name="nama_siswa"
                                class="form-control"
                                required>

                            </div>

                            <div class="form-group">

                                <label>
                                    Jenis Kelamin
                                </label>

                                <select
                                name="jk"
                                class="form-control"
                                required>

                                    <option value="">
                                        -- Pilih --
                                    </option>

                                    <option value="L">
                                        Laki-Laki
                                    </option>

                                    <option value="P">
                                        Perempuan
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Jurusan
                                </label>

                                <select
                                name="id_jurusan"
                                id="jurusan"
                                class="form-control"
                                required>

                                    <option value="">
                                        Pilih Jurusan
                                    </option>

                                    <?php
                                    foreach(
                                        $jurusan
                                        as $j
                                    ):
                                    ?>

                                    <option
                                    value="<?= $j->id_jurusan; ?>">

                                        <?= $j->nama_jurusan; ?>

                                    </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div class="form-group">

                                <label>
                                    Kelas
                                </label>

                                <select
                                name="id_kelas"
                                id="kelas"
                                class="form-control"
                                required>

                                    <option value="">
                                        Pilih Kelas
                                    </option>

                                    <?php
                                    foreach(
                                        $kelas
                                        as $k
                                    ):
                                    ?>

                                    <option
                                    value="<?= $k->id_kelas; ?>"
                                    data-jurusan="<?= $k->id_jurusan; ?>">

                                        <?= $k->nama_kelas; ?>

                                    </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div class="form-group">

                                <label>
                                    Foto
                                </label>

                                <input
                                type="file"
                                name="foto"
                                class="form-control">

                            </div>

                            <div class="form-group">

                                <label>
                                    Status
                                </label>

                                <select
                                name="status"
                                class="form-control">

                                    <option value="aktif">
                                        Aktif
                                    </option>

                                    <option value="nonaktif">
                                        Nonaktif
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                    type="submit"
                    class="btn btn-primary">

                        Simpan Siswa

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



<script>

$('#jurusan').change(function(){

    let jurusan =
    $(this).val();

    $('#kelas option')
    .hide();

    $('#kelas option:first')
    .show();

    $('#kelas option').each(function(){

        if(
            $(this)
            .data('jurusan')
            == jurusan
        )
        {
            $(this)
            .show();
        }

    });

});

function resetPassword(id)
{
    if(
        confirm(
            'Reset password siswa ke NISN?'
        )
    )
    {
        window.location =
        '<?= site_url('admin/siswa/reset_password/'); ?>'
        + id;
    }
}

</script>
<div
class="modal fade"
id="modalImport">

    <div class="modal-dialog">

        <form
        action="<?= site_url('admin/siswa/import'); ?>"
        method="post"
        enctype="multipart/form-data">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>
                        Import Siswa
                    </h5>

                </div>

                <div class="modal-body">

                    <div
                    class="alert alert-info">

                        Jurusan & kelas
                        harus sama persis
                        dengan database.

                    </div>

                    <input
                    type="file"
                    name="file"
                    class="form-control"
                    required>

                </div>

                <div class="modal-footer">

                    <button
                    class="btn btn-primary">

                        Import

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>