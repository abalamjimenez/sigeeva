@extends('layouts.public')

@section('content')
    <header style="margin-bottom: 2em">
        <div class="row">
            <div class="col-sm-12 mx-auto text-center">
                <img  src="{{ asset("img/eva-samano-logos.png") }}">
            </div>
        </div>
    </header>

    <div class="row">
        <div class="col">
            <div class="card card-widget widget-user-2">
                <div class="widget-user-header" style="background-color: #003968ff; color: white;">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('img/avatar.png') }}" alt="Alumno Birrete">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">CEBT Eva Sámano de López Mateos</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                @include('flash::message')
                            @endif

                            @if(session()->has('msg'))
                                <div class="alert alert-success">
                                    {{ session()->get('msg') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Proporcione en minúsculas la siguiente información
                                    para hacerle llegar sus datos de acceso:
                                </h5>

                                <form method="POST" action="{{ route('public.enviarDatosAccesoAlumno') }}" accept-charset="UTF-8" class="form-horizontal">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <input placeholder="Correo electrónico institucional" class="form-control " required="" value="{{ old('correo_electronico') }}" name="correo_electronico">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 p-0">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-danger">Importante</h5>
                                <p class="card-text text-justify">
                                    Ingresa tu correo institucional y presiona Enviar para reiniciar tu contraseña, la
                                    cual recibirás en dicho correo institucional.
                                </p>

                                <p class="card-text text-justify">
                                    En caso de no recuerdar tu correo institucional, envía un correo electrónico a la
                                    dirección sigeeva@evasamano.edu.mx, indicando tu nombre completo, carrera, semestre
                                    que estás cursando.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mx-auto text-center">
            <a href="{{ route('home') }}" style="cursor:pointer" class="btn btn-success">
                Regresar
            </a>
        </div>
    </div>

@endsection
