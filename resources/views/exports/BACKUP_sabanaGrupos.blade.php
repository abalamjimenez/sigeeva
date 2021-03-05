<!doctype html>
<html lang="en">
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

@foreach ($arregloCalificaciones AS $calificaciones)
    <?php
    $calificacion_expediente_id = '';
    if (!empty($calificaciones['expediente_id']))
        $calificacion_expediente_id = $calificaciones['expediente_id'];
    ?>

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $arregloAlumnos[$calificaciones['expediente_id']]['curp'] }}</td>
        <td>{{ $arregloAlumnos[$calificaciones['expediente_id']]['nombre_completo'] }}</td>

        @foreach($arregloAsignaturas AS $asignatura)
            <?php
            $asignatura_asignatura_id = '';
            if (!empty($asignatura['asignatura_id']))
                $asignatura_asignatura_id = $asignatura['asignatura_id'];
            ?>

            <td align="center">
                <?php
                if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['unidad1']))
                {
                    echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['unidad1'];
                }
                ?>
            </td>
            <td align="center">
                <?php
                if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['unidad2']))
                {
                    echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['unidad2'];
                }
                ?>
            </td>
            <td align="center">
                <?php
                if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['unidad3']))
                {
                    echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['unidad3'];
                }
                ?>
            </td>
            <td align="center">
                <?php
                if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['calificacion_final']))
                {
                    echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['calificacion_final'];
                }
                ?>
            </td>
            <td align="center">
                <?php
                if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['extraordinario1']))
                {
                    echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['extraordinario1'];
                }
                ?>
            </td>
            <td align="center">
                <?php
                if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['extraordinario2']))
                {
                    echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['extraordinario2'];
                }
                ?>
            </td>
                <td align="center">
                    <?php
                    if (!empty($arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['examen_especial']))
                    {
                        echo $arregloCalificaciones[$calificacion_expediente_id]['asignaturas'][$asignatura_asignatura_id]['examen_especial'];
                    }
                    ?>
                </td>
        @endforeach

    </tr>
@endforeach
</tbody>
</table>

</body>
</html>
