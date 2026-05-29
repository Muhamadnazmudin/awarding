<div class="container-fluid">

    <h3
    class="mb-4
    font-weight-bold
    text-primary">

        <?= $kriteria
        ->nama_kriteria; ?>

    </h3>

    <div class="row">

        <?php
        foreach(
            $guru
            as $g
        ):
        ?>

        <div
        class="col-xl-3
        col-lg-4
        col-md-6
        mb-4">

            <div
            class="card shadow-sm border-0 guru-card h-100">

                <div
                class="card-body text-center d-flex flex-column">

                    <!-- FOTO -->

                    <div
                    class="guru-foto-wrapper">

                        <img
                        src="<?= base_url(
                        'uploads/guru/'
                        .$g->foto
                        ); ?>"

                        class="guru-foto">

                    </div>

                    <!-- NAMA -->

                    <h5
                    class="mt-3 font-weight-bold guru-nama">

                        <?= $g
                        ->nama_guru; ?>

                    </h5>

                    <!-- TIPE -->

                    <?php if(
                        $g->tipe_guru
                        ==
                        'jurusan'
                    ): ?>

                        <span
                        class="badge badge-info mb-3">

                            Guru Jurusan

                        </span>

                    <?php else: ?>

                        <span
                        class="badge badge-primary mb-3">

                            Guru Umum

                        </span>

                    <?php endif; ?>


                    <div
                    class="mt-auto">

                       <form
id="formVote<?= $g->id_guru; ?>"
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
type="button"
class="btn btn-primary btn-block btn-lg"
onclick="konfirmasiVote(
<?= $kriteria->id_kriteria; ?>,
<?= $g->id_guru; ?>,
'<?= addslashes($g->nama_guru); ?>',
'<?= $g->jk; ?>'
)">

    <i class="fas fa-check-circle"></i>

    PILIH GURU

</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>


<style>

.guru-card{
    border-radius:20px;
    transition:.2s;
}

.guru-card:hover{
    transform:translateY(-5px);
    box-shadow:
    0 10px 25px rgba(
        0,0,0,0.15
    ) !important;
}

.guru-foto-wrapper{
    width:150px;
    height:180px;
    margin:auto;
    overflow:hidden;
    border-radius:18px;
    border:4px solid #f1f1f1;
    box-shadow:
    0 5px 15px rgba(
        0,0,0,0.12
    );
    background:#fff;
}

.guru-foto{
    width:100%;
    height:100%;
    object-fit:cover;
}

.guru-nama{
    min-height:50px;
    font-size:18px;
}

</style>
<script>

function konfirmasiVote(
    id_kriteria,
    id_guru,
    nama_guru,
    jk
)
{
    let panggilan =
        jk === 'L'
        ? 'Bapak'
        : 'Ibu';

    Swal.fire({

        title:
        'Pilih ' +
        panggilan +
        ' ' +
        nama_guru +
        '?',

        html:
        'Pilihan yang sudah disimpan <b>tidak dapat diubah</b>.',

        icon:
        'question',

        showCancelButton:
        true,

        confirmButtonText:
        'Ya, Pilih ' +
        panggilan,

        cancelButtonText:
        'Batal',

        reverseButtons:
        true,

        confirmButtonColor:
        '#4e73df',

        cancelButtonColor:
        '#858796',

        background:
        '#fff',

        customClass: {

            popup:
            'rounded-lg shadow',

            confirmButton:
            'btn btn-primary px-4',

            cancelButton:
            'btn btn-secondary px-4'
        }

    }).then((result)=>{

        if(result.isConfirmed)
        {
            document
            .getElementById(
                'formVote'
                + id_guru
            )
            .submit();
        }

    });
}

</script>