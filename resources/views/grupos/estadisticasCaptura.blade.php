@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estadisticas de captura</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Captura</li>
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
                Alumnos con calificaciones
            </div>
            <div class="card-body">

                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Asignatura</th>
                        <th>Profesor</th>
                        <th>Total de alumnos</th>
                        <th>Unidad 1</th>
                        <th>Unidad 2</th>
                        <th>Unidad 3</th>
                        <th>Final</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estadisticasCaptura AS $estadisticas)
                        <tr>
                            <td>{{ $estadisticas->clave }}</td>
                            <td title="{{ $estadisticas->descripcion }}">{{ $estadisticas->abreviacion }}</td>
                            <td>{{ $estadisticas->profesor }}</td>
                            <td>{{ $estadisticas->total_alumnos }}</td>
                            <td>{{ $estadisticas->alumnos_con_unidad1 }}</td>
                            <td>{{ $estadisticas->alumnos_con_unidad2 }}</td>
                            <td>{{ $estadisticas->alumnos_con_unidad3 }}</td>
                            <td>{{ $estadisticas->alumnos_con_calificacion_final }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
    </div>

@endsection

@section('jscripts')
@endsection
