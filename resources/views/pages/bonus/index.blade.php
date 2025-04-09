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
                    <h3 class="fw-bold mb-3">Gestionar Bonos</h3>
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
                            <a href="#">Bonos</a>
                        </li>
                    </ul>
                </div>

                <!-- content -->
                <div class="card card-round shadow-sm">

                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Bonos de {{$employee->first_name}} {{$employee->first_lastname}}</div>
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
                        <table class="bonus-table table table-striped table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Monto</th>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Información Bono</h1>
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
                    <button type="button" class="btn-add-bonus btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    // modify bonus
    function modifyBonus(id) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.bonus.find', '-')}}".replace("-", id),
            success: (response) => {
                $("input[name='id']").val(response.record.id)
                $("input[name='amount']").val(response.record.amount)

                $("#modal").modal("show")
            }
        })
    }
    
    // delete bonus
    function deleteBonus(id) {
        $.ajax({
            type: "DELETE",
            dataType: "json",
            url: "{{route('api.bonus.destroy', '-')}}".replace("-", id),
            success: (response) => {
                $(".bonus-table").find("tbody").html("")
                Swal.fire({
                    title: "¡Exito!",
                    text: "Cambios Aplicados",
                    icon: "success"
                });
                fetchBonus()
            }
        })
    }

    // store bonus
    function storeBonus() {
        let data = {
            "employee_dui": $("input[name='employee_dui']").val(),
            "amount": $("input[name='amount']").val()
        }

        if($("input[name='id']").val() == "") {
            $("#modal").find("input[name='amount']").val("")
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('api.bonus.store')}}",
                data: data,
                success: (response) => {
                    console.log(response)
                    if(response.status == 200) {
                        $(".bonus-table").find("tbody").html("")
                        $("#modal").find("input[name='amount']").val("")
                        $(".modal-alert").addClass("visually-hidden")
                        $(".modal-alert").find("ul").html("")
                        $("#modal").modal("hide")
                        Swal.fire({
                            title: "¡Exito!",
                            text: "Cambios Aplicados",
                            icon: "success"
                        });
                        fetchBonus()
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
                url: "{{route('api.bonus.update', '-')}}".replace("-", $("input[name='id']").val()),
                data: data,
                success: (response) => {
                    if(response.status == 200) {
                        $(".bonus-table").find("tbody").html("")
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
                        fetchBonus()
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

    function fetchBonus() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('api.bonus.index', '-')}}".replace("-", "{{$employee->dui}}"),
            success: (response) => {
                console.log(response)
                response.forEach((bonus) => {
                    let row = ""
                    row += "<tr>"
                    row += `<td>$${bonus.amount}</td>`
                    row += `<td class="d-flex gap-2 justify-content-end">`
                    row += `<button class="btn btn-warning btn-icon" onclick="modifyBonus('${bonus.id}')">`
                    row += `<i class="fa fa-pen"></i>`
                    row += `</button>`
                    row += `<button class="btn btn-danger btn-icon" onclick="deleteBonus('${bonus.id}')">`
                    row += `<i class="fa fa-trash"></i>`
                    row += `</button>`
                    row += `</td>`
                    row += "</tr>"

                    $(".bonus-table").find("tbody").append(row)
                })

                $(".btn-export").click(() => {
                    arrayToCsv(response)
                })
            }
        })
    }

    $(() => {
        fetchBonus();

        $(".btn-add-bonus").click(() => {
            storeBonus()
        })
    })
</script>
@endpush
