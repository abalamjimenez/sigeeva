@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFiltros">
                    Filtros
                </button>
            </div>
            <div class="card-body" id="registradas_row">
                @include('usuarios.partials._index_row')
            </div>
            <div class="card-footer" id="foo-rows">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modals')

    <div class="modal fade" id="modalFiltros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtros</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {!! Form::open(['route'=>'usuarios.index','method'=>'get']) !!}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('tipo_registro','Tipo') !!}
                                {!! Form::select('tipo_registro',['ALUMNO'=>'Alumno','DOCENTE'=>'Docente','ADMINISTRATIVO'=>'Administrativo'],request('tipo_registro'),['class'=>'form-control','placeholder'=>'Seleccione','id'=>'tipo_registro']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('username','Usuario') !!}
                                {!! Form::input('text','username',request('username'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('curp','') !!}
                                {!! Form::input('text','curp',request('curp'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('nombre_completo','') !!}
                                {!! Form::input('text','nombre_completo',request('nombre_completo'),['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Grupo') !!} <span class="required">*</span>
                                {!! Form::select('grupo_id',$grupos,request('grupo_id'),['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'grupo_id']) !!}
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
