@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alumnos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Listado</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card card-primary card-outline">

            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Filtros
                </button>

                <!-- CREAMOS EL REGISTRO EN LA TABLA PERSONAS COMO TIPO ALUMNO !-->
                <!--
                <a class="btn btn-primary" href="{{ route('alumnos.create') }}">
                    Nuevo
                </a>
                !-->

                <a href="{{ route('alumnos.descargarExpedientes') }}" class="btn btn-info">
                    Descargar expedientes
                </a>

                <a href="{{ route('alumnos.descargarConcentradoDeCalificaciones') }}" class="btn btn-info">
                    Descargar concentrado de calificaciones
                </a>

            </div>

            <div class="card-body" id="registradas_row">
                @include('alumnos.partials._index_row')
            </div>
            <div class="card-footer" id="foo-rows">
                {{ $registradas->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {!! Form::open(['route'=>'alumnos.index','method'=>'get']) !!}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('nombre','Nombre completo') !!}
                                {!! Form::input('text','nombre',request('nombre'),['class'=>'form-control']) !!}
                                <small>Ingresar: Apellido(s) Nombre(s)</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('curp','Curp') !!}
                                {!! Form::input('text','curp',request('curp'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Aplicar</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('jscripts')
@endsection
