@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-4 col-md-7 col-sm-10 mx-auto text-center">
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header" style="background-color: #003968ff; color: white;">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ asset('img/avatar.png') }}" alt="Alumno Birrete">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">CEBT Eva Sámano de López Mateos</h3>
                <h6 class="widget-user-desc" style="font-size: 12px">Iniciar sesión en el sistema</h6>
            </div>
            <div class="card-body">

                <div class="alert alert-warning" role="alert">
                    {{ __('The page has expired due to inactivity. Please refresh and try again') }}
                </div>

                <div class="card-title mb-2">Ingrese sus datos de acceso</div>
                <form method="POST" action="{{ route('login') }}" accept-charset="UTF-8" class="form-horizontal">
                    @csrf

                    <div class="input-group mb-3">
                        <input placeholder="Usuario" class="form-control " required="" name="username" type="text" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input placeholder="Contraseña" class="form-control " required="" name="password" type="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 p-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
