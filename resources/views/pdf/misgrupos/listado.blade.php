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
    </style>
<body>
<header>
    <h1>C.E.B.T. EVA SÁMANO DE LÓPEZ MATEOS</h1>
    <h2>SEMESTRE: 2019-2020 "B"</h2>
</header>

<div id="content">

    <table border="1" width="100%" style="margin-bottom:1em">
        <tr>
            <th width="140px" align="left">ASIGNATURA:</th>
            <td colspan="3">
                {{ $asignaturaGrupo->asignatura->abreviacion.' - '.$asignaturaGrupo->asignatura->descripcion }}
            </td>
        </tr>
        <tr>
            <th align="left">CARRERA Y SEMESTRE:</th>
            <td>
                {{ $asignaturaGrupo->grupo->carrera->descripcion }} {{ $asignaturaGrupo->grupo->grado_id }}
            </td>
            <th align="left" width="100px">TURNO:</th>
            <td>{{ $asignaturaGrupo->grupo->turno->descripcion }}</td>
        </tr>
        <tr>
            <th align="left">DOCENTE:</th>
            <td>{{ $asignaturaGrupo->persona->nombre_completo }}</td>
            <th align="left">RESPONSABLE:</th>
            <td></td>
        </tr>
    </table>

    <table border="1" style="margin-bottom:2em">
        <thead>
        <tr>
            <th>#</th>
            <th>Alumno</th>
            <th>Unidad 1</th>
            <th>Unidad 2</th>
            <th>Unidad 3</th>
            <th>Promedio</th>
            <th>Calificación final</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expedientes AS $expediente)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $expediente->nombre_completo }}</td>
                <td align="center">{{ $expediente->unidad1 }}</td>
                <td align="center">{{ $expediente->unidad2 }}</td>
                <td align="center">{{ $expediente->unidad3 }}</td>
                <td align="center">{{ $expediente->promedio }}</td>
                <td align="center">{{ $expediente->calificacion_final }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="250px" align="center">FIRMA DEL DOCENTE</td>
            <td width="100px">&nbsp;</td>
            <td width="80px" align="center" class="border1">UNIDAD</td>
            <td width="45px" class="border1">&nbsp;</td>
            <td></td>
        </tr>
        <tr>
            <td height="2em" style="border-bottom:1px solid">&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>


<footer>
    <p>Fecha de impresión: {{ date('d-m-Y') }}</p>
</footer>

</body>
</html>
