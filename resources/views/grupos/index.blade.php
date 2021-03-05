@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Grupos por asignatura</h1>
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
    <?php
    $userGroups                      = getUserGroups();
    $permite_capturar_calificaciones = 'N';

    if( count(array_intersect($userGroups, ['servicio_escolar'])) ||
        count(array_intersect($userGroups, ['control_escolar'])))
    {
        $permite_capturar_calificaciones = 'N';
    }
    ?>

    <div class="container-fluid">

        @foreach ($arregloAsignaturas AS $key=>$asignaturasxGrupo)

            <?php
            $first = reset($asignaturasxGrupo);
            ?>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <strong>GRUPO {{ $arregloGrupos[$key]['grupo_id'] }}:</strong> {{ $key }}
                    <br>
                    <strong>TUTOR(A):</strong> {{ $arregloGrupos[$key]['nombreCompletoTutor'] }}
                    <br>
                    <strong>RESPONSABLE EN CONTROL ESCOLAR:</strong> {{ $arregloGrupos[$key]['nombreCompletoResponsableControlEscolar'] }}

                    <br>
                    <a href="{{ route('grupos.imprimirListadoGrupo',$first['grupo_id']) }}" class="btn btn-info">
                        <i class="fa fa-print"></i> Descargar listado
                    </a>

                    <a href="{{ route('grupos.imprimirSabanaGrupo',$first['grupo_id']) }}" class="btn btn-info">
                        <i class="fa fa-print"></i> Descargar Sabana
                    </a>

                    <a href="{{ route('grupos.descargarDatosContacto',$first['grupo_id']) }}" class="btn btn-info">
                        <i class="fa fa-print"></i> Descargar Contactos
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th colspan="7"></th>
                        <th style="background-color: #f68b8b; text-align: center" colspan="3">Reprobados por unidad</th>
                        <th style="text-align: center" colspan="3">Calificaciones en blanco</th>
                        <th style="background-color: #bcfbf8; text-align: center" colspan="3">Aprobados</th>
                    </tr>
                    <tr>
                        <?php
                        if ($permite_capturar_calificaciones == 'S')
                        {
                            ?>
                            <th>&nbsp;</th>
                            <?php
                        }
                        ?>
                        <th>#</th>
                        <th>Materia</th>
                        <th>Docente</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Turno</th>

                        <th>Total</th>

                        <th style="background-color: #f68b8b">Unidad1</th>
                        <th style="background-color: #f68b8b">Unidad2</th>
                        <th style="background-color: #f68b8b">Unidad3</th>

                        <th>Unidad1</th>
                        <th>Unidad2</th>
                        <th>Unidad3</th>

                        <th style="background-color: #bcfbf8">Unidad1</th>
                        <th style="background-color: #bcfbf8">Unidad2</th>
                        <th style="background-color: #bcfbf8">Unidad3</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($asignaturasxGrupo AS $asignaturaGrupo)
                        <tr>
                            <?php
                            if ($permite_capturar_calificaciones == 'S')
                            {
                                ?>
                                <td>
                                    <div class="dropdown position-static show">
                                        <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                                            Acciones
                                        </a>

                                        <div class="dropdown-menu">

                                            <!--
                                            <a
                                               id="btnMostrarOcultar{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                               class="dropdown-item cargarOcultar"
                                               data-asignatura-horario-id="{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                               style="cursor:pointer;display:none">
                                                Detalle
                                            </a>

                                            <a
                                               id="btnCargar{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                               class="dropdown-item detalle"
                                               data-asignatura-horario-id="{{ $asignaturaGrupo['asignatura_grupo_id'] }}"
                                                style="cursor:pointer">
                                                Detalle
                                            </a>

                                            !-->

                                            <a class="dropdown-item" href="{{route('grupos.capturarCalificacionesAdmin', $asignaturaGrupo['asignatura_grupo_id'])}}">
                                                Capturar calificaciones
                                            </a>

                                        </div>
                                    </div>
                                </td>
                                <?php
                            }
                            ?>
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

                            <td>{{ $asignaturaGrupo['total_alumnos'] }}</td>

                            <td align="center" style="background-color: #f68b8b">{{ $asignaturaGrupo['reprobados_unidad1'] }}</td>
                            <td align="center" style="background-color: #f68b8b">{{ $asignaturaGrupo['reprobados_unidad2'] }}</td>
                            <td align="center" style="background-color: #f68b8b">{{ $asignaturaGrupo['reprobados_unidad3'] }}</td>

                            <td align="center">{{ $asignaturaGrupo['en_blanco_unidad1'] }}</td>
                            <td align="center">{{ $asignaturaGrupo['en_blanco_unidad2'] }}</td>
                            <td align="center">{{ $asignaturaGrupo['en_blanco_unidad3'] }}</td>

                            <td style="background-color: #bcfbf8" align="center">{{ $asignaturaGrupo['aprobados_unidad1'] }}</td>
                            <td style="background-color: #bcfbf8" align="center">{{ $asignaturaGrupo['aprobados_unidad2'] }}</td>
                            <td style="background-color: #bcfbf8" align="center">{{ $asignaturaGrupo['aprobados_unidad3'] }}</td>
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
                    <thead>
                    <tr>
                        <th style="text-align: right" colspan="7">TOTALES</th>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['reprobados_unidad1']?></td>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['reprobados_unidad2']?></td>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['reprobados_unidad3']?></td>

                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['en_blanco_unidad1']?></td>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['en_blanco_unidad2']?></td>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['en_blanco_unidad3']?></td>

                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['aprobados_unidad1']?></td>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['aprobados_unidad2']?></td>
                        <td style="text-align:center"><?php echo $arregloTotalesGrupo[$key]['aprobados_unidad3']?></td>
                    </tr>
                    </thead>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>

        @endforeach

    </div>
@endsection

@section('jscripts')
    <script src="{{ mix('js/grupos/index.js') }}"></script>
@endsection
