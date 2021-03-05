@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Solicitudes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Enviadas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="col-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.concentrado') }}">
                    Concentrado
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.enBorrador') }}">
                    Pendientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.rechazadas') }}">
                    Rechazadas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    Enviadas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.validadas') }}">
                    Validadas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.enRevision') }}">
                    En revisión
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.procesadas') }}">
                    Procesadas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solicitudes.aplicadas') }}">
                    Aplicadas
                </a>
            </li>
        </ul>
    </div>


    <div class="container-fluid">
        <div class="card card-primary card-outline">

            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Filtros
                </button>
            </div>

            <div class="card-body" id="registradas_row">
                @include('solicitudes.partials._solicitudes_row')
            </div>
            <div class="card-footer" id="foo-rows">
                {{ $solicitudes->links() }}
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

                {!! Form::open(['route'=>'solicitudes.enviadas','method'=>'get']) !!}

                <div class="modal-body">
                    @include('solicitudes.partials._solicitudes_filtro')
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
