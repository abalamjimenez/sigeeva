Mostrando {{collect($solicitudes->items())->count()}} registros de un total de {{$solicitudes->total()}}

<table class="table table-condensed table-hover table-responsive">
<thead>
<tr>
    <th>Acciones</th>
    <td>Carrera</td>
    <td>Semestre</td>
    <td>Turno</td>
    <td>CURP</td>
    <td>NOMBRE</td>
    <td>Tipo Solicitud</td>
</tr>
</thead>
<tbody>
    @foreach($solicitudes as $registro)
        <tr>
            <td>
                <div class="dropdown position-static show">
                    <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('solicitudes.editar',$registro->uuid) }}">
                            Actualizar solicitud
                        </a>
                    </div>
                </div>
            </td>
            <td>{{ $registro->carrera_descripcion }}</td>
            <td>{{ $registro->grado_id }}</td>
            <td>{{ optional($registro->turno)->descripcion }}</td>
            <td>{{ $registro->curp }}</td>
            <td>
                <?php
                $nombre_completo = '';
                if (!empty($registro->primer_apellido))
                    $nombre_completo = $registro->primer_apellido;

                if (!empty($registro->segundo_apellido))
                    $nombre_completo =$nombre_completo.' '.$registro->segundo_apellido;

                if (!empty($registro->nombre))
                    $nombre_completo =$nombre_completo.' '.$registro->nombre;

                echo $nombre_completo;
                ?>
            </td>
            <td>{{ $registro->tipo_solicitud }}</td>
        </tr>
    @endforeach
</tbody>
</table>
