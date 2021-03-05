@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Carreras</h1>
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

                <a class="btn btn-success" href="{{ route('carreras.create') }}">
                    Nuevo
                </a>

            </div>
            <div class="card-body" id="listado">
                @include('serviciosescolares.carreras.partials._index_listado')
            </div>
            <div class="card-footer" id="foo-rows">

            </div>
        </div>
    </div>


@endsection

@section('jscripts')
@endsection
