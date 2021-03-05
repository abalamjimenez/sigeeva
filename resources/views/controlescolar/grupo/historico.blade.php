@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Grupos Histórico</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Listado</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
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
                @endif
            </div>
        </div>

        {!! Form::open(['route'=>'controlescolar.grupo.historico','method'=>'get']) !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Seleccionar periodo escolar</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('periodo_escolar','Periodo escolar') !!}
                            {!! Form::select('periodo_escolar_id',$periodosEscolares,request('periodo_escolar_id'),['class'=>'form-control','placeholder'=>'Seleccione','id'=>'periodo_escolar_id']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" name="buscar" id="buscar" value="true">
                    Buscar
                </button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

    @if (!empty($_GET['periodo_escolar_id']))
        <div class="container-fluid">
            @forelse($arregloAsignaturas AS $key=>$asignaturasxGrupo)
                <?php
                $first = reset($asignaturasxGrupo);
                ?>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        Grupo: {{ $key }}

                        <a href="{{ route('grupos.imprimirListadoGrupo',$first['grupo_id']) }}" class="btn btn-info">
                            <i class="fa fa-print"></i> Imprimir listado
                        </a>

                        <a href="{{ route('grupos.imprimirSabanaGrupo',$first['grupo_id']) }}" class="btn btn-info">
                            <i class="fa fa-print"></i> Imprimir Sabana
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th>Materia</th>
                                <th>Docente</th>
                                <th>Carrera</th>
                                <th>Semestre</th>
                                <th>Turno</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asignaturasxGrupo AS $asignaturaGrupo)
                                <tr>
                                    <td>
                                        <div class="dropdown position-static show">
                                            <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                                                Acciones
                                            </a>

                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('grupos.capturarCalificacionesAdmin', $asignaturaGrupo['asignatura_grupo_uuid'])}}">
                                                    Capturar calificaciones
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td title="{{ $asignaturaGrupo['asignatura_descripcion'] }}">

                                        <a
                                            href="#!"
                                            id="btnMostrarOcultar{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                            class="cargarOcultar"
                                            data-asignatura-grupo-id="{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                            style="cursor:pointer;display:none">
                                            {{ $asignaturaGrupo['asignatura_abreviacion'] }}
                                        </a>

                                        <a
                                            href="#!"
                                            id="btnCargar{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                            class="detalle"
                                            data-asignatura-grupo-id="{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                            style="cursor:pointer">
                                            {{ $asignaturaGrupo['asignatura_abreviacion'] }}
                                        </a>

                                    </td>
                                    <td>{{ $asignaturaGrupo['docente_nombre_completo'] }}</td>
                                    <td>{{ $asignaturaGrupo['carrera_descripcion'] }}</td>
                                    <td>{{ $asignaturaGrupo['semestre'] }}</td>
                                    <td>{{ $asignaturaGrupo['turno_descripcion'] }}</td>
                                </tr>
                                <tr style="display: none" id="fila_{{ $asignaturaGrupo['asignatura_grupo_id'] }}">
                                    <td colspan="7" id="columna_{{ $asignaturaGrupo['asignatura_grupo_id'] }}">

                                        <h2>Alumnos del grupo</h2>

                                        <table class="alumnos">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Unidad 1</th>
                                                <th>Unidad 2</th>
                                                <th>Unidad 3</th>
                                                <th>Promedio</th>
                                                <th>Calificación final</th>
                                                <th>E1</th>
                                                <th>E2</th>
                                                <th>EE</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <h2>Alumnos adicionales</h2>

                                        <table class="alumnosEspeciales">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Nombre completo</th>
                                                <th>Unidad 1</th>
                                                <th>Unidad 2</th>
                                                <th>Unidad 3</th>
                                                <th>Promedio</th>
                                                <th>Calificación final</th>
                                                <th>E1</th>
                                                <th>E2</th>
                                                <th>EE</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            @empty
                <p style="text-align:center;font-weight: bold;font-size:1.5em">
                    No hay grupos creados en el periodo seleccionado
                </p>
            @endforelse
        </div>
    @endif

@endsection

@section('jscripts')
    <script src="{{ mix('js/historicos/grupo/index.js') }}"></script>
@endsection
