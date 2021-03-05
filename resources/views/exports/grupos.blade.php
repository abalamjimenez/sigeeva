<h1 style="text-align: center">C.E.B.T. EVA SÁMANO DE LÓPEZ MATEOS</h1>
<h2 style="text-align: center">SEMESTRE: 2019-2020 "B"</h2>

<table>
    <tr>
        <th>CARRERA Y SEMESTRE</th>
        <td>
            <?php
            if (!empty($generales->carrera_descripcion))
                echo $generales->carrera_descripcion;

            if (!empty($generales->semestre))
                echo ' - '.$generales->semestre;
            ?>
        </td>
        <th>TURNO</th>
        <td>{{ $generales->turno_descripcion }}</td>
    </tr>
    <tr>
        <th>ASIGNATURA</th>
        <td colspan="3"></td>
    </tr>
    <tr>
        <th>DOCENTE</th>
        <td colspan="3"></td>
    </tr>
</table>

<table>
<thead>
<tr>
    <th>No.</th>
    <th style="width:50px">NOMBRE DEL ALUMNO</th>
    <th>Teléfono</th>
    <th>Correo</th>
    <th style="width:3px; text-align:center">L</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">J</th>
    <th style="width:3px; text-align:center">V</th>
    <th style="width:3px; text-align:center">L</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">J</th>
    <th style="width:3px; text-align:center">V</th>
    <th style="width:3px; text-align:center">L</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">J</th>
    <th style="width:3px; text-align:center">V</th>
    <th style="width:3px; text-align:center">L</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">J</th>
    <th style="width:3px; text-align:center">V</th>
    <th style="width:3px; text-align:center">L</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">M</th>
    <th style="width:3px; text-align:center">J</th>
    <th style="width:3px; text-align:center">V</th>
    <th style="writing-mode:vertical-lr; transform:rotate(180deg)">PARTICIPACIÓN</th>
    <th style="writing-mode:vertical-lr; transform:rotate(180deg)">TAREAS</th>
    <th style="writing-mode:vertical-lr; transform:rotate(180deg)">EXPOSICIÓN</th>
    <th style="writing-mode:vertical-lr; transform:rotate(180deg)">EXAMEN</th>
    <th style="writing-mode:vertical-lr; transform:rotate(180deg)">CALIFICACIÓN</th>
</tr>
</thead>
<tbody>
<?php
$filas=1;

if (!empty($arregloAlumnos['normales']))
{
    foreach ($arregloAlumnos['normales'] AS $datos)
    {
        ?>
        <tr>
            <td>{{ $filas }}</td>
            <td>{{ $datos['nombre_completo'] }}</td>
            <td>{{ $datos['telefono'] }}</td>
            <td>{{ $datos['email'] }}</td>
        </tr>
        <?php
        $filas++;
    }
}

if (!empty($arregloAlumnos['adicionales']))
{
    ?>
    <tr>
        <td>{{ $filas }}</td>
        <td></td>
    </tr>
    <?php
    $filas++;
    foreach ($arregloAlumnos['adicionales'] AS $datos)
    {
        ?>
        <tr>
            <td>{{ $filas }}</td>
            <td>
                <?php

                if (!empty($datos['materias']))
                {
                    $cadena_materias = '';
                    foreach ($datos['materias'] AS $key=>$materia)
                    {
                        if (empty($cadena_materias))
                            $cadena_materias = $materia['descripcion'];
                        else
                            $cadena_materias = ','.$materia['descripcion'];
                    }
                }

                echo $datos['nombre_completo'].'('.$cadena_materias.')';
                ?>
            </td>
            <td>{{ $datos['telefono'] }}</td>
            <td>{{ $datos['email'] }}</td>
        </tr>
        <?php
        $filas++;
    }
}
?>
</tbody>
</table>
