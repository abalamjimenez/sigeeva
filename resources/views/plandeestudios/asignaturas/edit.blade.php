@extends('layouts.privado')

@section('page-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Actualizar datos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('plandeestudios.asignaturas.index') }}">Asignaturas</a></li>
                        <li class="breadcrumb-item active">Actualizar datos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

    <div class="container-fluid">
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

        {!! Form::model($asignatura,['class'=> 'form-horizontal', 'route'=>['plandeestudios.asignaturas.update',$asignatura->id]]) !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Datos generales</h3>
            </div>
            <div class="card-body">
                @include('plandeestudios.asignaturas.partials._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                    Actualizar
                </button>

                <a href="{{ route('plandeestudios.asignaturas.index') }}" class="btn btn-default pull-right">Asignaturas</a>

                <a href="{{ route('home') }}" class="btn btn-default pull-right">Inicio</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection

@section('jscripts')
@endsection
