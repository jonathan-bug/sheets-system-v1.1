@extends("layout.app")

@section("page-title", "Hojas")

@section("app")
    <x-sidebar current="sheets"/>

    <div class="main-panel">
        <!-- navbar -->
        <x-navbar/>
        
        <div class="container" style="margin-top: 69px;">
            <div class="page-inner">
                <!-- header -->
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Gestionar Hojas</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{route('dashboard')}}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Hojas</a>
                        </li>
                    </ul>
                </div>

                <!-- content -->
                <div class="card card-round shadow-sm">

                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-tools">
                                <button class="btn-export btn btn-label-secondary btn-sm me-2">
                                    <span>CSV</span>
                                </button>
                                <a class="btn btn-label-primary btn-sm me-2" href="{{route('sheets.generate')}}" target="_blank">
                                    <span>Generar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 table-responsive">
                        <!-- table -->
                        <table class="sheets-table table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>DUI</th>
                                    <th>Primer Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Salario</th>
                                    <th>H.E. Diurna</th>
                                    <th>H.E. Nocturna</th>
                                    <th>H. Nocturna</th>
                                    <th>Vacaciones</th>
                                    <th>Aguinaldo</th>
                                    <th>T. Bonos</th>
                                    <th>T. Descuentos</th>
                                    <th>AFP Empleado</th>
                                    <th>ISSS Empleado</th>
                                    <th>AFP Patrono</th>
                                    <th>ISSS Patrono</th>
                                    <th>T. Empleado</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <!-- end of table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        }
    })

    function fetchSheets(id = null) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.sheets.index')}}",
            success: (response) => {
                $(".sheets-table").find("tbody").html("")
                response.forEach((sheet) => {
                    let row = ""
                    row += "<tr>"
                    row += `<td>${sheet.dui}</td>`
                    row += `<td>${sheet.first_name}</td>`
                    row += `<td>${sheet.first_lastname}</td>`
                    row += `<td>$${parseFloat(sheet.salary).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_extra_day_hour).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_extra_night_hour).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_night_hour).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_vacation).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_aguinald).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.bonuses).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.no_bonuses).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_emp_afp).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_emp_isss).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_pat_afp).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_pat_isss).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.v_employee_total).toFixed(2)}</td>`
                    row += "</tr>"

                    $(".sheets-table").find("tbody").append(row)
                })

                $(".btn-export").click(() => {
                    arrayToCsv(response)
                })
            }
        })
    }

    $(() => {
        fetchSheets("{{session('period')->id}}");
    })
</script>
@endpush
