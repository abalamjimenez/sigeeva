@extends('layouts.privado')

@section('page-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar carrera</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('carreras.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Editar carrera</li>
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

        {!! Form::model($carrera,['method'=>'POST','class'=> 'form-horizontal', 'route'=>['carreras.update',$carrera->id]]) !!}

        {!! Form::hidden('_method', 'PUT') !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Editar carrera</h3>
            </div>
            <div class="card-body">
                @include('serviciosescolares.carreras.partials._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                    Actualizar
                </button>

                <a href="{{ route('home') }}" class="btn btn-default pull-right">Inicio</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection

@section('jscripts')
@endsection
