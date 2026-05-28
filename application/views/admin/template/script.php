<script src="<?= base_url('assets/sbadmin2/vendor/jquery/jquery.min.js'); ?>"></script>

<script src="<?= base_url('assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<script src="<?= base_url('assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<script src="<?= base_url('assets/sbadmin2/js/sb-admin-2.min.js'); ?>"></script>

<script src="<?= base_url('assets/sbadmin2/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>

<script src="<?= base_url('assets/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<script>

jQuery(document).ready(function($){

    $('#jurusan').on('change', function(){

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

</body>
</html>