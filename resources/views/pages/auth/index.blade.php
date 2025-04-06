@extends("layout.main")

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
                    <div class="card shadow-md">
                        <div class="card-header text-center">
                            <h1>Bienvenido</h1>
                        </div>
                        <div class="card-body">
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
                            <button class="btn btn-primary">Iniciar Sesión</button>
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
    
</script>
@endpush
