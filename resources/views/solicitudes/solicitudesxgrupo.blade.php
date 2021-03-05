@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Solicitudes

                        <!--
                        <a href="{{ route('solicitudes.descargarSolicitudes',array('qry'=>'TOTALES')) }}" class="btn btn-info">
                            <i class="fa fa-print"></i> Descargar listado
                        </a>
                        !-->
                    </h1>
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

    <h3 style="margin-top:1em">

        Reinscripción

        <a href="{{ route('solicitudes.descargarSolicitudes',array('qry'=>'REINSCRIPCION')) }}" class="btn btn-info">
            <i class="fa fa-print"></i> Descargar listado
        </a>

    </h3>

    <?php
    $solicitudesEsperadas   = 0;
    $solicitudesPendientes  = 0;
    $solicitudesEnviadas    = 0;
    $solicitudesAplicadas   = 0;
    ?>

    <table class="table table-bordered">
    <tr>
        <th>Grupo</th>
        <th>Esperadas</th>
        <th>Pendientes</th>
        <th>Enviadas</th>
        <th>Aplicadas</th>
    </tr>
    @foreach($solicitudesxgrupo AS $solicitud)

    <?php
    $solicitudesEsperadas  = $solicitudesEsperadas + $solicitud->inscripcionEsperada;
    $solicitudesPendientes = $solicitudesPendientes + $solicitud->inscripcionPendiente;
    $solicitudesEnviadas   = $solicitudesEnviadas + $solicitud->inscripcionRealizada;
    $solicitudesAplicadas  = $solicitudesAplicadas + $solicitud->inscripcionAplicada;
    ?>
    <tr>
        <td>{{ $solicitud->claveGrupo }}</td>
        <td><strong>{{ $solicitud->inscripcionEsperada }}</strong> (100%)</td>
        <td>
            <?php
            $porcentajePendiente = ($solicitud->inscripcionPendiente * 100) / $solicitud->inscripcionEsperada;
            $porcentajePendiente = number_format($porcentajePendiente,0);

            $porcentajeEnviado = ($solicitud->inscripcionRealizada * 100) / $solicitud->inscripcionEsperada;
            $porcentajeEnviado = number_format($porcentajeEnviado,0);

            $porcentajeAplicado = ($solicitud->inscripcionAplicada * 100) / $solicitud->inscripcionEsperada;
            $porcentajeAplicado = number_format($porcentajeAplicado,0);
            ?>
            [  <strong>{{ $solicitud->inscripcionPendiente }}</strong> ({{ $porcentajePendiente }}%) ]

            <a href="{{ route('solicitudes.descargarSolicitudes',array('qry'=>'REINSCRIPCION','grupo_id'=>$solicitud->grupo_id)) }}">
                <i class="fa fa-print"></i> Descargar listado
            </a>
        </td>
        <td>
            <strong>{{ $solicitud->inscripcionRealizada }}</strong> ({{ $porcentajeEnviado }}%)
        </td>
        <td>
            <strong>{{ $solicitud->inscripcionAplicada }}</strong> ({{ $porcentajeEnviado }}%)
        </td>
    </tr>
    @endforeach

    <?php
        $porcentajePendiente = ($solicitudesPendientes * 100) / $solicitudesEsperadas;
        $porcentajeEnviado   = ($solicitudesEnviadas * 100) / $solicitudesEsperadas;
        $porcentajeAplicado  = ($solicitudesAplicadas * 100) / $solicitudesEsperadas;

        $porcentajePendiente = number_format($porcentajePendiente,0);
        $porcentajeEnviado = number_format($porcentajeEnviado,0);
        $porcentajeAplicado = number_format($porcentajeAplicado,0);

    ?>
    <tfoot>
    <tr>
        <th>Totales</th>
        <th>{{ $solicitudesEsperadas }} (100%) </th>
        <th>{{ $solicitudesPendientes }} ({{ $porcentajePendiente }}%) </th>
        <th>{{ $solicitudesEnviadas }} ({{ $porcentajeEnviado }}%) </th>
        <th>{{ $solicitudesAplicadas }} ({{ $porcentajeAplicado }}%) </th>
    </tr>
    </tfoot>
    </table>

</div>
@endsection
