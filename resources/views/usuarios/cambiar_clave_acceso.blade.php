@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cambiar contraseña</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active">Cambiar contraseña</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-6">

                {!! Form::open(['class'=>'form-horizontal', 'route'=>['usuarios.updateClaveAcceso', $user->uuid], 'method'=>'patch']) !!}

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Cambiar contraseña</h3>
                    </div>

                    <div class="card-body">

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


                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('username', 'Usuario:', ['class'=>'control-label']) !!}
                                {!! Form::text('username', $user->username, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('ultimo_acceso', 'Último acceso:', ['class'=>'control-label']) !!}
                                {!! Form::text('ultimo_acceso', $user->last_login_at, ['class'=>'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('password', 'Nueva contraseña:', ['class'=>'control-label']) !!}
                                {!! Form::password('password', ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('password_confirmation', 'Confirmar contraseña:', ['class'=>'control-label']) !!}
                                {!! Form::password('password_confirmation', ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>

                        <a href="{{ route('usuarios.editarDatos',$user->uuid) }}" class="btn btn-default pull-right">Actualizar datos</a>

                        <a href="{{ route('usuarios.editarAccesos',$user->uuid) }}" class="btn btn-default pull-right">Editar accesos</a>

                        <a href="{{ route('home') }}" class="btn btn-default pull-right">Página inicio</a>

                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </section>
@endsection

@section('jscripts')
@endsection
