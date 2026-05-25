<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Sistem</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

        body{
            min-height:100vh;
            background:
                linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
                url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1200&q=80');
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
            font-family:'Segoe UI', sans-serif;
        }

        .login-card{
            width:100%;
            max-width:420px;
            border:none;
            border-radius:20px;
            overflow:hidden;
            background:#ffffff;
        }

        .login-header{
            background:linear-gradient(135deg,#0d6efd,#0056b3);
            color:#fff;
            padding:30px 20px;
            text-align:center;
        }

        .login-header h3{
            font-weight:700;
            margin-bottom:8px;
        }

        .login-header p{
            margin:0;
            font-size:14px;
            opacity:.9;
        }

        .login-body{
            padding:30px;
        }

        .form-control{
            height:48px;
            border-radius:12px;
            padding-left:45px;
        }

        .input-group-custom{
            position:relative;
            margin-bottom:20px;
        }

        .input-group-custom i{
            position:absolute;
            top:14px;
            left:15px;
            color:#6c757d;
            z-index:10;
        }

        .btn-login{
            height:48px;
            border-radius:12px;
            font-weight:600;
            font-size:16px;
        }

        .login-footer{
            text-align:center;
            margin-top:20px;
            font-size:14px;
            color:#666;
        }

        .badge-role{
            background:#e9f2ff;
            color:#0d6efd;
            padding:8px 15px;
            border-radius:30px;
            font-size:13px;
            font-weight:600;
            display:inline-block;
            margin-bottom:15px;
        }

        @media(max-width:576px){

            body{
                padding:15px;
                align-items:flex-start;
            }

            .login-card{
                margin-top:30px;
            }

            .login-header{
                padding:25px 15px;
            }

            .login-body{
                padding:25px 20px;
            }

        }

    </style>
</head>

<body>

    <div class="card shadow-lg login-card">

        <div class="login-header">

            <div class="badge-role">
                Awarding Guru 2026
            </div>

            <h3>Selamat Datang</h3>

            <p>
                Silahkan login untuk masuk ke sistem
            </p>

        </div>

        <div class="login-body">

            <?php if($this->session->flashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <?php echo $this->session->flashdata('error'); ?>

                    <button type="button"
                        class="close"
                        data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            <?php endif; ?>

            <form action="<?php echo site_url('auth/login'); ?>" method="post">

                <div class="input-group-custom">

                    <i class="fas fa-user"></i>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username"
                        required
                        autocomplete="username">

                </div>

                <div class="input-group-custom">

                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                        autocomplete="current-password">

                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-block btn-login">

                    <i class="fas fa-sign-in-alt mr-2"></i>
                    LOGIN

                </button>

            </form>

            <div class="login-footer">

                © <?php echo date('Y'); ?> nazmudev

            </div>

        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>