@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar accesos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active">Editar accesos</li>
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

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Datos generales</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('Nombre', 'Nombre', ['class'=>'control-label']) !!}
                            {!! Form::text('nombre_completo', $user->userable->nombre_completo, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('curp', 'CURP', ['class'=>'control-label']) !!}
                            {!! Form::text('curp', $user->userable->curp, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('rfc', 'RFC', ['class'=>'control-label']) !!}
                            {!! Form::text('rfc', $user->userable->rfc, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('telefono', 'Teléfono', ['class'=>'control-label']) !!}
                            {!! Form::text('telefono', $user->userable->telefono, ['class'=>'form-control','maxlength'=>10, 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('email', 'Correo electrónico', ['class'=>'control-label']) !!}
                            {!! Form::text('email', $user->userable->email, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('numero_seguridad_social', 'Número de seguridad social', ['class'=>'control-label']) !!}
                            {!! Form::text('numero_seguridad_social', $user->userable->numero_seguridad_social, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            {!! Form::open(['class'=>'form-horizontal', 'route'=>['usuarios.actualizarAccesos', $user->uuid], 'method'=>'patch']) !!}

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Administrar accesos</h3>
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
                    @endif

                    <ul style="list-style:none">
                        @foreach($accesos AS $acceso)
                            <li>
                                {{Form::checkbox("permiso[".$acceso['id']."]",$acceso['id'],$acceso['user_id'],["class" => "form-group"]) }}
                                {{ $acceso->descripcion }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>

                    <a href="{{ route('usuarios.cambiarClaveAcceso',$user->uuid) }}" class="btn btn-default pull-right">Cambiar contraseña</a>

                    <a href="{{ route('usuarios.editarDatos',$user->uuid) }}" class="btn btn-default pull-right">Actualizar datos</a>

                    <a href="{{ route('home') }}" class="btn btn-default pull-right">Página inicio</a>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</section>

@endsection

@section('modals')
@endsection

@section('jscripts')
@endsection
