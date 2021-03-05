@extends('layouts.privado')

@section('page-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar solicitud</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('solicitudes.concentrado') }}">Solicitudes</a></li>
                        <li class="breadcrumb-item active">Editar solicitud</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

    <div class="container">
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
                @endif

                @if (Session::get('msgExito'))
                    <div class="alert alert-success">
                        {{ Session::get('msgExito') }}
                    </div>
                @endif
            </div>
        </div>

        {!! Form::model($solicitud,['method'=>'POST','class'=> 'form-horizontal','route'=>['solicitudes.update',$solicitud->uuid]]) !!}

        {!! Form::hidden('_method', 'PUT') !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATOS ACADÉMICOS DEL SOLICITANTE</h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials.admin._editar_academicos')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    DATOS GENERALES DEL SOLICITANTE<br>
                    <small>
                        <em>
                            Si detectas alguna inconsistencia en tus datos personales,
                            envía copia de tu curp y copia de tu acta de nacimiento
                            al correo servicios.escolares@evasamano.edu.mx
                        </em>
                    </small>
                </h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials.admin._editar_generales')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATOS DEL PADRE O TUTOR</h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials.admin._editar_datos_tutor')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATOS LABORALES DEL PADRE O TUTOR</h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials.admin._editar_centro_trabajo')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-body">

                <!--
                <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                    Guardar
                </button>
                 !-->


                @if($solicitud->estatus_solicitud_id == 3)
                    <a href="{{ route('solicitudes.imprimir',$solicitud->uuid) }}" class="btn btn-default">
                        Descargar solicitud
                    </a>
                @endif

                <a href="{{ route('home') }}" class="btn btn-default pull-right">Regresar</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection

@section('jscripts')
    <script src="{{ mix('js/solicitudes/reinscripcion.js') }}"></script>
@endsection
