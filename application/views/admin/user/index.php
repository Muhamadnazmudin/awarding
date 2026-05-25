<div class="card shadow mb-4">

    <div class="card-header py-3">

        <h6
        class="m-0 font-weight-bold text-primary">

            Management User

            <button
            class="btn btn-primary btn-sm float-right"
            data-toggle="modal"
            data-target="#modalTambah">

                Tambah Admin

            </button>

        </h6>

    </div>


    <?php if(
        $this->session
        ->flashdata('error')
    ): ?>

    <div class="alert alert-danger m-3">

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

                        <th width="60">
                            No
                        </th>

                        <th>
                            Nama
                        </th>

                        <th>
                            Username
                        </th>

                        <th>
                            Role
                        </th>

                        <th>
                            Last Login
                        </th>

                        <th width="220">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1;

                    foreach(
                        $users
                        as $u
                    ):
                    ?>

                    <tr>

                        <td>
                            <?= $no++; ?>
                        </td>

                        <td>

                            <?= $u->nama; ?>

                            <?php if(
                                $u->id_user
                                == 1
                            ): ?>

                            <span
                            class="badge badge-success">

                                Super Admin

                            </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?= $u->username; ?>

                        </td>

                        <td>

                            <span
                            class="badge badge-primary">

                                <?= ucfirst(
                                    $u->role
                                ); ?>

                            </span>

                        </td>

                        <td>

                            <?=
                            $u->last_login
                            ?
                            date(
                                'd-m-Y H:i',
                                strtotime(
                                    $u->last_login
                                )
                            )
                            :
                            '-';
                            ?>

                        </td>

                        <td>

                            <button
                            class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#edit<?= $u->id_user; ?>">

                                Edit

                            </button>

                            <button
                            class="btn btn-info btn-sm"
                            onclick="resetPassword(
                            <?= $u->id_user; ?>
                            )">

                                Reset Password

                            </button>

                            <?php if(
                                $u->id_user
                                != 1
                            ): ?>

                            <a
                            href="<?= site_url(
                            'admin/user/delete/'
                            .$u->id_user
                            ); ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm(
                            'Hapus admin ini?'
                            )">

                                Hapus

                            </a>

                            <?php endif; ?>

                        </td>

                    </tr>


                    <!-- MODAL EDIT -->

                    <div
                    class="modal fade"
                    id="edit<?= $u->id_user; ?>">

                        <div
                        class="modal-dialog">

                            <form
                            action="<?= site_url(
                            'admin/user/update'
                            ); ?>"
                            method="post">

                                <input
                                type="hidden"
                                name="id_user"
                                value="<?= $u->id_user; ?>">

                                <div
                                class="modal-content">

                                    <div
                                    class="modal-header">

                                        <h5>
                                            Edit Admin
                                        </h5>

                                        <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal">

                                            &times;

                                        </button>

                                    </div>

                                    <div
                                    class="modal-body">

                                        <div
                                        class="form-group">

                                            <label>
                                                Nama
                                            </label>

                                            <input
                                            type="text"
                                            name="nama"
                                            class="form-control"
                                            value="<?= $u->nama; ?>"
                                            required>

                                        </div>

                                        <div
                                        class="form-group">

                                            <label>
                                                Username
                                            </label>

                                            <input
                                            type="text"
                                            name="username"
                                            class="form-control"
                                            value="<?= $u->username; ?>"
                                            required>

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
        'admin/user/store'
        ); ?>"
        method="post">

            <div
            class="modal-content">

                <div
                class="modal-header">

                    <h5>
                        Tambah Admin
                    </h5>

                    <button
                    type="button"
                    class="close"
                    data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div
                class="modal-body">

                    <div
                    class="form-group">

                        <label>
                            Nama
                        </label>

                        <input
                        type="text"
                        name="nama"
                        class="form-control"
                        required>

                    </div>

                    <div
                    class="form-group">

                        <label>
                            Username
                        </label>

                        <input
                        type="text"
                        name="username"
                        class="form-control"
                        required>

                    </div>

                    <div
                    class="form-group">

                        <label>
                            Password
                        </label>

                        <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>

                    </div>

                </div>

                <div
                class="modal-footer">

                    <button
                    class="btn btn-primary">

                        Simpan Admin

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



<script>

function resetPassword(id)
{
    if(
        confirm(
        'Reset password ke admin123 ?'
        )
    )
    {
        window.location =
        '<?= site_url(
        'admin/user/reset-password/'
        ); ?>'
        + id;
    }
}

</script>