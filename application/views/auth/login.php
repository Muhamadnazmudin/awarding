<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body style="background:#f5f5f5;">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h4>LOGIN ADMIN</h4>
                </div>

                <div class="card-body">

                    <?php if($this->session->flashdata('error')) : ?>

                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>

                    <?php endif; ?>

                    <form action="<?php echo site_url('auth/login'); ?>" method="post">

                        <div class="form-group">
                            <label>Username</label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                                autocomplete="username">
                        </div>

                        <div class="form-group">
                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                                autocomplete="current-password">
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary btn-block">

                            LOGIN

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>