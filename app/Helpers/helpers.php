<?php
/**
 * Created by PhpStorm.
 * User: abalamjimenez
 * Date: 06/20/2020
 * Time: 20:21
 */

function currentUser()
{
    $user = Auth::user();

    return $user;
}

function ok(array $array)
{
    return response()->json($array, '200', [ 'Content-type' => 'application/json; charset=utf-8' ], JSON_UNESCAPED_UNICODE);
}

// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
//                                                   ROLES
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

function getUserGroups()
{
    $user = currentUser();

    return $user->groups()->pluck('descripcion')->toArray();
}


// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
//                                                     M  E  N  Ú
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

function menu()
{
    return [ 'menu' =>
                [

                ]
    ];
}

function menu2()
{
    return [ 'menu' =>
        [  //OK LINKS CATALOGOS AGREGADOS
            'nombre'   => 'Documentación',
            'url'      => route('home.documentacion'),
            'submenus' => [],
            'groups'   => [ 'supermario', 'seq_control_escolar', 'planteles_planes' ],
        ],
        [
            'nombre'   => 'Planes de estudio',
            'url'      => route('spa.planteles') . '/planes-estudio',
            'submenus' => [],
            'groups'   => [ 'supermario', 'planteles_planes' ],
        ],
        [
            'nombre'   => 'Planes de estudio',
            'url'      => route('spa.revisiones') . '/revisiones',
            'submenus' => [],
            'groups'   => [ 'supermario', 'seq_control_escolar', 'seq_media_superior', 'seq_normales', 'seq_superior' ],
        ],
        [
            'nombre'   => 'Alumnos', //OK LINKS AGREGADOS
            'submenus' => [
                [ 'nombre' => 'Nuevo',
                    'url'    => route('alumnos.index'),
                    'groups' => [ 'planteles_planes', 'planteles_control_escolar' ],
                ],
                [ 'nombre' => 'Registrados',
                    'url'    => route('alumnos.registrados'),
                    'groups' => [ 'planteles_planes', 'planteles_control_escolar', 'supermario', 'seq_control_escolar' ],
                ],
            ],
            'groups'   => [ 'planteles_planes', 'planteles_control_escolar', 'seq_control_escolar', 'supermario' ],
        ],
        [
            'nombre'   => 'Certificados',
            'url'      => '',
            'submenus' => [
                [ 'nombre' => 'Educación normal',
                    'url'    => route('certificados.generarCertificado', [
                        'descripcion_nivel' => '',
                        'centro_trabajo_id' => '',
                        'curp'              => '',
                        'matricula'         => '',
                    ]),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => 'Otros',
                    'url'    => route('certificados.certificados'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
            ],
            'groups'   => [ 'supermario', 'seq_control_escolar' ],
        ],
        [
            'nombre'   => 'Catálogos', //OK LINKS CATALOGOS AGREGADOS
            'url'      => '',
            'submenus' => [
                [ 'nombre' => 'Ciclos escolares',
                    'url'    => route('ciclos.escolares.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Generaciones',
                    'url'    => route('generaciones.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => 'Turnos',
                    'url'    => route('turnos.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => ' Fechas de expedición',
                    'url'    => route('FechasCertificados.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ]
                ,
                [ 'nombre' => 'Grados',
                    'url'    => route('grados.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => 'Grupos',
                    'url'    => route('grupo.index'),
                    'groups' => [ 'supermario', 'planteles' ],
                ],
                //[ 'nombre' => 'Subsistemas',
                //  'url'    => route('subsistema.index'),
                //  'groups' => [ 'supermario' ],
                //],
                [ 'nombre' => 'Modalidades',
                    'url'    => route('modalidad.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => 'Motivos cancelación',
                    'url'    => route('motivos.cancelacion.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                //[ 'nombre' => 'Niveles',
                //    'url'    => route('niveles.index'),
                //    'groups' => [ 'supermario', 'seq_control_escolar' ],
                //],
                //[ 'nombre' => 'Nivel estudio',
                //    'url'    => route('nivel-estudio.index'),
                //    'groups' => [ 'supermario', 'seq_control_escolar' ],
                //],
                [ 'nombre' => 'Periodicidades',
                    'url'    => route('periodicidad.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => 'Periodo escolar',
                    'url'    => route('periodo-escolar.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],

                [ 'nombre' => 'Responsables de nivel',
                    'url'    => route('responsables.nivel.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
                [ 'nombre' => ' Integración de CT ',
                    'url'    => route('centros_trabajo-turno.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
            ],
            'groups'   => [ 'supermario', 'seq_control_escolar' ],
        ],
        [
            //OK LINKS CATALOGOS AGREGADOS
            'nombre'   => 'Catálogos títulos',
            'url'      => '',
            'submenus' => [
                [ 'nombre' => 'Estudios antecedentes',
                    'url'    => route('estudio.antecedentes.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Modalidad titulación',
                    'url'    => route('modalidad.titulacion.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Entidades federativas',
                    'url'    => route('entidades.federativas.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Firmantes autorizados',
                    'url'    => route('firmantes.autorizados.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Fundamentos legales',
                    'url'    => route('fundamentos.legales.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Niveles académicos',
                    'url'    => route('grados.academicos.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => 'Autorización reconocimiento',
                    'url'    => route('autorizacion.reconocimiento.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario' ],
                ],
                [ 'nombre' => ' Instituciones carreras ',
                    'url'    => route('instituciones.carreras.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar', 'seq_titulos' ],
                ],
                [ 'nombre' => 'Servicio Social',
                    'url'    => route('nivel_educativo.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
            ],
            'groups'   => [ 'supermario', 'seq_control_escolar', 'seq_titulos' ],
        ],

        [
            'nombre'   => 'Certificado',
            'url'      => route('certificados.certificado'),
            'submenus' => [],
            'groups'   => [ 'planteles_planes' ],
        ],

        [
            'nombre'   => 'Certificados',
            'url'      => route('certificados.precertificado'),
            'submenus' => [],
            'groups'   => [ 'planteles_siceem' ],
        ],
        [
            'nombre'   => 'Precertificados',
            'url'      => route('certificados.precertificados'),
            'submenus' => [],
            'groups'   => [ 'supermario', 'seq_control_escolar', 'seq_siceem' ],
        ],

        [
            'nombre'   => 'Configuraciones',
            'url'      => '',
            'submenus' => [
                [ 'nombre' => 'Responsables de CT',
                    'url'    => route('centros.index'),
                    'groups' => [ 'seq_control_escolar', 'supermario', 'seq_media_superior', 'seq_normales', 'seq_superior' ],

                ],
//todo Habilitar cuando se defina que puede ver el perfil planteles_control_escolar
//                [ 'nombre' => 'Responsables de turno',
//                    'url'    => route('ctturnos.index'),
//                    'groups' => ['planteles_planes'],
//                ],
                /*[ 'nombre' => 'Responsables',
                  'url'    => route('responsables.index'),
                  'groups' => [ 'seq_control_escolar', 'supermario', 'seq_media_superior', 'seq_normales', 'seq_superior' ],
                ],*/

                //[ 'nombre' => 'Subsistemas',
                //  'url'    => '',
                //  'groups' => [ 'supermario', 'seq_superior' ],
                //],

                [ 'nombre' => 'Usuarios',
                    'url'    => route('usuarios.index'),
                    'groups' => [ 'supermario' ],
                ],
                //[ 'nombre' => 'Firmante Departamento',
                //  'url'    => route('firmante.departamento.index'),
                //  'groups' => [ 'supermario' ],
                //],
                /*
                [ 'nombre' => 'Firmante Departamento',
                  'url'    => route('firmante.departamento.index'),
                  'groups' => [ 'supermario' ],
                ],
                [ 'nombre' => 'Firmante Dirección',
                  'url'    => route('firmante.direccion.index'),
                  'groups' => [ 'supermario' ],
                ],
                */
                [ 'nombre' => 'Firmantes',
                    'url'    => route('catalogo.parametro.index'),
                    'groups' => [ 'supermario', 'seq_control_escolar' ],
                ],
            ],
            'groups'   => [ 'supermario', 'seq_control_escolar', 'seq_media_superior', 'seq_normales', 'seq_superior', ],
        ],
        [
            'nombre'   => 'DevZone',
            'submenus' => [
                [ 'nombre' => 'Estatus títulos',
                    'url'    => route('estatus.titulos.index'),
                    'groups' => [ 'supermario' ],
                ],
                [ 'nombre' => 'Motivos cancelación de títulos',
                    'url'    => route('motivo.cancelacion.index'),
                    'groups' => [ 'supermario' ],
                ],
                [ 'nombre' => 'Roles',
                    'url'    => route('group.index'),
                    'groups' => [ 'supermario' ],
                ],
            ],
            'groups'   => [ 'supermario' ],
        ],
        [
            'nombre'   => 'Admin. usuarios',
            'url'      => route('admin.usuarios.index'),
            'submenus' => [],
            'groups'   => [ 'supermario', 'seq_certificados', 'autoridad_educativa' ],
        ],
        [
            'nombre'   => 'Lotes',
            'url'      => route('lote.index'),
            'submenus' => [],
            'groups'   => [ 'supermario', 'enlace_dgp' ],
        ],
        [
            'nombre'   => 'Prepa Abierta',
            'url'      => route('prepa.abierta.index'),
            'submenus' => [],
            'groups'   => [ 'supermario' ],
        ],
        [
            'nombre'   => 'Catálogos',
            'submenus' => [
                [ 'nombre' => 'Competencias',
                    'url'    => route('prepa.abierta.catalogos.competencias.index'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
                [ 'nombre' => 'Dictamenes',
                    'url'    => route('prepa.abierta.catalogos.dictamenes.index'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
                [ 'nombre' => 'Trayectos',
                    'url'    => route('prepa.abierta.catalogos.trayectos.index'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
            ],
            'groups'   => [ 'prepa_abierta', 'supermario' ],
        ],
        [
            'nombre'   => 'Configuraciones',
            'submenus' => [
                [ 'nombre' => 'Plantel',
                    'url'    => route('prepa.abierta.configurar.plantel.index'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
                [ 'nombre' => 'Servicio',
                    'url'    => route('prepa.abierta.servicios.editar'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
            ],
            'groups'   => [ 'prepa_abierta', 'supermario' ],
        ],
        [
            'nombre'   => 'Planes de estudios',
            'url'      => route('prepa.abierta.plan.index'),
            'submenus' => [],
            'groups'   => [ 'prepa_abierta', 'supermario' ],
        ],
        [
            'nombre'   => 'Certificaciones',
            'submenus' => [
                [ 'nombre' => 'Certificados',
                    'url'    => route('prepa.abierta.certificados.index'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
                [ 'nombre' => 'Lotes',
                    'url'    => route('prepa.abierta.lotes.index'),
                    'groups' => [ 'prepa_abierta', 'supermario' ],
                ],
            ],
            'groups'   => [ 'prepa_abierta', 'supermario' ],
        ],
    ];
}
