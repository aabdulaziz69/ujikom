<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - {{ $title }}</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('kaiadmin') }}/assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->

    <script src="{{ asset('kaiadmin') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('kaiadmin') }}/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

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
        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <div class="card col-md-4">
                <form action="{{ route('proses.login') }}" method="POST">
                    @csrf <!-- Menambahkan token CSRF untuk melindungi form -->
                    <div class="card-body d-flex flex-column">
                        <h2 class="text-center">Login</h2>

                        <!-- Menampilkan pesan error secara umum (jika ada) -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="usn" placeholder="Enter Username" required>
                            <!-- Menampilkan pesan error khusus untuk username -->
                            @error('usn')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                            <!-- Menampilkan pesan error khusus untuk password -->
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end btn-submit">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
      <!-- End Custom template -->
    </div>
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
