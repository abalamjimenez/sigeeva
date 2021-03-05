@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pase de lista</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Estadisticas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        <h3 style="margin-top:1em">Cuentas de alumnos por validar</h3>

        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">2do Semestre</span>
                            <span class="info-box-number">{{ $xValidar->cuentas_x_validar_2 }} de {{ $totalXGrado[2] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">4to Semestre</span>
                            <span class="info-box-number">{{ $xValidar->cuentas_x_validar_4 }} de {{ $totalXGrado[4] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">6to Semestre</span>
                            <span class="info-box-number">{{ $xValidar->cuentas_x_validar_6 }} de {{ $totalXGrado[6] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 style="margin-top:1em">
            Grupos con alumnos que faltan por validar

            <a href="{{ route('grupos.descargarCuentas') }}" class="btn btn-info">
                Descargar
            </a>
        </h3>

        <table class="table table-bordered" border="1">
            <thead>
            <tr>
                <th>#</th>
                <th>GRUPO</th>
                <th>VALIDADOS</th>
                <th>NO VALIDADOS</th>
                <th>% VALIDADOS</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $cuentasValidadas = 0;
            $cuentasXValidar = 0;
            ?>
            @foreach($gruposxvalidar AS $grupo)
                <?php
                $porcentaje = $grupo->cuenta_validada*100 / ($grupo->cuenta_validada + $grupo->cuenta_por_validar);
                $porcentaje = round($porcentaje,2);

                $cuentasValidadas = $cuentasValidadas + $grupo->cuenta_validada;
                $cuentasXValidar  = $cuentasXValidar + $grupo->cuenta_por_validar;
                ?>
                <tr>
                    <td align="center">
                        {{ $loop->iteration }}
                    </td>
                    <td align="center">{{ $grupo->clave }}</td>
                    <td align="center">
                        <a href="{{ route('grupos.imprimirCuentas',[$grupo->grupo_id,'tipo'=>'VALIDADAS']) }}" class="btn btn-info">
                            {{ $grupo->cuenta_validada }}
                        </a>
                    </td>
                    <td align="center">
                        <a href="{{ route('grupos.imprimirCuentas',[$grupo->grupo_id,'tipo'=>'XVALIDAR']) }}" class="btn btn-info">
                            {{ $grupo->cuenta_por_validar }}
                        </a>
                    </td>
                    <td>{{ $porcentaje }}</td>
                </tr>
            @endforeach
            </tbody>
            <thead>
            <tr>
                <td colspan="2">SUMA</td>
                <td>{{ $cuentasValidadas }}</td>
                <td>{{ $cuentasXValidar }}</td>
                <td>
                    <?php
                    $porcentaje = $cuentasValidadas*100 / ($cuentasValidadas+$cuentasXValidar);

                    echo round($porcentaje,2);
                    ?>

                </td>
            </tr>
            </thead>
        </table>
    </div>
@endsection
