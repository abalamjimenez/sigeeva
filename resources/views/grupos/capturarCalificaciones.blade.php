@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Capturar calificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('docente.gruposAsignados') }}">Grupos asignados</a></li>
                        <li class="breadcrumb-item active">Capturar calificaciones</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <?php
    $capturar_unidad1 = 'N';
    $capturar_unidad2 = 'N';
    $capturar_unidad3 = 'N';
    $capturar_e1      = 'N';
    $capturar_e2      = 'N';
    $capturar_ee      = 'N';
    ?>

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
                @else
                    @include('flash::message')
                @endif
            </div>
        </div>

        {!! Form::model($asignaturaGrupo,['class'=> 'form-horizontal', 'route'=>['grupos.almacenarCalificaciones',$asignaturaGrupo->id]]) !!}

        <div class="card card-primary card-outline">
            <div class="card-body">
                <p>
                Profesor:{{ $asignaturaGrupo->persona->nombre_completo }}
                </p>

                <p>
                    Materia: {{ $asignaturaGrupo->asignatura->abreviacion }} - {{ $asignaturaGrupo->asignatura->descripcion }}
                </p>

                <p>
                    Grupo: {{ $asignaturaGrupo->grupo->clave }}
                </p>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Matricula activa
                </h3>
            </div>
            <div class="card-body">
                @include('grupos.partials._expedientes_calificaciones_matricula_activa_row')
            </div>
        </div>

        @if(! $alumnosCr->isEmpty())
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Alumnos en CR
                    </h3>
                </div>
                <div class="card-body">
                    @include('grupos.partials._expedientes_calificaciones_alumnoscr_row')
                </div>
            </div>
        @endif

        <div class="card card-primary">
            <div class="card-body">
                @if($capturar_unidad1 == 'N' AND
                    $capturar_unidad2 == 'N' AND
                    $capturar_unidad3 == 'N' AND
                    $capturar_e1      == 'N' AND
                    $capturar_e2      == 'N' AND
                    $capturar_ee      == 'N'
                    )
                    <div class="alert alert-warning" role="alert">
                        La fecha para la captura de calificaciones ya ha vencido
                    </div>
                @endif
            </div>
            <div class="card-footer">

                @if($capturar_unidad1 == 'S' OR
                    $capturar_unidad2 == 'S' OR
                    $capturar_unidad3 == 'S' OR
                    $capturar_e1      == 'S' OR
                    $capturar_e2      == 'S' OR
                    $capturar_e2      == 'S'
                    )
                    <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                        Guardar
                    </button>
                @else

                @endif

                <a href="{{ route('home') }}" class="btn btn-primary pull-right">Inicio</a>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection

@section('jscripts')
@endsection
