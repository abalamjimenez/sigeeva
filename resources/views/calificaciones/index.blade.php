@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visualizar calificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Calificaciones</li>
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
                {{ $persona->nombre_completo }}
            </div>
            <div class="card-body">

                <table>
                <tr>
                    <th width="120px">Ciclo escolar</th>
                    <td>{{ $periodoEscolar->descripcion }}</td>
                </tr>
                <tr>
                    <th>Carrera</th>
                    <td>{{ $expediente->grupo->clave }} - {{ optional($expediente->carrera)->descripcion }}</td>
                </tr>
                <tr>
                    <th>Semestre</th>
                    <td>{{ $expediente->grado_id }}</td>
                </tr>
                <tr>
                    <th>Turno</th>
                    <td>{{ optional($expediente->turno)->descripcion }}</td>
                </tr>
                <tr>
                    <th>Control escolar</th>
                    <td>
                        {{ $responsables->nombreCompletoResponsableControlEscolar }} es la encargada de llevar
                        el seguimiento de tu expediente en el área de control escolar del plantel
                    </td>
                </tr>
                <tr>
                    <th>Tutor</th>
                    <td>{{ $responsables->nombreCompletoTutor }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="{{ route('alumnos.imprimirBoleta',$asignatura_grupo_expediente_uuid) }}" class="btn btn-primary pull-right">
                            Generar boleta
                        </a>
                    </td>
                </tr>
                </table>

            </div>
        </div>

        @if(!empty($arregloAsignaturas['regular']))

            <div class="card card-primary card-outline">
                <div class="card-header">
                    Asignaturas curso regular
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th style="text-align: center" scope="col">#</th>
                            <th style="text-align: center" scope="col">Asignatura</th>
                            <th style="text-align: center" scope="col">Unidad1</th>
                            <th style="text-align: center" scope="col">Unidad2</th>
                            <th style="text-align: center" scope="col">Unidad3</th>
                            <th style="text-align: center" scope="col">Calificación final</th>
                            <th style="text-align: center" scope="col" title="Extraordinario 1">E1</th>
                            <th style="text-align: center" scope="col" title="Extraordinario 2">E2</th>
                            <th style="text-align: center" scope="col" title="Examen especial">EE</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($arregloAsignaturas['regular'] AS $asignatura)
                        <tr>
                            <td scope="row" style="text-align: center">
                                {{ $loop->iteration }}
                            </td>
                            <td title="{{ $asignatura['descripcion'] }}" style="text-align: left">
                                {{ $asignatura['abreviacion'] }} - {{ $asignatura['descripcion'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['unidad1'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['unidad2'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['unidad3'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['calificacion_final'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['extraordinario1'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['extraordinario2'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['examen_especial'] }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>

                </div>
            </div>

        @endif

        @if(!empty($arregloAsignaturas['repeticion']))

            <div class="card card-primary card-outline">
                <div class="card-header">
                    Asignaturas curso repetición
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th style="text-align: center" scope="col">#</th>
                            <th style="text-align: center" scope="col">Grupo</th>
                            <th style="text-align: center" scope="col">Asignatura</th>
                            <th style="text-align: center" scope="col">Unidad1</th>
                            <th style="text-align: center" scope="col">Unidad2</th>
                            <th style="text-align: center" scope="col">Unidad3</th>
                            <th style="text-align: center" scope="col">Calificación final</th>
                            <th style="text-align: center" scope="col" title="Extraordinario 1">E1</th>
                            <th style="text-align: center" scope="col" title="Extraordinario 2">E2</th>
                            <th style="text-align: center" scope="col" title="Examen especial">EE</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($arregloAsignaturas['repeticion'] AS $asignatura)
                            <tr>
                                <td scope="row" style="text-align: center">
                                    {{ $loop->iteration }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['claveGrupo'] }}
                                </td>
                                <td title="{{ $asignatura['descripcion'] }}" style="text-align: center">
                                    {{ $asignatura['abreviacion'] }} - {{ $asignatura['descripcion'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['unidad1'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['unidad2'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['unidad3'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['calificacion_final'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['extraordinario1'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['extraordinario2'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['examen_especial'] }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        @endif


        <div class="card card-primary card-outline">
            <div class="card-header">
                Datos generales de las materias
            </div>

            <div class="card-body">

                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Docente</th>
                        <th>Abreviación</th>
                        <th>Descripción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $contador=1; ?>

                    @if(!empty($arregloAsignaturas['regular']))
                        @foreach($arregloAsignaturas['regular'] AS $asignatura)
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ $asignatura['profesor'] }}</td>
                                <td>{{ $asignatura['abreviacion'] }}</td>
                                <td>{{ $asignatura['descripcion'] }}</td>
                            </tr>
                            <?php $contador++; ?>
                        @endforeach
                    @endif

                    @if(!empty($arregloAsignaturas['repeticion']))
                        @foreach($arregloAsignaturas['repeticion'] AS $asignatura)
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ $asignatura['profesor'] }}</td>
                                <td>{{ $asignatura['abreviacion'] }}</td>
                                <td>{{ $asignatura['descripcion'] }}</td>
                            </tr>
                            <?php $contador++; ?>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('jscripts')
@endsection
