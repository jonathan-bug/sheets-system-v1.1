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

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            function arrayToCsv(array, filename = 'data.csv') {
                if (!Array.isArray(array) || array.length === 0) {
                    console.error("El input debe ser un array no vacío.");
                    return;
                }

                // Determinar las cabeceras del CSV a partir de la primera fila del array
                const headers = Object.keys(array[0]);

                // Convertir las cabeceras a una fila CSV
                const headerRow = headers.join(',');

                // Convertir cada objeto del array a una fila CSV
                const dataRows = array.map(item => {
                    return headers.map(header => {
                        let value = item[header];
                        // Escapar comas dentro de los valores y encerrar en comillas
                        if (typeof value === 'string' && value.includes(',')) {
                            value = `"${value.replace(/"/g, '""')}"`; // Escape double quotes as well
                        }
                        return value;
                    }).join(',');
                });

                // Unir la fila de cabeceras y las filas de datos con saltos de línea
                const csvString = [headerRow, ...dataRows].join('\n');

                // Crear un objeto Blob para descargar el archivo
                const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });

                // Crear un elemento 'a' para la descarga
                const link = document.createElement('a');

                // Crear una URL para el Blob
                const url = URL.createObjectURL(blob);
                link.href = url;
                link.download = filename;
                document.body.appendChild(link);
                link.click();

                // Limpiar la URL creada
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
            }
        </script>
        
        @stack("scripts")
    </body>
</html>
