@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mis Grupos</h1>
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
            <div class="card-body">
                <p>
                    Profesor:{{ $persona->nombre_completo }}
                </p>
            </div>
        </div>


        <div class="card card-primary card-outline">
            <div class="card-body" id="registradas_row">
                @include('docentes.partials._grupos_asignados_row')
            </div>
        </div>
    </div>

@endsection

@section('jscripts')
@endsection
