<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6
        class="m-0 font-weight-bold text-primary">

            Tahun Pelajaran

            <button
            class="btn btn-primary btn-sm float-right"
            data-toggle="modal"
            data-target="#modalTambah">

                Tambah Tahun

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
                        <th>Tahun Pelajaran</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th width="180">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    foreach(
                        $tahun
                        as $t
                    ):
                    ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>

                            <?= $t->tahun_pelajaran; ?>

                        </td>

                        <td>

                            <?php if(
                                $t->status
                                == 'aktif'
                            ): ?>

                            <span
                            class="badge badge-success">

                                Aktif

                            </span>

                            <?php else: ?>

                            <span
                            class="badge badge-secondary">

                                Nonaktif

                            </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?= date(
                                'd-m-Y H:i',
                                strtotime(
                                    $t->created_at
                                )
                            ); ?>

                        </td>

                        <td>

                            <button
                            class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#edit<?= $t->id_tahun; ?>">

                                Edit

                            </button>

                            <a
                            href="<?= site_url(
                            'admin/tahun/delete/'
                            .$t->id_tahun
                            ); ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm(
                            'Hapus tahun?'
                            )">

                                Hapus

                            </a>

                        </td>

                    </tr>


                    <!-- MODAL EDIT -->

                    <div
                    class="modal fade"
                    id="edit<?= $t->id_tahun; ?>">

                        <div
                        class="modal-dialog">

                            <form
                            action="<?= site_url(
                            'admin/tahun/update'
                            ); ?>"
                            method="post">

                                <input
                                type="hidden"
                                name="id_tahun"
                                value="<?= $t->id_tahun; ?>">

                                <div
                                class="modal-content">

                                    <div
                                    class="modal-header">

                                        <h5>
                                            Edit Tahun
                                        </h5>

                                    </div>

                                    <div
                                    class="modal-body">

                                        <div
                                        class="form-group">

                                            <label>
                                                Tahun Pelajaran
                                            </label>

                                            <input
                                            type="text"
                                            name="tahun_pelajaran"
                                            class="form-control"
                                            value="<?= $t->tahun_pelajaran; ?>"
                                            required>

                                        </div>

                                        <div
                                        class="form-group">

                                            <label>
                                                Status
                                            </label>

                                            <select
                                            name="status"
                                            class="form-control">

                                                <option
                                                value="aktif"
                                                <?= $t->status == 'aktif' ? 'selected' : ''; ?>>

                                                    Aktif

                                                </option>

                                                <option
                                                value="nonaktif"
                                                <?= $t->status == 'nonaktif' ? 'selected' : ''; ?>>

                                                    Nonaktif

                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                    <div
                                    class="modal-footer">

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

    <div
    class="modal-dialog">

        <form
        action="<?= site_url(
        'admin/tahun/store'
        ); ?>"
        method="post">

            <div
            class="modal-content">

                <div
                class="modal-header">

                    <h5>
                        Tambah Tahun
                    </h5>

                </div>

                <div
                class="modal-body">

                    <div
                    class="form-group">

                        <label>
                            Tahun Pelajaran
                        </label>

                        <input
                        type="text"
                        name="tahun_pelajaran"
                        class="form-control"
                        placeholder="2025/2026"
                        required>

                    </div>

                    <div
                    class="form-group">

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

                <div
                class="modal-footer">

                    <button
                    class="btn btn-primary">

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>