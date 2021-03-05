@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Mi Perfil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Editar Mi Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
<section class="container">

    @if ($user->cuenta_validada == 'N')
        <div class="alert alert-warning" role="alert">
            Porfavor, realiza las siguientes actividades:
            <ol style="margin-top:1em">
                <li>Actualiza tus datos</li>
                <li>Presiona el botón Guardar</li>
            </ol>
            * Si tus datos están correctos, aún así, presiona el botón Guardar para confirmar los datos y poder utilizar el sistema<br><br>
            Gracias por tu apoyo!
        </div>
    @endif

    {!! Form::open(['class'=>'form-horizontal', 'route'=>['usuarios.updateMiPerfil', $user->id], 'method'=>'patch']) !!}

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
                            {!! Form::text('nombre_completo', $persona->nombre_completo, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('rfc', 'RFC', ['class'=>'control-label']) !!}
                            {!! Form::text('rfc', $persona->rfc, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('curp', 'CURP', ['class'=>'control-label']) !!}
                            {!! Form::text('curp', $persona->curp, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('fecha nacimiento') !!} <span class="required">*</span>
                            {!! Form::date('fecha_nacimiento',(isset($persona->fecha_nacimiento))?$persona->fecha_nacimiento:NULL,['class'=>'form-control form-control-lg segmento','id'=>'fecha_nacimiento','required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('telefono', 'Teléfono', ['class'=>'control-label']) !!}
                            {!! Form::text('telefono', $persona->telefono, ['class'=>'form-control','maxlength'=>10]) !!}
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
                            {!! Form::label('email', 'Correo institucional', ['class'=>'control-label']) !!}
                            {!! Form::text('email', $user->email, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('numero_seguridad_social', 'Número de seguridad social', ['class'=>'control-label']) !!}
                            {!! Form::text('numero_seguridad_social', $persona->numero_seguridad_social, ['class'=>'form-control','maxlength'=>11]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Domicilio</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('domicilio_calle', 'Calle', ['class'=>'control-label']) !!}
                            {!! Form::text('domicilio_calle', $domicilio->domicilio_calle, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('domicilio_numero_exterior', 'Número exterior', ['class'=>'control-label']) !!}
                            {!! Form::text('domicilio_numero_exterior', $domicilio->domicilio_numero_exterior, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('domicilio_colonia', 'Colonia', ['class'=>'control-label']) !!}
                            {!! Form::text('domicilio_colonia', $domicilio->domicilio_colonia, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('domicilio_codigo_postal', 'Código postal', ['class'=>'control-label']) !!}
                            {!! Form::text('domicilio_codigo_postal', $domicilio->domicilio_codigo_postal, ['class'=>'form-control','maxlength'=>5]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('Localidad') !!}
                            {!! Form::select('domicilio_localidad_id',$localidades,(isset($domicilio->domicilio_localidad_id))?$domicilio->domicilio_localidad_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'domicilio_localidad_id','']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('home') }}" class="btn btn-default pull-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

</section>
@endsection

@section('jscripts')
    <script src="{{ mix('js/usuarios/editarmiperfil.js') }}"></script>
@endsection

