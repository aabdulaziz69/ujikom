<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - {{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('kaiadmin') }}/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->

    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('kaiadmin') }}/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .login-title {
            font-weight: 700;
            color: #3f51b5;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 30px;
            padding-left: 20px;
            font-size: 15px;
        }

        .btn-login {
            border-radius: 30px;
            padding: 10px;
            font-weight: 600;
        }

        .alert-danger {
            border-radius: 12px;
            font-size: 14px;
        }
    </style>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('kaiadmin') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('kaiadmin') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('kaiadmin') }}/assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('kaiadmin') }}/assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <style>
            .btn-submit {
                overflow: hidden;
                padding: 10px;
            }
        </style>
        <div class="container vh-100 d-flex justify-content-center align-items-center bg-light">
            <div class="container vh-100 d-flex justify-content-center align-items-center">
                <div class="login-card col-md-4">

                    <div class="text-center">
                        <img src="{{ asset('image/ws-removebg-preview.png') }}" alt="Logo" height="120">
                    </div>
                    <form action="{{ route('proses.login') }}" method="POST">
                        @csrf
                        <div class="text-center mb-4">
                            <h2 class="login-title">Login</h2>
                            <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="usn" placeholder="Enter Username"
                                required>
                            @error('usn')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="passwordInput" name="password"
                                    placeholder="Enter Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-login">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </button>
                        </div>

                        {{-- Tambahkan script ini di bawah, atau pindahkan ke @push('scripts') jika kamu pakai blade stack --}}


                    </form>
                </div>
            </div>
        </div>

        <!-- End Custom template -->
    </div>
     <script>
                            document.getElementById('togglePassword').addEventListener('click', function() {
                                const passwordInput = document.getElementById('passwordInput');
                                const eyeIcon = document.getElementById('eyeIcon');

                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    eyeIcon.classList.remove('fa-eye');
                                    eyeIcon.classList.add('fa-eye-slash');
                                } else {
                                    passwordInput.type = 'password';
                                    eyeIcon.classList.remove('fa-eye-slash');
                                    eyeIcon.classList.add('fa-eye');
                                }
                            });
                        </script>
    <!--   Core JS Files   -->
    <script src="{{ asset('kaiadmin') }}/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('kaiadmin') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('kaiadmin') }}/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('kaiadmin') }}/assets/js/kaiadmin.min.js"></script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>
