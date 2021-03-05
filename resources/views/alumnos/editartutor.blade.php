@extends('layouts.privado')

@section('page-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tutor de {{ $persona->nombre_completo }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('alumnos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar tutor</li>
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

        {!! Form::model($referencia,['class'=> 'form-horizontal', 'route'=>['alumnos.storeTutor',$persona->uuid]]) !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos generales del tutor</h3>
            </div>
            <div class="card-body">
                @include('alumnos.partials._datos_generales_tutor')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                    @if(!empty($referencia->id))
                        Actualizar
                    @else
                        Registrar
                    @endif
                </button>

                <a href="{{ route('alumnos.edit', $persona->uuid) }}" class="btn btn-default pull-right">
                    Datos Generales
                </a>

                <a href="{{ route('home') }}" class="btn btn-default pull-right">Inicio</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
@endsection

@section('jscripts')
    <script src="{{ mix('js/alumnos/editartutor.js') }}"></script>
@endsection
