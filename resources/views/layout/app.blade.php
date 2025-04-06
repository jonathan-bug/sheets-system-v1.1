<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <title>Iniciar Sesión</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>

        <!-- Fonts and icons -->
        <script src="{{url('theme/js/plugin/webfont/webfont.min.js')}}"></script>
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
                    urls: ["{{url('theme/css/fonts.min.css')}}"],
                },
                active: function () {
                    sessionStorage.fonts = true;
                },
            });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{url('theme/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{url('theme/css/plugins.min.css')}}" />
        <link rel="stylesheet" href="{{url('theme/css/kaiadmin.css')}}" />
        @stack("styles")
    </head>
    <body>
        <div class="wrapper">
            @yield("app")
        </div>

        <!--   Core JS Files   -->
        <script src="{{url('theme/js/core/jquery-3.7.1.min.js')}}"></script>
        <script src="{{url('theme/js/core/popper.min.js')}}"></script>
        <script src="{{url('theme/css/kaiadmin.css')}}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{url('theme/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

        <!-- Chart JS -->
        <script src="{{url('theme/js/plugin/chart.js/chart.min.js')}}"></script>

        <!-- jQuery Sparkline -->
        <script src="{{url('theme/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- Chart Circle -->
        <script src="{{url('theme/js/plugin/chart-circle/circles.min.js')}}"></script>

        <!-- Datatables -->
        <script src="{{url('theme/js/plugin/datatables/datatables.min.js')}}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{url('theme/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

        <!-- jQuery Vector Maps -->
        <script src="{{url('theme/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
        <script src="{{url('theme/js/plugin/jsvectormap/world.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="{{url('theme/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

        <!-- Kaiadmin JS -->
        <script src="{{url('theme/js/kaiadmin.min.js')}}"></script>

        @stack("scripts")
    </body>
</html>
