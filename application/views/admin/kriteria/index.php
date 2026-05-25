<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

    <?= $this->session
    ->flashdata('success'); ?>

</div>

<?php endif; ?>


<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6 class="m-0 font-weight-bold text-primary">

            Data Kriteria Penghargaan

            <button
            class="btn btn-primary btn-sm float-right"
            data-toggle="modal"
            data-target="#modalTambah">

                Tambah Kriteria

            </button>

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
                        <th>Nama Kriteria</th>
                        <th>Tipe Guru</th>
                        <th>Jurusan</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th width="180">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <tbody>

                <?php
                $no = 1;
                foreach($kriteria as $k):
                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>
                        <?= $k->nama_kriteria; ?>
                    </td>

                    <td>

                        <?php if($k->tipe_guru=='jurusan'): ?>

                            <span class="badge badge-info">
                                Guru Jurusan
                            </span>

                        <?php elseif($k->tipe_guru=='umum'): ?>

                            <span class="badge badge-primary">
                                Guru Umum
                            </span>

                        <?php else: ?>

                            <span class="badge badge-dark">
                                Semua Guru
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>
                        <?= $k->nama_jurusan ?? '-'; ?>
                    </td>

                    <td>

                        <?php
                        if($k->jk=='L')
                        {
                            echo 'Laki-Laki';
                        }
                        elseif($k->jk=='P')
                        {
                            echo 'Perempuan';
                        }
                        else
                        {
                            echo '-';
                        }
                        ?>

                    </td>

                    <td>

                        <?php if($k->status=='aktif'): ?>

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
                        data-target="#edit<?= $k->id_kriteria; ?>">

                            Edit

                        </button>

                        <a
                        href="<?= site_url('admin/kriteria/delete/'.$k->id_kriteria); ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus kriteria?')">

                            Hapus

                        </a>

                    </td>

                </tr>


                <!-- MODAL EDIT -->

                <div
                class="modal fade"
                id="edit<?= $k->id_kriteria; ?>">

                    <div class="modal-dialog">

                        <form
                        action="<?= site_url('admin/kriteria/update'); ?>"
                        method="post">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5>
                                        Edit Kriteria
                                    </h5>

                                </div>

                                <div class="modal-body">

                                    <input
                                    type="hidden"
                                    name="id_kriteria"
                                    value="<?= $k->id_kriteria; ?>">

                                    <div class="form-group">

                                        <label>
                                            Nama Kriteria
                                        </label>

                                        <input
                                        type="text"
                                        name="nama_kriteria"
                                        class="form-control"
                                        value="<?= $k->nama_kriteria; ?>"
                                        required>

                                    </div>

                                    <div class="form-group">

                                        <label>
                                            Tipe Guru
                                        </label>

                                        <select
                                        name="tipe_guru"
                                        class="form-control tipeGuruEdit">

                                            <option
                                            value="semua"
                                            <?= ($k->tipe_guru=='semua') ? 'selected' : ''; ?>>

                                                Semua Guru

                                            </option>

                                            <option
                                            value="umum"
                                            <?= ($k->tipe_guru=='umum') ? 'selected' : ''; ?>>

                                                Guru Umum

                                            </option>

                                            <option
                                            value="jurusan"
                                            <?= ($k->tipe_guru=='jurusan') ? 'selected' : ''; ?>>

                                                Guru Jurusan

                                            </option>

                                        </select>

                                    </div>

                                    <div
                                    class="form-group jurusanEdit"
                                    style="<?= ($k->tipe_guru=='jurusan') ? '' : 'display:none;' ?>">

                                        <label>
                                            Jurusan
                                        </label>

                                        <select
                                        name="id_jurusan"
                                        class="form-control">

                                            <option value="">
                                                Pilih Jurusan
                                            </option>

                                            <?php foreach($jurusan as $j): ?>

                                            <option
                                            value="<?= $j->id_jurusan; ?>"
                                            <?= ($k->id_jurusan==$j->id_jurusan) ? 'selected' : ''; ?>>

                                                <?= $j->nama_jurusan; ?>

                                            </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>
                                            Gender Guru
                                        </label>

                                        <select
                                        name="jk"
                                        class="form-control">

                                            <option value="">
                                                Semua
                                            </option>

                                            <option
                                            value="L"
                                            <?= ($k->jk=='L') ? 'selected' : ''; ?>>

                                                Laki-Laki

                                            </option>

                                            <option
                                            value="P"
                                            <?= ($k->jk=='P') ? 'selected' : ''; ?>>

                                                Perempuan

                                            </option>

                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>Status</label>

                                        <select
                                        name="status"
                                        class="form-control">

                                            <option
                                            value="aktif"
                                            <?= ($k->status=='aktif') ? 'selected' : ''; ?>>

                                                Aktif

                                            </option>

                                            <option
                                            value="nonaktif"
                                            <?= ($k->status=='nonaktif') ? 'selected' : ''; ?>>

                                                Nonaktif

                                            </option>

                                        </select>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button
                                    class="btn btn-primary">

                                        Update

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

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

    <div class="modal-dialog">

        <form
        action="<?= site_url('admin/kriteria/store'); ?>"
        method="post">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>
                        Tambah Kriteria
                    </h5>

                    <button
                    type="button"
                    class="close"
                    data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div class="modal-body">

                    <!-- Nama -->

                    <div class="form-group">

                        <label>
                            Nama Kriteria
                        </label>

                        <input
                        type="text"
                        name="nama_kriteria"
                        class="form-control"
                        placeholder="Contoh: Guru Produktif MPLB Terfavorit"
                        required>

                    </div>


                    <!-- Tipe Guru -->

                    <div class="form-group">

                        <label>
                            Tipe Guru
                        </label>

                        <select
name="tipe_guru"
class="form-control"
id="tipeGuruTambah"
required
onchange="toggleKriteriaTambah()">

                            <option value="">
                                -- Pilih --
                            </option>

                            <option value="semua">
                                Semua Guru
                            </option>

                            <option value="umum">
                                Guru Umum
                            </option>

                            <option value="jurusan">
                                Guru Jurusan
                            </option>

                        </select>

                    </div>


                    <!-- JURUSAN -->

                    <div
                    class="form-group"
                    id="jurusanTambah"
                    style="display:none;">

                        <label>
                            Pilih Jurusan
                        </label>

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


                    <!-- GENDER -->

                    <div
                    class="form-group"
                    id="genderTambah"
                    style="display:none;">

                        <label>
                            Gender Guru
                        </label>

                        <select
                        name="jk"
                        class="form-control">

                            <option value="">
                                Semua
                            </option>

                            <option value="L">
                                Laki-Laki
                            </option>

                            <option value="P">
                                Perempuan
                            </option>

                        </select>

                    </div>


                    <!-- STATUS -->

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

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



<script>

function toggleKriteriaTambah()
{
    let tipe =
    document.getElementById(
        'tipeGuruTambah'
    ).value;

    let jurusan =
    document.getElementById(
        'jurusanTambah'
    );

    let gender =
    document.getElementById(
        'genderTambah'
    );

    // reset
    jurusan.style.display =
    'none';

    gender.style.display =
    'none';

    // Guru Jurusan
    if(tipe == 'jurusan')
    {
        jurusan.style.display =
        'block';
    }

    // Guru Umum
    else if(tipe == 'umum')
    {
        gender.style.display =
        'block';
    }
}

</script>