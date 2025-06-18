<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>tokoonline - Login</title>

    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <style>
        /* Gaya kustom untuk form login agar lebih terpusat dan rapi */
        .login-form-container {
            max-width: 400px;
            margin: 80px auto;
            /* Memberi sedikit ruang di atas dan bawah */
            padding: 30px;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .login-form-container .form-group {
            margin-bottom: 20px;
        }

        .login-form-container label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .login-form-container .form-control {
            border-radius: 3px;
            height: 45px;
        }

        .login-form-container .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 3px;
            background-color: #F8694A;
            /* Warna sesuai template */
            border-color: #F8694A;
        }

        .login-form-container .btn-primary:hover {
            background-color: #B2001F;
            border-color: #B2001F;
        }

        .login-form-container .text-center {
            margin-top: 20px;
        }

        .login-form-container .text-center a {
            color: #F8694A;
            font-weight: 600;
            cursor: pointer;
            /* Menandakan ini bisa diklik */
        }

        /* Gaya untuk form recover password */
        #recoverform {
            display: none;
            /* Sembunyikan secara default */
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .preloader .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #F8694A;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-form-container">
                        <div id="loginform">
                            <h2>Login</h2>
                            <form action="{{ route('backend.login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Masukkan email Anda" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukkan password Anda" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                                {{-- <div class="text-center">
                                    <a id="to-recover">Lupa Password?</a>
                                </div> --}}
                                <div class="text-center" style="margin-top: 10px;">
                                    Belum punya akun? <a href="{{ route('auth.redirect') }}">Sign In</a>
                                </div>
                            </form>
                        </div>

                        <div id="recoverform">
                            <h2>Reset Password</h2>
                            <form action="/password/reset" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="recover_email">Masukkan Email Anda</label>
                                    <input type="email" class="form-control" id="recover_email" name="email"
                                        placeholder="Email terdaftar" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Reset Link</button>
                                <div class="text-center">
                                    <a id="to-login">Kembali ke Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Menginisialisasi semua tooltip pada elemen dengan atribut data-toggle="tooltip"
            $('[data-toggle="tooltip"]').tooltip();

            // Menyembunyikan elemen dengan kelas "preloader" (misalnya, animasi loading)
            // secara perlahan setelah halaman dimuat.
            $(".preloader").fadeOut();

            // ==============================================================
            // Fungsi untuk mengelola tampilan form Login dan Recover Password
            // ==============================================================

            // Ketika elemen dengan ID "to-recover" diklik:
            // 1. Menyembunyikan form login (#loginform) dengan efek slideUp.
            // 2. Menampilkan form recover password (#recoverform) dengan efek fadeIn.
            $("#to-recover").on("click", function() {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });

            // Ketika elemen dengan ID "to-login" diklik:
            // 1. Menyembunyikan form recover password (#recoverform) secara langsung.
            // 2. Menampilkan form login (#loginform) dengan efek fadeIn.
            $("#to-login").click(function() {
                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        });
    </script>
</body>

</html>
