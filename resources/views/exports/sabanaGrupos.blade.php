<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1">
<thead>
    <tr>
        <th colspan="3">{{ $grupo->clave }}</th>
        @foreach($arregloAsignaturas AS $asignatura)
            <th colspan="7">
                {{ $asignatura['descripcion'] }} <br >
                DOCENTE: {{ $asignatura['docente'] }}
            </th>
        @endforeach
    </tr>
    <tr>
        <th>No.</th>
        <th>Curp</th>
        <th>Nombre</th>
        @foreach($arregloAsignaturas AS $asignatura)
            <td align="center">U1</td>
            <td align="center">U2</td>
            <td align="center">U3</td>
            <td align="center">CF</td>
            <td align="center">E1</td>
            <td align="center">E2</td>
            <td align="center">EE</td>
        @endforeach
    </tr>
</thead>
<tbody>

@foreach ($arregloAlumnos AS $alumno)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <?php
            if (!empty($alumno["curp"]))
                echo $alumno["curp"];
            ?>

        </td>
        <td>
            <?php
            if (!empty($alumno['nombre_completo']))
                echo $alumno['nombre_completo']
            ?>
        </td>
        @foreach($arregloAsignaturas AS $asignatura)
            @if (!empty($alumno['asignaturas'][$asignatura['asignatura_id']]))
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['unidad1'] }}</td>
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['unidad2'] }}</td>
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['unidad3'] }}</td>
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['calificacion_final'] }}</td>
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['extraordinario1'] }}</td>
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['extraordinario2'] }}</td>
                <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['examen_especial'] }}</td>
            @else
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
            @endif
        @endforeach
    </tr>
@endforeach
</tbody>
</table>

@if (count($arregloAlumnosEnRepeticion)>0)

    <p>Alumnos en repetición</p>

    <table border="1">
    <tbody>
        @foreach ($arregloAlumnosEnRepeticion AS $alumno)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <?php
                    if (!empty($alumno["curp"]))
                        echo $alumno["curp"];
                    ?>

                </td>
                <td>
                    <?php
                    if (!empty($alumno['nombre_completo']))
                        echo $alumno['nombre_completo'];
                    ?>
                </td>
                @foreach($arregloAsignaturas AS $asignatura)
                    @if (!empty($alumno['asignaturas'][$asignatura['asignatura_id']]))
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['unidad1'] }}</td>
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['unidad2'] }}</td>
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['unidad3'] }}</td>
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['calificacion_final'] }}</td>
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['extraordinario1'] }}</td>
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['extraordinario2'] }}</td>
                        <td align="center">{{ $alumno['asignaturas'][$asignatura['asignatura_id']]['examen_especial'] }}</td>
                    @else
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

@endif

</body>
</html>
