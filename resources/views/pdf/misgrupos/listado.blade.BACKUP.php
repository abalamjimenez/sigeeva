<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap4.css') }}" rel="stylesheet">
    <title>PDF</title>
</head>
<body>

<h1>
    C.E.B.T. EVA SÁMANO DE LOPEZ MATEOS
</h1>

<table class="table table-condensed table table-striped">
<thead>
    <tr>
        <th>#</th>
        <th>Alumno</th>
        <th>Unidad 1</th>
        <th>Unidad 2</th>
    </tr>
</thead>
<tbody>
    @foreach($expedientes AS $expediente)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $expediente->nombre_completo }}</td>
            <td align="center">{{ $expediente->unidad1 }}</td>
            <td align="center">{{ $expediente->unidad2 }}</td>
        </tr>
    @endforeach
</tbody>
</table>


</body>
</html>
