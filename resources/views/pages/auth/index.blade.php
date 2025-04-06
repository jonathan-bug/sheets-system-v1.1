@extends("layout.app")

@push("styles")
<style>
    body {
        background-image: url("{{url('background.jpg')}}");
        background-repeat: no-repeat;
        background-size: cover;
    }

    .container, .page-inner, .row {
        height: 100vh;
    }
</style>
@endpush

@section("content")
    <div class="container">
        <div class="page-inner">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-sm-8 col-md-5">
                    <div class="card shadow-sm">
                        <div class="card-header text-center">
                            <h1>Bienvenido</h1>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning shadow-none text-warning visually-hidden">
                                Credenciales Invalidas
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Correo Electronico</label>
                                <input class="form-control" name="email" type="text" value="" placeholder="correo@domain.com"/>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="">Contraseña</label>
                                <input class="form-control" name="password" type="password" value=""/>
                            </div>
                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button id="btn-login" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    // user validation
    $(() => {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        })

        $("#btn-login").click(() => {
            let data = {
                "email": $("input[name='email']").val(),
                "password": $("input[name='password']").val()
            }
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/auth",
                data,
                success: (response) => {
                    if(response.status != 200) {
                        $(".alert").toggleClass("visually-hidden")
                    }else {
                        window.location.href = "{{route('dashboard')}}"
                    }
                }
            })
        })
    })
</script>
@endpush
