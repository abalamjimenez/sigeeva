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
        }
        @page {
            margin: 160px 50px;
        }
        header { position: fixed;
            left: 0px;
            top: -140px;
            right: 0px;
            height: 100px;
            text-align: center;
        }
        header h1{
            margin: 10px 0;
            font-size:1em;
        }
        header h2{
            margin: 0 0 10px 0;
            font-size:.8em;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -100px;
            right: 0px;
            height: 80px;
        }
        footer .page:after {
            content: counter(page);
        }
        footer table {
            width: 100%;
        }
        footer p {
            text-align: right;
        }
        footer .izq {
            text-align: left;
        }
        .border1 {
            border:1px solid;
        }
        .tabla_encabezado {
            font-size:.5em;
        }


    </style>
<body>
<header>
    <h1>C.E.B.T. EVA SÁMANO DE LÓPEZ MATEOS</h1>
    <h2>SEMESTRE: 2019-2020 "B"</h2>
</header>
<footer>
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
</footer>
<div id="content">

    <table>
    <tr>
        <th>ASIGNATURA:</th>
        <td></td>
        <th></th>
        <td></td>
    </tr>
    <tr>
        <th>CARRERA Y SEMESTRE:</th>
        <td></td>
        <th>TURNO:</th>
        <td></td>
    </tr>
    <tr>
        <th>DOCENTE:</th>
        <td></td>
        <th>RESPONSABLE:</th>
        <td></td>
    </tr>
    </table>

    <table border="1" class="table">
    <tr class="tabla_encabezado">
        <th>No.</th>
        <th width="200px">NOMBRE DEL ALUMNO</th>
        <th>L</th>
        <th>M</th>
        <th>M</th>
        <th>J</th>
        <th>V</th>
        <th>L</th>
        <th>M</th>
        <th>M</th>
        <th>J</th>
        <th>V</th>
        <th>L</th>
        <th>M</th>
        <th>M</th>
        <th>J</th>
        <th>V</th>
        <th>L</th>
        <th>M</th>
        <th>M</th>
        <th>J</th>
        <th>V</th>
        <th>L</th>
        <th>M</th>
        <th>M</th>
        <th>J</th>
        <th>V</th>
        <th style="writing-mode: vertical-lr;transform: rotate(270deg);">PARTICIPACIÓN</th>
        <th style="writing-mode: vertical-lr;transform: rotate(270deg);">TAREAS</th>
        <th style="writing-mode: vertical-lr;transform: rotate(270deg);">EXPOSICIÓN</th>
        <th style="writing-mode: vertical-lr;transform: rotate(270deg);">EXAMEN</th>
        <th style="writing-mode: vertical-lr;transform: rotate(270deg);">CALIFICACIÓN</th>
    </tr>
    </table>
    @foreach ($expedientes AS $expediente)
    @endforeach

</div>
</body>
</html>
