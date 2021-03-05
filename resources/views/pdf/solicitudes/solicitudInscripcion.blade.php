<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        body{
            font-family: sans-serif;
            font-size:.8em;
        }
        header {
            margin-bottom:.5em;
        }
        header h1 {
            font-size:1em;
            text-align: center;
            margin:0px;
            padding:0px;
        }
        header h2 {
            font-size:.8em;
            text-align: center;
            margin:0px;
            padding:0px;
        }
        table{
            font-size:.9em;
        }
        table .border1 {
            border:1px solid;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: 50px;
            right: 0px;
            height: 80px;
        }
        .titulo {
            font-size:1em;
            margin-bottom: 1em;
            text-align: center;
        }
    </style>
<body>
<header>
    <table width="100%">
        <tr>
            <td width="25%" align="center">
                <img src="{{ asset('img/logo_reporte_eva.png') }}">
            </td>
            <td width="50%">
                <h1>CENTRO DE ESTUDIOS DE BACHILLERATO TÉCNICO</h1>
                <h2>"EVA SÁMANO DE LÓPEZ MATEOS"</h2>
            </td>
            <td align="center">
                <img src="{{ asset('img/logo_reporte_seq.png') }}">
            </td>
        </tr>
    </table>

    <div class="titulo">
        CÉDULA DE INSCRIPCIÓN<br>
        {{ $solicitud->periodoEscolar->descripcion }}<br>
        <div style="float:right">Fecha solicitud:{{  $solicitud->created_at->format('d/m/Y') }}</div>
    </div>
</header>

<div id="content">

    <h4 style="border-bottom:1px solid #C3C3C3;margin-bottom:.3em;margin-top:.5em">
        DATOS DEL ALUMNO
    </h4>

    <table width="100%" border="0">
    <tr>
        <td align="left">{{ $solicitud->primer_apellido }}</td>
        <td align="left">{{ $solicitud->segundo_apellido }}</td>
        <td align="left">{{ $solicitud->nombre }}</td>
        <td align="left">{{ $solicitud->curp }}</td>
    </tr>
    <tr>
        <th align="left">APELLIDO PATERNO</th>
        <th align="left">APELLIDO MATERNO</th>
        <th align="left">NOMBRE(S)</th>
        <th align="left">CURP</th>
    </tr>
    <tr>
        <td align="left">
            @if (empty($solicitud->fecha_nacimiento))
                ND*
            @else
                {{ $solicitud->fecha_nacimiento }}
            @endif
        </td>
        <td align="left">
            @if (empty($solicitud->sexo))
                ND*
            @else
                {{ $solicitud->sexo }}
            @endif
        </td>
        <td align="left">
            @if (empty($solicitud->telefono))
                ND*
            @else
                {{ $solicitud->telefono }}
            @endif
        </td>
        <td align="left">
            @if (empty($solicitud->email))
                ND*
            @else
                {{ $solicitud->email }}
            @endif
        </td>
    </tr>
    <tr>
        <th align="left">FECHA DE NACIMIENTO</th>
        <th align="left">SEXO</th>
        <th align="left">TELÉFONO</th>
        <th align="left">CORREO ELECTRÓNICO</th>
    </tr>
    <tr>
        <td colspan="3" align="left">
            @if($solicitud->nacionalidad_tipo == 'MEXICANA')
                {{ $solicitud->nacionalidad_tipo }}
            @else
                {{ $solicitud->nacionalidad_tipo }} ({{ $solicitud->nacionalidad_descripcion }})
            @endif
        </td>
        <td align="left">
            @if (empty($solicitud->tipoSangre->descripcion))
                ND*
            @else
                {{ $solicitud->tipoSangre->descripcion }}
            @endif
        </td>
    </tr>
    <tr>
        <th colspan="3" align="left">NACIONALIDAD</th>
        <th align="left">Tipo de Sangre</th>
    </tr>
    <tr>
        <td colspan="2" align="left">
            @if (empty($solicitud->enfermedad))
                ND*
            @else
                {{ $solicitud->enfermedad }}
            @endif
        </td>
    </tr>
    <tr>
        <th colspan="2" align="left">¿PADECES ALGUNA ENFERMEDAD, CUÁL?</th>
    </tr>
    <tr>
        <td align="left" colspan="2">
            @if (empty($solicitud->domicilio_calle))
                ND*
            @else
                {{ $solicitud->domicilio_calle }}
            @endif
        </td>
        <td align="left" colspan="2">
            @if (empty($solicitud->domicilio_cruzamientos))
                ND*
            @else
                {{ $solicitud->domicilio_cruzamientos }}
            @endif
        </td>
    </tr>
    <tr>
        <th colspan="2" align="left">CALLE</th>
        <th colspan="2" align="left">CRUZAMIENTOS</th>
    </tr>
    <tr>
        <td align="left">
            @if (empty($solicitud->domicilio_numero))
                ND*
            @else
                {{ $solicitud->domicilio_numero }}
            @endif
        </td>
        <td align="left">
            @if (empty($solicitud->domicilio_codigo_postal))
                ND*
            @else
                {{ $solicitud->domicilio_codigo_postal }}
            @endif
        </td>
        <td align="left" colspan="2">
            @if (empty($solicitud->domicilio_colonia))
                ND*
            @else
                {{ $solicitud->domicilio_colonia }}
            @endif
        </td>
    </tr>
    <tr>
        <th align="left">NÚMERO</th>
        <th align="left">CÓDIGO POSTAL</th>
        <th colspan="2" align="left">
            COLONIA Y LOCALIDAD
        </th>
    </tr>
    </table>

    <h4 style="border-bottom:1px solid #C3C3C3;margin-bottom:.3em;margin-top:.5em">
        DATOS ACADÉMICOS
    </h4>

    <table width="100%" border="0">
    <tr>
        <th align="left">CARRERA</th>
        <td>
            @if (empty($solicitud->carrera_descripcion))
                ND*
            @else
                {{ $solicitud->carrera_descripcion }}
            @endif

        </td>
        <th align="left">SEMESTRE</th>
        <td>
            @if (empty($solicitud->grado_id))
                ND*
            @else
                {{ $solicitud->grado_id }}
            @endif

        </td>
        <th align="left">TURNO</th>
        <td>
            @if (empty($solicitud->turno_descripcion))
                ND*
            @else
                {{ $solicitud->turno_descripcion }}
            @endif
        </td>
    </tr>
    <tr>
        <th align="left">SECUNDARIA DE PROCEDENCIA</th>
        <td colspan="3">{{ $solicitud->secundaria_procedencia_descripcion }}</td>
        <th align="left">Promedio</th>
        <td>{{ $solicitud->secundaria_procedencia_promedio }}</td>
    </tr>
    <tr>
        <th align="left">BACHILLERATO DE PROCEDENCIA</th>
        <td colspan="5">{{ $solicitud->bachillerato_procedencia_descripcion }}</td>
    </tr>
    </table>

    <h4 style="border-bottom:1px solid #C3C3C3;margin-bottom:.3em;margin-top:.5em">
        DATOS DEL PADRE O TUTOR
    </h4>

    <table width="100%" border="0">
        <tr>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->primer_apellido))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->primer_apellido }}
                @endif
            </td>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->segundo_apellido))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->segundo_apellido }}
                @endif
            </td>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->nombre))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->nombre }}
                @endif
            </td>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->curp))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->curp }}
                @endif
            </td>
        </tr>
        <tr>
            <th align="left">APELLIDO PATERNO</th>
            <th align="left">APELLIDO MATERNO</th>
            <th align="left">NOMBRE(S)</th>
            <th align="left">CURP</th>
        </tr>
        <tr>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->email))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->email }}
                @endif

            </td>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->telefono))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->telefono }}
                @endif
            </td>
            <td align="left"></td>
            <td align="left"></td>
        </tr>
        <tr>
            <th align="left">CORREO ELECTRÓNICO</th>
            <th align="left">TELÉFONO</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudTutor->domicilio_calle))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->domicilio_calle }}
                @endif
            </td>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudTutor->domicilio_cruzamientos))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->domicilio_cruzamientos }}
                @endif

            </td>
        </tr>
        <tr>
            <th colspan="2" align="left">CALLE</th>
            <th colspan="2" align="left">CRUZAMIENTOS</th>
        </tr>
        <tr>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->domicilio_numero))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->domicilio_numero }}
                @endif

            </td>
            <td align="left">
                @if (empty($solicitud->solicitudTutor->domicilio_codigo_postal))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->domicilio_codigo_postal }}
                @endif
            </td>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudTutor->domicilio_colonia))
                    ND*
                @else
                    {{ $solicitud->solicitudTutor->domicilio_colonia }}
                @endif
            </td>
        </tr>
        <tr>
            <th align="left">NÚMERO</th>
            <th align="left">CÓDIGO POSTAL</th>
            <th colspan="2" align="left">COLONIA Y LOCALIDAD</th>
        </tr>
    </table>

    <h4 style="border-bottom:1px solid #C3C3C3; margin-bottom:.3em;margin-top:.5em">
        DATOS LABORALES DEL PADRE O TUTOR
    </h4>

    <table width="100%" border="0">
        <tr>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudCt->ct))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->ct }}
                @endif
            </td>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudCt->ocupacion))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->ocupacion }}
                @endif
            </td>
        </tr>
        <tr>
            <th align="left" colspan="2">CENTRO DE TRABAJO</th>
            <th align="left" colspan="2">OCUPACIÓN</th>
        </tr>
        <tr>
            <td align="left">
                @if (empty($solicitud->solicitudCt->telefono))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->telefono }}
                @endif

            </td>
            <td align="left">
                @if (empty($solicitud->solicitudCt->telefono_extension))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->telefono_extension }}
                @endif
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th align="left">TELÉFONO</th>
            <th align="left">EXTENSIÓN</th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudCt->domicilio_calle))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->domicilio_calle }}
                @endif
            </td>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudCt->domicilio_cruzamientos))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->domicilio_cruzamientos }}
                @endif
            </td>
        </tr>
        <tr>
            <th colspan="2" align="left">CALLE</th>
            <th colspan="2" align="left">CRUZAMIENTOS</th>
        </tr>
        <tr>
            <td align="left">
                @if (empty($solicitud->solicitudCt->domicilio_numero))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->domicilio_numero }}
                @endif
            </td>
            <td align="left">
                @if (empty($solicitud->solicitudCt->domicilio_codigo_postal))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->domicilio_codigo_postal }}
                @endif
            </td>
            <td align="left" colspan="2">
                @if (empty($solicitud->solicitudCt->domicilio_colonia))
                    ND*
                @else
                    {{ $solicitud->solicitudCt->domicilio_colonia }}
                @endif
            </td>
        </tr>
        <tr>
            <th align="left">NÚMERO</th>
            <th align="left">CÓDIGO POSTAL</th>
            <th colspan="2" align="left">COLONIA Y LOCALIDAD</th>
        </tr>
    </table>

    <h5 style="border-bottom:1px solid #C3C3C3;margin-top:1em;margin-bottom:0px;font-size:.7em">
        DOCUMENTOS PARA INSCRIPCIÓN
    </h5>

    <table width="100%" border="0" style="font-size:.6em">
    <tr>
        <td>__ ACTA DE NACIMIENTO(ORIG. Y 2 COPIAS)</td>
        <td>__ CERTIFIC. SECUNDARIA(ORIG. Y 2 COPIAS)</td>
        <td>__ CURP (2 COPIAS)</td>
    </tr>
    <tr>
        <td>__ COMPROB. DOMICILIO(1 COPIA)</td>
        <td>__ CREDENCIAL DEL TUTOR(1 COPIA)</td>
        <td>__ HOJA DE SEGURO SOCIAL O CARNET(1 COPIA)</td>
    </tr>
    </table>
</div>

<footer>
    <table width="100%" border="1" cellspacing="0">
        <tr>
            <td height="50px" width="33%"></td>
            <td width="33%"></td>
            <td></td>
        </tr>
        <tr>
            <td align="center">
                NOMBRE Y FIRMA DEL ALUMNO
            </td>
            <td align="center">
                NOMBRE Y FIRMA DEL PADRE O TUTOR
            </td>
            <td align="center">
                NOMBRE Y FIRMA DEL ÁREA DE CONTROL ESCOLAR
            </td>
        </tr>
    </table>

    <p>
        <small>ND*. La información no fue especificado en la captura.</small><br />
        Fecha de impresión: {{ date('d-m-Y') }}
    </p>
</footer>

</body>
</html>
