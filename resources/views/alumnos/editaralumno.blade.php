@extends('layouts.privado')

@section('page-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Datos académicos de {{ $persona->nombre_completo }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar alumno</li>
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

        {!! Form::model($alumno,['class'=> 'form-horizontal', 'route'=>['personas.storeAlumno',$persona->uuid]]) !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos académicos del alumno</h3>
            </div>
            <div class="card-body">
                @include('personas.partials._datos_academicos_alumno')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                    @if(!empty($alumno->id))
                        Actualizar
                    @else
                        Registrar
                    @endif
                </button>

                <a href="{{route('personas.edit', $persona->uuid)}}" class="btn btn-primary pull-right">
                    Datos Generales
                </a>

                <a href="{{route('personas.editarTutor', $persona->uuid)}}" class="btn btn-primary pull-right">
                    Datos Tutor
                </a>

                <a href="{{ route('home') }}" class="btn btn-default pull-right">Inicio</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection

@section('jscripts')
@endsection
