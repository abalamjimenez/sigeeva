<h3>Pase de lista Corte {{ date('d/m/Y H:i:s') }} Turno Matutino</h3>

<?php
if (!empty($cuentas['turnoMatutino']))
{
    ?>
    <table border="1">
        <thead>
        <tr>
            <th align="center">No</th>
            <th align="center">Tutor</th>
            <th align="center">Carrera</th>
            <th align="center">Semestre</th>
            <th align="center">Total de alumnos</th>
            <th align="center">% Validados</th>
            <th align="center">Validados</th>
            <th align="center">No validados</th>
            <th align="center">Motivos</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $contador           = 1;
        $alumnosValidados   = 0;
        $alumnosNoValidados = 0;
        ?>
        @foreach($cuentas['turnoMatutino'] AS $cuenta)
            <?php
            $totalAlumnos = 0;
            if (!empty($cuenta['alumnos_validados']))
            {
                $totalAlumnos     = $totalAlumnos + count($cuenta['alumnos_validados']);
                $alumnosValidados = $alumnosValidados + count($cuenta['alumnos_validados']);
            }

            if (!empty($cuenta['alumnos_no_validados']))
            {
                $totalAlumnos = $totalAlumnos + count($cuenta['alumnos_no_validados']);
                $alumnosNoValidados = $alumnosNoValidados + count($cuenta['alumnos_no_validados']);
            }

            $rowspan = 1;
            if (!empty($cuenta['alumnos_no_validados']) AND count($cuenta['alumnos_no_validados'])>1 )
                $rowspan=count($cuenta['alumnos_no_validados']);

            $porcentajeValidados = (count($cuenta['alumnos_validados'])*100) / $totalAlumnos;
            $porcentajeValidados = round($porcentajeValidados,0);
            ?>
            <tr>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $contador }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $cuenta['nombre_tutor'] }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $cuenta['grupo_clave'] }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $cuenta['semestre'] }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $totalAlumnos }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $porcentajeValidados }} %</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ count($cuenta['alumnos_validados']) }}</td>
                @if (!empty($cuenta['alumnos_no_validados']) AND count($cuenta['alumnos_no_validados'])>0 )
                    @foreach($cuenta['alumnos_no_validados'] AS $alumno)
                        <td>{{ $alumno['nombre_completo'] }}</td>
                        <td></td>
                        @break
                    @endforeach
                @else
                    <td></td>
                    <td></td>
                @endif
            </tr>

            @if (!empty($cuenta['alumnos_no_validados']) AND count($cuenta['alumnos_no_validados'])>1 )
                @foreach($cuenta['alumnos_no_validados'] AS $alumno)
                    @if ($loop->iteration != 1)
                        <tr>
                            <td>{{ $alumno['nombre_completo'] }}</td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
            @endif

            <?php
            $contador++;
            ?>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" style="text-align: right">S U M A S</td>
            <td align="center">{{ $alumnosValidados+$alumnosNoValidados }}</td>
            <td align="center">
                <?php
                $porcentaje = $alumnosValidados * 100;
                $porcentaje = $porcentaje / ($alumnosValidados+$alumnosNoValidados);
                $porcentaje = round($porcentaje,0);
                echo $porcentaje.' %';
                ?>
            </td>
            <td align="center">{{ $alumnosValidados }}</td>
            <td align="center">{{ $alumnosNoValidados }}</td>
            <td></td>
        </tr>
        </tfoot>
    </table>
    <?php
}
?>

<h3>Pase de lista Corte {{ date('d/m/Y H:i:s') }} Turno Vespertino</h3>

<?php
if (!empty($cuentas['turnoVespertino']))
{
    ?>
    <table>
        <thead>
        <tr>
            <th align="center">No</th>
            <th align="center">Tutor</th>
            <th align="center">Carrera</th>
            <th align="center">Semestre</th>
            <th align="center">Total de alumnos</th>
            <th align="center">% Validados</th>
            <th align="center">Validados</th>
            <th align="center">No validados</th>
            <th align="center">Motivos</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $alumnosValidados   = 0;
        $alumnosNoValidados = 0;
        ?>
        @foreach($cuentas['turnoVespertino'] AS $cuenta)
            <?php
            $totalAlumnos = 0;
            if (!empty($cuenta['alumnos_validados']))
            {
                $totalAlumnos    = $totalAlumnos + count($cuenta['alumnos_validados']);
                $alumnosValidados = $alumnosValidados + count($cuenta['alumnos_validados']);
            }

            if (!empty($cuenta['alumnos_no_validados']))
            {
                $totalAlumnos       = $totalAlumnos + count($cuenta['alumnos_no_validados']);
                $alumnosNoValidados = $alumnosNoValidados + count($cuenta['alumnos_no_validados']);
            }

            $rowspan = 1;
            if (!empty($cuenta['alumnos_no_validados']) AND count($cuenta['alumnos_no_validados'])>1 )
                $rowspan=count($cuenta['alumnos_no_validados']);

            $porcentajeValidados = (count($cuenta['alumnos_validados'])*100) / $totalAlumnos;
            $porcentajeValidados = round($porcentajeValidados,0);

            ?>
            <tr>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $contador }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $cuenta['nombre_tutor'] }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $cuenta['grupo_clave'] }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $cuenta['semestre'] }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $totalAlumnos }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ $porcentajeValidados }}</td>
                <td align="center" valign="center" rowspan="{{ $rowspan }}">{{ count($cuenta['alumnos_validados']) }}</td>
                @if (!empty($cuenta['alumnos_no_validados']) AND count($cuenta['alumnos_no_validados'])>0 )
                    @foreach($cuenta['alumnos_no_validados'] AS $alumno)
                        <td>{{ $alumno['nombre_completo'] }}</td>
                        <td></td>
                        @break
                    @endforeach
                @else
                    <td></td>
                    <td></td>
                @endif
            </tr>

            @if (!empty($cuenta['alumnos_no_validados']) AND count($cuenta['alumnos_no_validados'])>1 )
                @foreach($cuenta['alumnos_no_validados'] AS $alumno)
                    @if ($loop->iteration != 1)
                        <tr>
                            <td>{{ $alumno['nombre_completo'] }}</td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
            @endif

            <?php
            $contador++;
            ?>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right">S U M A S</td>
                <td align="center">{{ $alumnosValidados+$alumnosNoValidados }}</td>
                <td align="center">
                    <?php
                    $porcentaje = $alumnosValidados * 100;
                    $porcentaje = $porcentaje / ($alumnosValidados+$alumnosNoValidados);
                    $porcentaje = round($porcentaje,0);
                    echo $porcentaje.' %';
                    ?>
                </td>
                <td align="center">{{ $alumnosValidados }}</td>
                <td align="center">{{ $alumnosNoValidados }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <?php
}
?>
