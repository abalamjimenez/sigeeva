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
            margin-bottom:1em;
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
            bottom: -60px;
            right: 0px;
            height: 80px;
        }
        .titulo {
            font-size:1em;
            margin-top:1em;
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
            BOLETA DE CALIFICACIONES<br>
            {{ $arregloDatosGenerales['periodo_escolar_descripcion'] }}
        </div>

        <table>
        <tr>
            <th align="left">NOMBRE DEL ALUMNO:</th>
            <td>{{ $arregloDatosGenerales['primer_apellido'] }} / {{ $arregloDatosGenerales['segundo_apellido'] }} * {{ $arregloDatosGenerales['nombre'] }}</td>
            <td width="50px"></td>
            <th align="left">SEMESTRE</th>
            <td width="100px">{{ $arregloDatosGenerales['semestre'] }}</td>
        </tr>
        <tr>
            <th align="left">CARRERA:</th>
            <td>{{ $arregloDatosGenerales['carrera_descripcion'] }}</td>
            <td>&nbsp;</td>
            <th align="left">TURNO</th>
            <td>{{ $arregloDatosGenerales['turno_descripcion'] }}</td>
        </tr>
        </table>
    </header>

    <div id="content">
        <table border="1">
        <thead>
            <tr>
                <th>ASIGNATURA</th>
                <th>PROFESOR</th>
                <th>U1</th>
                <th>U2</th>
                <th>U3</th>
                <th>CALIFICACIÓN</th>
                <th>E1</th>
                <th>E2</th>
                <th>EE</th>
            </tr>
        </thead>
        <tbody>
        @foreach($arregloAsignaturas['regular'] AS $asignaturaRegular)
            <tr>
                <td align="left">{{ $asignaturaRegular['descripcion'] }}</td>
                <td align="left">{{ $asignaturaRegular['profesor'] }}</td>
                <td align="center">{{ $asignaturaRegular['unidad1'] }}</td>
                <td align="center">{{ $asignaturaRegular['unidad2'] }}</td>
                <td align="center">{{ $asignaturaRegular['unidad3'] }}</td>
                <td align="center">{{ $asignaturaRegular['calificacion_final'] }}</td>
                <td align="center">{{ $asignaturaRegular['extraordinario1'] }}</td>
                <td align="center">{{ $asignaturaRegular['extraordinario2'] }}</td>
                <td align="center">{{ $asignaturaRegular['examen_especial'] }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>

    <div style="margin-top:2em; text-align: center">
        <div>
            DIRECTOR DEL PLANTEL
        </div>
        <div style="margin-top: 3em">
            M.V.Z. GABRIEL BLANCO AGUILAR
        </div>
    </div>


<footer>
    <p>Fecha de impresión: {{ date('d-m-Y') }}</p>
</footer>

</body>
</html>
