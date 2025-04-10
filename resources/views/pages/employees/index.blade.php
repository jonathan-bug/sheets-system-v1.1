@extends("layout.app")

@section("page-title", "Empleados")

@section("app")
    <x-sidebar current="employees"/>
    <div class="main-panel">
        <x-navbar/>
        
        <div class="container" style="margin-top: 69px;">
            <div class="page-inner">
                <!-- header -->
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Gestionar Empleados</h3>
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
                            <a href="#">Empleados</a>
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
                        <table class="employees-table table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>DUI</th>
                                    <th>Primer Nombre</th>
                                    <th>Segundo Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Fecha. Nacimiento</th>
                                    <th>Fecha. Contratación</th>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Información Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        
                        <div class="modal-alert alert alert-warning shadow-sm visually-hidden">
                            <ul class="m-0 text-warning">
                            </ul>
                        </div>
                        
                        <label class="form-label" for="">DUI</label>
                        <input class="form-control" name="dui" type="text" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Primer Nombre</label>
                        <input class="form-control" name="first_name" type="text" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Segundo Nombre</label>
                        <input class="form-control" name="second_name" type="text" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Primer Apellido</label>
                        <input class="form-control" name="first_lastname" type="text" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Segundo Apellido</label>
                        <input class="form-control" name="second_lastname" type="text" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Fecha. Nacimiento</label>
                        <input class="form-control" name="birth_date" type="date" value=""/>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="">Fecha. Contratación</label>
                        <input class="form-control" name="hiring_date" type="date" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn-add-employee btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    // modify employee
    function modifyEmployee(dui) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.employees.find')}}",
            data: {
                dui
            },
            success: (response) => {
                $("input[name='dui']").prop("readonly", true)
                $("input[name='dui']").val(dui)
                
                $("input[name='first_name']").val(response.record.first_name)
                $("input[name='second_name']").val(response.record.second_name)
                $("input[name='first_lastname']").val(response.record.first_lastname)
                $("input[name='second_lastname']").val(response.record.second_lastname)
                $("input[name='birth_date']").val(response.record.birth_date)
                $("input[name='hiring_date']").val(response.record.hiring_date)

                $("#modal").modal("show")
            }
        })
    }
    
    // delete employee
    function deleteEmployee(dui) {
        $.ajax({
            type: "DELETE",
            dataType: "json",
            url: "{{route('api.employees.destroy')}}",
            data: {
                "dui": dui
            },
            success: (response) => {
                Swal.fire({
                    title: "¡Exito!",
                    text: "Cambios Aplicados",
                    icon: "success"
                });
                fetchEmployees()
            }
        })
    }
    
    // fetch employees    
    function fetchEmployees() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.employees.index')}}",
            success: (response) => {
                $(".employees-table")
                    .find("tbody")
                    .html("")
                
                response.forEach(employee => {
                    let row = ""
                    let salaries_url = "{{route('salaries', '-')}}".replace("-", employee.dui)
                    let hours_url = "{{route('hours', '-')}}".replace("-", employee.dui)
                    let bonus_url = "{{route('bonus', '-')}}".replace("-", employee.dui)
                    
                    row += "<tr>"
                    row += `<td>${employee.dui}</td>`
                    row += `<td>${employee.first_name}</td>`
                    row += `<td>${employee.second_name}</td>`
                    row += `<td>${employee.first_lastname}</td>`
                    row += `<td>${employee.second_lastname}</td>`
                    row += `<td>${employee.birth_date}</td>`
                    row += `<td>${employee.hiring_date}</td>`
                    row += `<td class="d-flex gap-2 justify-content-end">`
                    row += `<button class="btn btn-warning btn-icon" onclick="modifyEmployee('${employee.dui}')">`
                    row += `<i class="fa fa-pen"></i>`
                    row += `</button>`
                    row += `<button class="btn btn-danger btn-icon" onclick="deleteEmployee('${employee.dui}')">`
                    row += `<i class="fa fa-trash"></i>`
                    row += `</button>`
                    row += `<a class="btn btn-success btn-icon" href="${salaries_url}">`
                    row += `<i class="fa fa-money-bill"></i>`
                    row += `</a>`
                    row += `<a class="btn btn-primary btn-icon" href="${hours_url}">`
                    row += `<i class="fa fa-clock"></i>`
                    row += `</a>`
                    row += `</a>`
                    row += `<a class="btn btn-secondary btn-icon" href="${bonus_url}">`
                    row += `<i class="fa fa-money-check"></i>`
                    row += `</a>`
                    row += `</td>`
                    row += "</tr>"
                    
                    $(".employees-table")
                        .find("tbody")
                        .append(row)
                })

                $(".btn-export").click(() => {
                    arrayToCsv(response)
                })
            }
        })
    }
    
    $(() => {        
        // token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        })

        fetchEmployees()

        // add employee
        $(".btn-add-employee").click(() => {
            const data = {
                "dui": $("input[name='dui']").val(),
                "first_name": $("input[name='first_name']").val(),
                "second_name": $("input[name='second_name']").val(),
                "first_lastname": $("input[name='first_lastname']").val(),
                "second_lastname": $("input[name='second_lastname']").val(),
                "birth_date": $("input[name='birth_date']").val(),
                "hiring_date": $("input[name='hiring_date']").val(),
            }

            if($("input[name='dui']").prop("readonly")) {
                $.ajax({
                    type: "PUT",
                    dataType: "json",
                    url: "{{route('api.employees.update')}}",
                    data: data,
                    success: (response) => {
                        if(response.status == 200) {
                            $(".modal-alert").addClass("visually-hidden")
                            $(".modal").modal("hide")
                            $(".modal").find("input").val("")
                            Swal.fire({
                                title: "¡Exito!",
                                text: "Cambios Aplicados",
                                icon: "success"
                            });
                            $("input[name='dui']").prop("readonly", false)
                            fetchEmployees()
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
                    type: "POST",
                    dataType: "json",
                    url: "{{route('api.employees.store')}}",
                    data: data,
                    success: (response) => {
                        if(response.status == 200) {
                            $(".modal-alert").addClass("visually-hidden")
                            $(".modal").modal("hide")
                            $(".modal").find("input").val("")
                            Swal.fire({
                                title: "¡Exito!",
                                text: "Cambios Aplicados",
                                icon: "success"
                            });
                            fetchEmployees()
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
        })
    })
</script>
@endpush
