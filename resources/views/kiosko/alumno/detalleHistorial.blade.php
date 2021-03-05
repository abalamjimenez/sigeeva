@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kiosko.alumno.historial') }}">Alumnos</a></li>
                        <li class="breadcrumb-item active">Historial</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="card card-primary card-outline">
            <div class="card-header">
                Datos generales
            </div>

            <div class="card-body" id="records">
                {{ $persona->nombre_completo }}<br>
                {{ $persona->curp }}<br>
                <strong>Usuario sigeeva:</strong> {{ $persona->usuario->username }}<br>
                <strong>Correo personal:</strong> {{ $persona->email }}<br>
                <strong>Correo institucional:</strong>
                @if ($persona->usuario->correo_institucional_validado == 1)
                    {{ $persona->usuario->email }}
                @else
                    <span style="color:red">No esta registrado su correo institucional</span>
                @endif
            </div>
            <div class="card-footer" id="foo-rows">
            </div>
        </div>



        <div class="card card-primary card-outline">
            <div class="card-header">
                Expedientes
            </div>

            <div class="card-body" id="records">
                <table class="table table-condensed table-hover table-responsive">
                    <thead>
                    <tr>
                        <td>Expediente</td>
                        <td>&nbsp;</td>
                        <td>Periodo escolar</td>
                        <td>Grupo</td>
                        <td>Carrera</td>
                        <td>Semestre</td>
                        <td>Turno</td>
                        <td>Tipo inscripción</td>
                        <td>Cedar</td>
                        <td>Estatus</td>
                        <td>Expediente ID</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expedientes AS $expediente)
                        <tr>
                            <td>
                                <a
                                    href="#!"
                                    id="btnMostrarOcultar{{ $expediente->expediente_id }}"
                                    class="cargarOcultar btn btn-success"
                                    data-expediente-id="{{ $expediente->expediente_id }}"
                                    style="cursor:pointer;display:none">
                                    Ver detalle
                                </a>

                                <a
                                    href="#!"
                                    id="btnCargar{{ $expediente->expediente_id }}"
                                    class="detalle btn btn-success"
                                    data-expediente-id="{{ $expediente->expediente_id }}"
                                    style="cursor:pointer">
                                    Ver detalle
                                </a>

                            </td>
                            <td>
                                <a href="{{ route('alumnos.imprimirBoleta',$expediente->asignatura_grupo_expediente_uuid) }}" target="_blank" class="btn btn-primary pull-right">
                                    Generar boleta
                                </a>
                            </td>
                            <td>{{ $expediente->descripcion_periodo_escolar }}</td>
                            <td>{{ $expediente->clave }}</td>
                            <td>{{ $expediente->descripcion_carrera }}</td>
                            <td>{{ $expediente->semestre }}</td>
                            <td>{{ $expediente->descripcion_turno }}</td>
                            <td>{{ $expediente->tipo_inscripcion }}</td>
                            <td>{{ $expediente->es_cedar }}</td>
                            <td>{{ $expediente->estatus_expediente }}</td>
                            <td>{{ $expediente->expediente_id }}</td>
                        </tr>
                        <tr style="display: none" id="fila_{{ $expediente->expediente_id }}">
                            <td colspan="8" id="columna_{{ $expediente->expediente_id }}">

                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        Generales
                                    </div>

                                    <div class="card-body">
                                        <table class="generales">
                                        </table>
                                    </div>
                                </div>


                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        Materias regulares
                                    </div>

                                    <div class="card-body">
                                        <table class="materias">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Abreviación</th>
                                                <th>Unidad1</th>
                                                <th>Unidad2</th>
                                                <th>Unidad3</th>
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
                                    </div>
                                </div>

                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        Materias en repetición
                                    </div>

                                    <div class="card-body">
                                        <table class="materiasEnRepeticion">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Abreviación</th>
                                                <th>Unidad1</th>
                                                <th>Unidad2</th>
                                                <th>Unidad3</th>
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
                                    </div>
                                </div>

                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        Datos generales de las materias
                                    </div>

                                    <div class="card-body">

                                        <table class="datosMaterias">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Docente</th>
                                                <th>Abreviación</th>
                                                <th>Descripción</th>
                                                <th>Grupo</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer" id="foo-rows">
            </div>
        </div>

        <div class="card card-primary card-outline">

            <div class="card-header">
                Solicitudes
            </div>

            <div class="card-body" id="records">
                <table class="table table-condensed table-hover table-responsive">
                    <thead>
                    <tr>
                        <td>Solicitud</td>
                        <td>Periodo escolar</td>
                        <td>Carrera</td>
                        <td>Semestre</td>
                        <td>Turno</td>
                        <td>Grupo</td>
                        <td>Tipo solicitud</td>
                        <td>Estatus</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($solicitudes AS $solicitud)
                        <tr>
                            <td>{{ $solicitud->solicitud_id }}</td>
                            <td>{{ $solicitud->descripcion_periodo_escolar }}</td>
                            <td>{{ $solicitud->descripcion_carrera }}</td>
                            <td>{{ $solicitud->semestre }}</td>
                            <td>{{ $solicitud->descripcion_turno }}</td>
                            <td>{{ $solicitud->clave }}</td>
                            <td>{{ $solicitud->tipo_solicitud }}</td>
                            <td>{{ $solicitud->descripcion_estatus }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer" id="foo-rows">
            </div>
        </div>


    </div>


@endsection

@section('jscripts')
    <script src="{{ mix('js/alumnos/historial.js') }}"></script>
@endsection
