<div class="card shadow mb-4">

    <div class="card-header py-3">

    <h6
    class="m-0 font-weight-bold text-primary">

        Data Guru

        <div class="float-right">
        <button
class="btn btn-warning btn-sm"
data-toggle="modal"
data-target="#modalImportFoto">

    <i class="fas fa-images"></i>

    Upload Foto ZIP

</button>
            <a
            href="<?= site_url('admin/guru/template'); ?>"
            class="btn btn-success btn-sm">

                <i class="fas fa-file-excel"></i>

                Download Template

            </a>

            <button
            class="btn btn-info btn-sm"
            data-toggle="modal"
            data-target="#modalImport">

                <i class="fas fa-upload"></i>

                Import Excel

            </button>

            <button
            class="btn btn-primary btn-sm"
            data-toggle="modal"
            data-target="#modalTambah">

                <i class="fas fa-plus"></i>

                Tambah Guru

            </button>

        </div>

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
                        <th>NIK</th>
                        <th>Nama Guru</th>
                        <th>JK</th>
                        <th>Tipe</th>
                        <th>Jurusan</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th width="180">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;
                foreach($guru as $g):
                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td width="80">

                        <img
                        src="<?= base_url('uploads/guru/'.$g->foto); ?>"
                        width="60"
                        class="img-thumbnail">

                    </td>

                    <td><?= $g->nik; ?></td>

                    <td><?= $g->nama_guru; ?></td>

                    <td><?= $g->jk; ?></td>

                    <td>

                        <?php if($g->tipe_guru=='jurusan'): ?>

                            <span class="badge badge-info">
                                Guru Jurusan
                            </span>

                        <?php else: ?>

                            <span class="badge badge-primary">
                                Guru Umum
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>
                        <?= $g->nama_jurusan ?? '-'; ?>
                    </td>

                    <td>
                        <?= $g->no_hp; ?>
                    </td>

                    <td>

                        <?php if($g->status=='aktif'): ?>

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
                        class="btn btn-warning btn-sm"
                        data-toggle="modal"
                        data-target="#edit<?= $g->id_guru; ?>">

                            Edit

                        </button>

                        <a
                        href="<?= site_url('admin/guru/delete/'.$g->id_guru); ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus guru?')">

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
        action="<?= site_url('admin/guru/store'); ?>"
        method="post"
        enctype="multipart/form-data">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>Tambah Guru</h5>

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
                                <label>NIK</label>

                                <input
                                type="text"
                                name="nik"
                                class="form-control"
                                required>
                            </div>

                            <div class="form-group">
                                <label>Nama Guru</label>

                                <input
                                type="text"
                                name="nama_guru"
                                class="form-control"
                                required>
                            </div>

                            <div class="form-group">

                                <label>Jenis Kelamin</label>

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

                            <div class="form-group">

                                <label>Tipe Guru</label>

                                <select
name="tipe_guru"
class="form-control"
required
onchange="toggleJurusan(this.value)">

    <option value="">
        -- Pilih --
    </option>

    <option value="umum">
        Guru Umum
    </option>

    <option value="jurusan">
        Guru Jurusan
    </option>

</select>

                            </div>

                            <div
class="form-group"
id="jurusanTambah"
style="display:none;">

    <label>Jurusan</label>

    <select
    name="id_jurusan"
    class="form-control">

        <option value="">
            Pilih Jurusan
        </option>

        <?php foreach($jurusan as $j): ?>

        <option
        value="<?= $j->id_jurusan; ?>">

            <?= $j->nama_jurusan; ?>

        </option>

        <?php endforeach; ?>

    </select>

</div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Mata Pelajaran
                                </label>

                                <select
                                name="mapel[]"
                                class="form-control"
                                multiple
                                size="6">

                                    <?php foreach($mapel as $m): ?>

                                    <option
                                    value="<?= $m->id_mapel; ?>">

                                        <?= $m->nama_mapel; ?>

                                    </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div class="form-group">
                                <label>No HP</label>

                                <input
                                type="text"
                                name="no_hp"
                                class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>

                                <textarea
                                name="alamat"
                                class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Foto</label>

                                <input
                                type="file"
                                name="foto"
                                class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Status</label>

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

                        Simpan Guru

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- MODAL IMPORT -->

<div
class="modal fade"
id="modalImport">

    <div class="modal-dialog">

        <form
        action="<?= site_url('admin/guru/import'); ?>"
        method="post"
        enctype="multipart/form-data">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>

                        Import Guru Excel

                    </h5>

                    <button
                    type="button"
                    class="close"
                    data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div class="modal-body">

                    <div
                    class="alert alert-info">

                        <b>Format Excel:</b>

                        <hr>

                        tipe_guru :
                        <b>
                        umum / jurusan
                        </b>

                        <br>

                        jk :
                        <b>
                        L / P
                        </b>

                        <br>

                        jurusan :
                        <b>
                        isi nama jurusan
                        </b>

                        <br>

                        mapel :
                        <b>
                        pisahkan koma
                        </b>

                        <br>

                        contoh:

                        <br>

                        <small>

                        Matematika,
                        Bahasa Indonesia

                        </small>

                    </div>

                    <div
                    class="form-group">

                        <label>

                            Upload File Excel

                        </label>

                        <input
                        type="file"
                        name="file"
                        class="form-control"
                        accept=".xlsx,.xls,.csv"
                        required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">

                        Batal

                    </button>

                    <button
                    type="submit"
                    class="btn btn-primary">

                        Import Sekarang

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
<script>

function toggleJurusan(value)
{
    let jurusan =
    document.getElementById(
        'jurusanTambah'
    );

    if(value == 'jurusan')
    {
        jurusan.style.display =
        'block';
    }
    else
    {
        jurusan.style.display =
        'none';
    }
}

</script>

<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

    <?= $this->session
    ->flashdata('success'); ?>

</div>

<?php endif; ?>
<div
class="modal fade"
id="modalImportFoto">

    <div class="modal-dialog">

        <form
        action="<?= site_url('admin/guru/import-foto'); ?>"
        method="post"
        enctype="multipart/form-data">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>

                        Upload Foto Guru (ZIP)

                    </h5>

                </div>

                <div class="modal-body">

                    <div
                    class="alert alert-info">

                        <b>Format:</b>

                        <hr>

                        Nama file foto
                        harus menggunakan

                        <b>NIK Guru</b>

                        <br>

                        contoh:

                        <br>

                        <small>

                        320101010101.jpg

                        <br>

                        320101010102.png

                        </small>

                    </div>

                    <input
                    type="file"
                    name="zip_file"
                    class="form-control"
                    accept=".zip"
                    required>

                </div>

                <div class="modal-footer">

                    <button
                    class="btn btn-primary">

                        Upload Foto

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>