@extends("layout.app")

@section("app")
    <x-sidebar current="periods"/>

    <div class="main-panel">
        <!-- navbar -->
        <x-navbar/>
        
        <div class="container" style="margin-top: 69px;">
            <div class="page-inner">
                <!-- header -->
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Gestionar Periodos</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Periodos</a>
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
                                <button class="btn btn-label-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modal">
                                    <span>Nuevo</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 table-responsive">
                        <!-- table -->
                        <table class="periods-table table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Mes</th>
                                    <th>Año</th>
                                    <th>Controles</th>
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

    <!-- modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Información Periodo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control visually-hidden" name="id" type="text" value=""/>
                    
                    <div class="form-group">
                        <div class="modal-alert alert alert-warning shadow-sm visually-hidden">
                            <ul class="m-0 text-warning">
                            </ul>
                        </div>
                        <label class="form-label" for="">Mes</label>
                        <input class="form-control" name="month" type="text" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Año</label>
                        <input class="form-control" name="year" type="text" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-add-period btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    // modify period
    function modifyPeriod(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.periods.find', '-')}}".replace("-", id),
            success: (response) => {
                $("input[name='id']").val(response.record.id)
                $("input[name='month']").val(response.record.month)
                $("input[name='year']").val(response.record.year)

                $("#modal").modal("show")
            }
        })
    }
    
    // delete period
    function deletePeriod(id) {
        $.ajax({
            type: "DELETE",
            dataType: "json",
            url: "{{route('api.periods.destroy', '-')}}".replace("-", id),
            success: (response) => {
                $(".periods-table").find("tbody").html("")
                Swal.fire({
                    title: "¡Exito!",
                    text: "Cambios Aplicados",
                    icon: "success"
                });
                fetchPeriods()
            }
        })
    }

    // store period
    function storePeriod() {
        let data = {
            "month": $("input[name='month']").val(),
            "year": $("input[name='year']").val()
        }

        if($("input[name='id']").val() == "") {
            $("#modal").find("input").val("")
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('api.periods.store')}}",
                data: data,
                success: (response) => {
                    console.log(response)
                    if(response.status == 200) {
                        $(".periods-table").find("tbody").html("")
                        $("#modal").find("input").val("")
                        $(".modal-alert").addClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        $("#modal").modal("hide")
                        Swal.fire({
                            title: "¡Exito!",
                            text: "Cambios Aplicados",
                            icon: "success"
                        });
                        fetchPeriods()
                    }else {
                        $(".modal-alert").removeClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        
                        Object.values(response.errors).forEach((error) => {
                            $(".modal-alert").find("ul").append(`<li>${error[0]}</li>`)
                        })
                    }
                }
            })
        }else {
            $.ajax({
                type: "PUT",
                dataType: "json",
                url: "{{route('api.periods.update', '-')}}".replace("-", $("input[name='id']").val()),
                data: data,
                success: (response) => {
                    if(response.status == 200) {
                        $(".periods-table").find("tbody").html("")
                        $("#modal").find("input").val("")
                        $(".modal-alert").addClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        $("#modal").modal("hide")
                        $("input[name='id']").val("")
                        Swal.fire({
                            title: "¡Exito!",
                            text: "Cambios Aplicados",
                            icon: "success"
                        });
                        fetchPeriods()
                    }else {
                        $(".modal-alert").removeClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        
                        Object.values(response.errors).forEach((error) => {
                            $(".modal-alert").find("ul").append(`<li>${error[0]}</li>`)
                        })
                    }
                }
            })
        }
    }
    
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        }
    })

    function fetchPeriods() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.periods.index')}}",
            success: (response) => {
                response.forEach((period) => {
                    let row = ""
                    row += "<tr>"
                    row += `<td>${period.month}</td>`
                    row += `<td>${period.year}</td>`
                    row += `<td class="d-flex gap-2 justify-content-end">`
                    row += `<button class="btn btn-warning btn-icon" onclick="modifyPeriod('${period.id}')">`
                    row += `<i class="fa fa-pen"></i>`
                    row += `</button>`
                    row += `<button class="btn btn-danger btn-icon" onclick="deletePeriod('${period.id}')">`
                    row += `<i class="fa fa-trash"></i>`
                    row += `</button>`
                    row += `</td>`
                    row += "</tr>"

                    $(".periods-table").find("tbody").append(row)
                })

                $(".btn-export").click(() => {
                    arrayToCsv(response)
                })
            }
        })
    }

    $(() => {
        fetchPeriods();

        $(".btn-add-period").click(() => {
            storePeriod()
        })
    })
</script>
@endpush
