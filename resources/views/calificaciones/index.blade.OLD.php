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
                    <th>Generación</th>
                    <td>{{ optional($expediente->generacion)->descripcion }}</td>
                </tr>
                <tr>
                    <th>Carrera</th>
                    <td>{{ optional($expediente->carrera)->descripcion }}</td>
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
                    <td colspan="2">
                        <a href="{{ route('alumnos.imprimirBoleta',$persona->uuid) }}" class="btn btn-primary pull-right">
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
                            <th style="text-align: center" scope="col">Unidad 1</th>
                            <th style="text-align: center" scope="col">Unidad 2</th>
                            <th style="text-align: center" scope="col">Unidad 3</th>
                            <th style="text-align: center" scope="col">Promedio</th>
                            <th style="text-align: center" scope="col">Calificación final</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($arregloAsignaturas['regular'] AS $asignatura)
                        <tr>
                            <td scope="row" style="text-align: center">
                                {{ $loop->iteration }}
                            </td>
                            <td title="{{ $asignatura['descripcion'] }}" style="text-align: center">
                                {{ $asignatura['abreviacion'] }}
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
                                {{ $asignatura['promedio'] }}
                            </td>
                            <td style="text-align: center">
                                {{ $asignatura['calificacion_final'] }}
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
                            <th style="text-align: center" scope="col">Asignatura</th>
                            <th style="text-align: center" scope="col">Unidad 1</th>
                            <th style="text-align: center" scope="col">Unidad 2</th>
                            <th style="text-align: center" scope="col">Unidad 3</th>
                            <th style="text-align: center" scope="col">Promedio</th>
                            <th style="text-align: center" scope="col">Calificación final</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($arregloAsignaturas['repeticion'] AS $asignatura)
                            <tr>
                                <td scope="row" style="text-align: center">
                                    {{ $loop->iteration }}
                                </td>
                                <td title="{{ $asignatura['descripcion'] }}" style="text-align: center">
                                    {{ $asignatura['abreviacion'] }}
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
                                    {{ $asignatura['promedio'] }}
                                </td>
                                <td style="text-align: center">
                                    {{ $asignatura['calificacion_final'] }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        @endif
    </div>


@endsection

@section('jscripts')
@endsection
