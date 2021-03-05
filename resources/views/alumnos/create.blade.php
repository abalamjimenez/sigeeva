@extends('layouts.privado')

@section('page-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registrar alumno - Datos generales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Datos generales</li>
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
                @else
                    @include('flash::message')
                @endif
            </div>
        </div>

        {!! Form::open(['route'=>'alumnos.store','method'=>'post','id'=>'personaForm']) !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos generales del alumno</h3>
            </div>
            <div class="card-body">
                @include('alumnos.partials._datos_generales')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                    Registrar
                </button>
                <a href="{{ route('home') }}" class="btn btn-default pull-right">Inicio</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection

@section('jscripts')
    <script src="{{ mix('js/alumnos/create.js') }}"></script>
@endsection
