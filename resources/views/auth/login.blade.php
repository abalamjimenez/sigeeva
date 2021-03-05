@extends('layouts.public')

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

                        <a href="{{ route('public.obtenerDatosAccesoAlumno') }}">
                            Recuperar u obtener contraseña
                        </a>

                    </form>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-md-3" style="margin-top:1em">
        {{--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">AMPLIACIÓN DE LA INSCRIPCIÓN!!!</h5>
                    <p class="card-text" style="text-align:center">
                        <a href="{{ route('public.ampliacionInscripcion') }}" style="cursor:pointer" class="btn btn-warning">
                            VER MÁS INFORMACIÓN
                        </a>
                    </p>
                </div>
            </div>
        </div>
        --}}

        {{--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">INSCRIPCIONES PAENMS</h5>
                    <p class="card-text">
                        <a href="{{ route('public.inscripcionPaenmsBuscar') }}" style="cursor:pointer" class="btn btn-success">
                            Presiona este botón si hiciste tu proceso de inscripción en PAENMS
                        </a>
                    </p>
                </div>
            </div>
        </div>
        --}}


        <div class="col mb-4 mx-auto">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h5 class="card-title">A D M I S I O N E S</h5>
                    <p class="card-text">
                        <a href="{{ route('public.inscripcionBuscar') }}" style="cursor:pointer" class="btn btn-success">
                            Inicia tu proceso de admisión
                        </a>
                    </p>
                </div>
            </div>
        </div>


        {{--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">INSCRIPCIONES</h5>
                    <p class="card-text">
                        <a href="{{ route('public.inscripcionBuscar') }}" style="cursor:pointer" class="btn btn-success">
                            Presiona este botón si no realizaste tu proceso de registro en PAENMS
                        </a>
                    </p>
                </div>
            </div>
        </div>
        --}}

        {{--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ALUMNO</h5>
                    <p class="card-text">
                        <a href="{{ route('public.obtenerDatosAccesoAlumno') }}" style="cursor:pointer" class="btn btn-default">
                            Presiona aquí para obtener tu usuario y contraseña si estudiaste con nosotros el
                            periodo escolar anterior.
                        </a>
                    </p>
                </div>
            </div>
        </div>
        --}}

        {{--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información</h5>
                    <p class="card-text">

                        <a href="{{ route('public.informacionCambiosDeEscuela') }}" style="cursor:pointer" class="btn btn-default">
                            Reinscripciones, readmisiones y cambios de escuela
                        </a>

                    </p>
                </div>
            </div>
        </div>
        --}}


        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">HORARIOS</h5>
                    <p class="card-text" style="text-align:center">

                        <a href="{{ route('public.horarioMatutino') }}" style="cursor:pointer;color:white;" class="btn btn-info">
                            HORARIOS DEL TURNO MATUTINO
                        </a>

                    </p>
                </div>
            </div>
        </div>

        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">HORARIOS</h5>
                    <p class="card-text" style="text-align:center">

                        <a href="{{ route('public.horarioVespertino') }}" style="cursor:pointer;color:white;" class="btn btn-info">
                            HORARIOS DEL TURNO VESPERTINO
                        </a>

                    </p>
                </div>
            </div>
        </div>

        <!--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Calendario escolar</h5>
                    <p class="card-text" style="text-align:center">

                        <a href="{{ route('public.calendarioEscolar') }}" style="cursor:pointer;color:white;" class="btn btn-info">
                            Ver Calendario Escolar
                        </a>

                    </p>
                </div>
            </div>
        </div>
        !-->

        <!--
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Calendario escolar</h5>
                    <p class="card-text" style="text-align:center">

                        <a href="{{ route('public.listaAdmisionNi') }}" style="cursor:pointer;color:white;" class="btn btn-info">
                            LISTA DE ADMISIÓN<br>
                            SEMESTRE A 2020-2021
                        </a>

                    </p>
                </div>
            </div>
        </div>
        !-->
    </div>

@endsection
