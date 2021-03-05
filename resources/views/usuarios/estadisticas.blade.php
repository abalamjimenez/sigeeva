@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estadisticas</h1>
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
        Solicitudes

        <a href="{{ route('solicitudes.descargarSolicitudes') }}" class="btn btn-info">
            <i class="fa fa-print"></i> Descargar listado
        </a>
    </h3>

    <table class="table table-bordered">
    <tr>
        <th>Estatus</th>
        <th>Totales</th>
        <th>1er Semestre</th>
        <th>3er Semestre</th>
        <th>5to Semestre</th>
    </tr>
    <tr>
        <th>Pendientes</th>
        <td>{{ $solicitudes->solicitudes_en_borrador }}</td>
        <td>{{ $solicitudes->solicitudes_en_borrador_1 }}</td>
        <td>{{ $solicitudes->solicitudes_en_borrador_3 }}</td>
        <td>{{ $solicitudes->solicitudes_en_borrador_5 }}</td>
    </tr>
    <tr>
        <th>Rechazadas</th>
        <td>{{ $solicitudes->solicitudes_rechazadas }}</td>
        <td>{{ $solicitudes->solicitudes_rechazadas_1 }}</td>
        <td>{{ $solicitudes->solicitudes_rechazadas_3 }}</td>
        <td>{{ $solicitudes->solicitudes_rechazadas_5 }}</td>
    </tr>
    <tr>
        <th>Enviadas</th>
        <td>{{ $solicitudes->solicitudes_enviadas }}</td>
        <td>{{ $solicitudes->solicitudes_enviadas_1 }}</td>
        <td>{{ $solicitudes->solicitudes_enviadas_3 }}</td>
        <td>{{ $solicitudes->solicitudes_enviadas_5 }}</td>
    </tr>
    <tr>
        <th>Validadas</th>
        <td>{{ $solicitudes->solicitudes_validadas }}</td>
        <td>{{ $solicitudes->solicitudes_validadas_1 }}</td>
        <td>{{ $solicitudes->solicitudes_validadas_3 }}</td>
        <td>{{ $solicitudes->solicitudes_validadas_5 }}</td>
    </tr>
    <tr>
        <th>Procesadas</th>
        <td>{{ $solicitudes->solicitudes_procesadas }}</td>
        <td>{{ $solicitudes->solicitudes_procesadas_1 }}</td>
        <td>{{ $solicitudes->solicitudes_procesadas_3 }}</td>
        <td>{{ $solicitudes->solicitudes_procesadas_5 }}</td>
    </tr>
    <tr>
        <th>En revisión</th>
        <td>{{ $solicitudes->solicitudes_en_revision }}</td>
        <td>{{ $solicitudes->solicitudes_en_revision_1 }}</td>
        <td>{{ $solicitudes->solicitudes_en_revision_3 }}</td>
        <td>{{ $solicitudes->solicitudes_en_revision_5 }}</td>
    </tr>
    <tr>
        <th>Aplicadas</th>
        <td>{{ $solicitudes->solicitudes_aplicadas }}</td>
        <td>{{ $solicitudes->solicitudes_aplicadas_1 }}</td>
        <td>{{ $solicitudes->solicitudes_aplicadas_3 }}</td>
        <td>{{ $solicitudes->solicitudes_aplicadas_5 }}</td>
    </tr>
    </table>

    <h3>Solicitudes de nuevo ingreso</h3>

    <table class="table table-bordered">
        <tr>
            <th>Estatus</th>
            <th>Totales</th>
            <th>CURP</th>
            <th>Folio Paenms</th>
        </tr>
        <tr>
            <th>Pendientes</th>
            <td>{{ $solicitudes->solicitudes_pendientes_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_pendientes_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_pendientes_nuevo_ingreso_folio }}</td>
        </tr>
        <tr>
            <th>Rechazadas</th>
            <td>{{ $solicitudes->solicitudes_rechazadas_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_rechazadas_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_rechazadas_nuevo_ingreso_folio }}</td>
        </tr>
        <tr>
            <th>Enviadas</th>
            <td>{{ $solicitudes->solicitudes_enviadas_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_enviadas_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_enviadas_nuevo_ingreso_folio }}</td>
        </tr>
        <tr>
            <th>Validadas</th>
            <td>{{ $solicitudes->solicitudes_validadas_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_validadas_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_validadas_nuevo_ingreso_folio }}</td>
        </tr>
        <tr>
            <th>Procesadas</th>
            <td>{{ $solicitudes->solicitudes_en_revision_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_procesadas_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_procesadas_nuevo_ingreso_folio }}</td>
        </tr>
        <tr>
            <th>En revisión</th>
            <td>{{ $solicitudes->solicitudes_procesadas_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_en_revision_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_en_revision_nuevo_ingreso_folio }}</td>
        </tr>
        <tr>
            <th>Aplicadas</th>
            <td>{{ $solicitudes->solicitudes_aplicadas_nuevo_ingreso }}</td>
            <td>{{ $solicitudes->solicitudes_aplicadas_nuevo_ingreso_curp }}</td>
            <td>{{ $solicitudes->solicitudes_aplicadas_nuevo_ingreso_folio }}</td>
        </tr>
    </table>



{{--
    <table class="table table-bordered">
        <tr>
            <th colspan="3" style="text-align:center">
                {{ $solicitudes->solicitudes_en_borrador }} Solicitudes en borrador

                <a href="{{ route('solicitudes.descargarSolicitudesPendientes') }}" class="btn btn-info">
                    <i class="fa fa-print"></i> Descargar listado
                </a>
            </th>
            <th colspan="3" style="text-align:center">
                {{ $solicitudes->solicitudes_enviadas }} Solicitudes finalizadas
                <a href="{{ route('solicitudes.descargarSolicitudesEnviadas') }}" class="btn btn-info">
                    <i class="fa fa-print"></i> Descargar listado
                </a>
            </th>
        </tr>
        <tr>
            <th style="text-align:center">1 Semestre</th>
            <th style="text-align:center">3 Semestre</th>
            <th style="text-align:center">5 Semestre</th>

            <th style="text-align:center">1 Semestre</th>
            <th style="text-align:center">3 Semestre</th>
            <th style="text-align:center">5 Semestre</th>
        </tr>
        <tr>
            <td style="text-align:center">{{ $solicitudes->solicitudes_en_borrador_1 }}</td>
            <td style="text-align:center">{{ $solicitudes->solicitudes_en_borrador_3 }}</td>
            <td style="text-align:center">{{ $solicitudes->solicitudes_en_borrador_5 }}</td>

            <td style="text-align:center">{{ $solicitudes->solicitudes_enviadas_1 }}</td>
            <td style="text-align:center">{{ $solicitudes->solicitudes_enviadas_3 }}</td>
            <td style="text-align:center">{{ $solicitudes->solicitudes_enviadas_5 }}</td>
        </tr>
    </table>

    <?php
    $nuevo_ingreso = $solicitudes->solicitudes_pendientes_nuevo_ingreso_curp+$solicitudes->solicitudes_pendientes_nuevo_ingreso_folio;
    $nuevo_ingreso = $nuevo_ingreso+$solicitudes->solicitudes_finalizadas_nuevo_ingreso_curp+$solicitudes->solicitudes_finalizadas_nuevo_ingreso_folio;

    $pendientes  = $solicitudes->solicitudes_pendientes_nuevo_ingreso_curp+$solicitudes->solicitudes_pendientes_nuevo_ingreso_folio;
    $finalizadas = $solicitudes->solicitudes_finalizadas_nuevo_ingreso_curp+$solicitudes->solicitudes_finalizadas_nuevo_ingreso_folio;
    ?>



    <h3>Solicitudes Nuevo Ingreso ({{ $nuevo_ingreso }})</h3>

    <table class="table table-bordered">
    <tr>
        <th style="text-align:center" colspan="2">Solicitudes pendientes ({{ $pendientes }})</th>
        <th style="text-align:center" colspan="2">Solicitudes finalizadas ({{ $finalizadas }})</th>
    </tr>
    <tr>
        <th style="text-align:center">Inscripcion por Folio</th>
        <th style="text-align:center">Inscripción por CURP</th>
        <th style="text-align:center">Inscripcion por Folio</th>
        <th style="text-align:center">Inscripción por CURP</th>
    </tr>
    <tr>
        <td style="text-align:center">{{ $solicitudes->solicitudes_pendientes_nuevo_ingreso_folio }}</td>
        <td style="text-align:center">{{ $solicitudes->solicitudes_pendientes_nuevo_ingreso_curp }}</td>
        <td style="text-align:center">{{ $solicitudes->solicitudes_finalizadas_nuevo_ingreso_folio }}</td>
        <td style="text-align:center">{{ $solicitudes->solicitudes_finalizadas_nuevo_ingreso_curp }}</td>
    </tr>
    </table>


    <h3>Alumnos</h3>

    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Cuentas validadas</span>
                        <span class="info-box-number">{{ $usuarios->cuenta_validada_count_s }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Cuentas por validar</span>
                        <span class="info-box-number">{{ $usuarios->cuenta_validada_count_n }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Correos enviados</span>
                        <span class="info-box-number">{{ $usuarios->correo_automatico_enviado_count_s }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Solicitudes atendidas</span>
                        <span class="info-box-number">{{ $usuarios->correo_manual_enviado_count_s }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    --}}
</div>
@endsection
