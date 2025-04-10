@extends("layout.app")

@section("page-title", "Dashboard")

@section("app")
    <x-sidebar current="dashboard"/>

    <div class="main-panel">
        <!-- navbar -->
        <x-navbar/>
        
        <div class="container" style="margin-top: 69px;">
            <div class="page-inner">
                <!-- header -->
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{route('dashboard')}}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <x-card title="Empleados" value="{{$totalEmployees}}" icon="fas fa-users" iconColor="icon-primary"/>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <x-card title="Periodos" value="{{$totalPeriods}}" icon="fas fa-calendar" iconColor="icon-info"/>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <x-card title="Total Salarios" value="${{$totalSalaries}}" icon="fas fa-money-bill" iconColor="icon-success"/>
                    </div>
                </div>

                <!-- content -->
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card card-round shadow">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">Devengos</div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="chart_1" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card card-round shadow">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">Horas</div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="chart_2" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    $(() => {
        const data = [
            { year: 'AFP Empleado', count: "{{$totalEmpAFP}}" },
            { year: 'AFP Patronal', count: "{{$totalEmpISSS}}" },
            { year: 'ISSS Empleado', count: "{{$totalPatAFP}}" },
            { year: 'ISSS Patronal', count: "{{$totalPatISSS}}" }
        ];
        
        const chart = new Chart($("#chart_1").get(0).getContext("2d"), {
            type: 'bar',
            data: {
                labels: data.map(row => row.year),
                datasets: [
                    {
                        label: 'Devengos',
                        data: data.map(row => row.count),
                        backgroundColor: [
                            '#ffc107',
                            '#36a2eb',
                            '#ff9f40',
                            '#ff6384'
                        ]
                    }
                ]
            }
        })
    })

    $(() => {
        const data = [
            { year: 'AFP Empleado', count: "{{$totalEmpAFP}}" },
            { year: 'AFP Patronal', count: "{{$totalEmpISSS}}" },
            { year: 'ISSS Empleado', count: "{{$totalPatAFP}}" },
            { year: 'ISSS Patronal', count: "{{$totalPatISSS}}" }
        ];
        
        const chart = new Chart($("#chart_2").get(0).getContext("2d"), {
            type: 'doughnut',
            data: {
                labels: data.map(row => row.year),
                datasets: [
                    {
                        label: 'Devengos',
                        data: data.map(row => row.count)
                    }
                ]
            }
        })
    })
    
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
                    row += `<td>$${parseFloat(sheet.extra_day_hour).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.extra_night_hour).toFixed(2)}</td>`
                    row += `<td>$${parseFloat(sheet.night_hour).toFixed(2)}</td>`
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
