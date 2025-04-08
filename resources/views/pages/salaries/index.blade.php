@extends("layout.app")

@section("app")
    <x-sidebar current="employees"/>

    <div class="main-panel">
        <!-- navbar -->
        <x-navbar/>
        
        <div class="container" style="margin-top: 69px;">
            <div class="page-inner">
                <!-- header -->
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Gestionar Salarios</h3>
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
                            <a href="{{route('employees')}}">Empleados</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Salarios</a>
                        </li>
                    </ul>
                </div>

                <!-- content -->
                <div class="card card-round shadow-sm">

                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title"></div>
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
                        <table class="salaries-table table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Monto</th>
                                    <th>Ultimo</th>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Información Salario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control visually-hidden" name="id" type="text" value=""/>
                    <input class="form-control visually-hidden" name="employee_dui" type="text" value="{{$employee->dui}}"/>
                    
                    <div class="form-group">
                        <div class="modal-alert alert alert-warning shadow-sm visually-hidden">
                            <ul class="m-0 text-warning">
                            </ul>
                        </div>
                        <label class="form-label" for="">Monto</label>
                        <input class="form-control" name="amount" type="text" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-add-salary btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    // modify period
    function modifySalary(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.salaries.find', '-')}}".replace("-", id),
            success: (response) => {
                $("input[name='id']").val(response.record.id)
                $("input[name='amount']").val(response.record.amount)
                $("input[name='last']").val(response.record.last)

                $("#modal").modal("show")
            }
        })
    }
    
    // delete salary
    function deleteSalary(id) {
        $.ajax({
            type: "DELETE",
            dataType: "json",
            url: "{{route('api.salaries.destroy', '-')}}".replace("-", id),
            success: (response) => {
                $(".salaries-table").find("tbody").html("")
                Swal.fire({
                    title: "¡Exito!",
                    text: "Cambios Aplicados",
                    icon: "success"
                });
                fetchSalaries()
            }
        })
    }

    // store salary
    function storeSalary() {
        let data = {
            "employee_dui": $("input[name='employee_dui']").val(),
            "amount": $("input[name='amount']").val()
        }

        if($("input[name='id']").val() == "") {
            $("#modal").find("input[name='amount']").val("")
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('api.salaries.store')}}",
                data: data,
                success: (response) => {
                    console.log(response)
                    if(response.status == 200) {
                        $(".salaries-table").find("tbody").html("")
                        $("#modal").find("input[name='amount']").val("")
                        $(".modal-alert").addClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        $("#modal").modal("hide")
                        Swal.fire({
                            title: "¡Exito!",
                            text: "Cambios Aplicados",
                            icon: "success"
                        });
                        fetchSalaries()
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
                url: "{{route('api.salaries.update', '-')}}".replace("-", $("input[name='id']").val()),
                data: data,
                success: (response) => {
                    if(response.status == 200) {
                        $(".salaries-table").find("tbody").html("")
                        $("#modal").find("input[name='amount']").val("")
                        $(".modal-alert").addClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        $("#modal").modal("hide")
                        $("input[name='id']").val("")
                        Swal.fire({
                            title: "¡Exito!",
                            text: "Cambios Aplicados",
                            icon: "success"
                        });
                        fetchSalaries()
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

    function fetchSalaries() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.salaries.index', '-')}}".replace("-", "{{$employee->dui}}"),
            success: (response) => {
                console.log(response)
                response.forEach((salary) => {
                    let row = ""
                    row += "<tr>"
                    row += `<td>$${salary.amount}</td>`
                    row += `<td>${salary.last}</td>`
                    row += `<td class="d-flex gap-2 justify-content-end">`
                    row += `<button class="btn btn-warning btn-icon" onclick="modifySalary('${salary.id}')">`
                    row += `<i class="fa fa-pen"></i>`
                    row += `</button>`
                    row += `<button class="btn btn-danger btn-icon" onclick="deleteSalary('${salary.id}')">`
                    row += `<i class="fa fa-trash"></i>`
                    row += `</button>`
                    row += `</td>`
                    row += "</tr>"

                    $(".salaries-table").find("tbody").append(row)
                })

                $(".btn-export").click(() => {
                    arrayToCsv(response)
                })
            }
        })
    }

    $(() => {
        fetchSalaries();

        $(".btn-add-salary").click(() => {
            storeSalary()
        })
    })
</script>
@endpush
