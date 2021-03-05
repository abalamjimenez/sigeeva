@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Actualizar datos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active">Actualizar datos</li>
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

                {!! Form::open(['class'=>'form-horizontal', 'route'=>['usuarios.updateDatos', $user->uuid], 'method'=>'patch']) !!}

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar datos</h3>
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
                                {!! Form::label('nombre_completo', 'Nombre:', ['class'=>'control-label']) !!}
                                {!! Form::text('nombre_completo', $persona->nombre_completo, ['class'=>'form-control', 'disabled']) !!}

                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('curp', 'CURP:', ['class'=>'control-label']) !!}
                                    {!! Form::text('curp', $persona->curp, ['class'=>'form-control', 'disabled']) !!}

                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('correo_institucional', 'Correo institucional', ['class'=>'control-label']) !!}
                                {!! Form::text('correo_institucional', $user->email, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('correo_institucional_validado', 'Marque si esta seguro que es el correo institucional:', ['class'=>'control-label']) !!}
                                    {!! Form::checkbox('correo_institucional_validado',1,$user->correo_institucional_validado) !!}
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('correo_personal', 'Correo personal', ['class'=>'control-label']) !!}
                                {!! Form::text('correo_personal', $persona->email, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('telefono', 'Teléfono', ['class'=>'control-label']) !!}
                                {!! Form::text('telefono', $persona->telefono, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>

                        <a href="{{ route('usuarios.cambiarClaveAcceso',$user->uuid) }}" class="btn btn-default pull-right">Cambiar contraseña</a>

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
