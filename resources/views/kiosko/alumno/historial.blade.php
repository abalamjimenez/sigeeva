@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Alumno</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Kiosko</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container-fluid">

        <?php
        if(isset($failedRules['nombre']['Required']))
        {
            ?>
            <div class="alert alert-danger">
                <ul>
                    <li>Ingrese el nombre a buscar</li>
                </ul>
            </div>
            <?php
        }
        ?>

        {!! Form::open(['route'=>'kiosko.alumno.historial','method'=>'get']) !!}

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Ingrese el nombre del alumno</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::input('text','nombre',request('nombre'),['class'=>'form-control']) !!}
                            <small>Ingresar: Apellido(s) Nombre(s)</small>
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

        @if (!empty($_GET['nombre']))
                <div class="card card-primary card-outline">

                    <div class="card-header">
                        Resultados de la búsqueda
                        -
                        Mostrando {{collect($registros->items())->count()}} registros de un total de {{$registros->total()}}
                    </div>

                    <div class="card-body" id="registros">

                        <table class="table table-condensed table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Acciones</th>
                                <td>Curp</td>
                                <td>Nombre</td>
                                <td>Fecha de nacimiento</td>
                                <td>Teléfono</td>
                                <td>Correo</td>
                                <td>Núm. Seguridad Social</td>
                                <td>Fecha de registro</td>
                                <td>ID</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($registros as $registro)
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="{{route('kiosko.alumno.detalleHistorial', $registro->uuid)}}">
                                            Detalle
                                        </a>
                                    </td>
                                    <td>{{ $registro->curp }}</td>
                                    <td>{{ $registro->nombre_completo }}</td>
                                    <td>{{ $registro->fecha_nacimiento }}</td>
                                    <td>{{ $registro->telefono }}</td>
                                    <td>{{ $registro->email }}</td>
                                    <td>{{ $registro->num_seguridad_social }}</td>
                                    <td>{{ $registro->created_at }}</td>
                                    <td>{{ $registro->id }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="card-footer" id="foo-rows">
                        {{ $registros->links() }}
                    </div>
                </div>
        @endif

    </div>

@endsection

@section('jscripts')
@endsection
