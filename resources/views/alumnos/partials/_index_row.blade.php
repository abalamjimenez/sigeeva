Mostrando {{collect($registradas->items())->count()}} registros de un total de {{$registradas->total()}}

<table class="table table-condensed table-hover table-responsive">
<thead>
    <tr>
        <th>Acciones</th>
        <td>Curp</td>
        <td>Nombre</td>
        <td>Fecha de nacimiento</td>
        <td>Teléfono</td>
        <td>Correo</td>
        <td>Núm. Seguridad Social</td>

        <td>Pais de nacimiento</td>
        <td>Entidad de nacimiento</td>
        <td>Fecha de registro</td>
        <td>ID</td>
    </tr>
</thead>
<tbody>
    @foreach($registradas as $registrada)
        <tr>
            <td>
                <div class="dropdown position-static show">
                    <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('alumnos.historial', $registrada->uuid)}}">Historial</a>
                        <a class="dropdown-item" href="{{route('alumnos.edit', $registrada->uuid)}}">Actualizar datos</a>
                    </div>
                </div>
            </td>
            <td>{{ $registrada->curp }}</td>
            <td>{{ $registrada->nombre_completo }}</td>
            <td>{{ $registrada->fecha_nacimiento }}</td>
            <td>{{ $registrada->telefono }}</td>
            <td>{{ $registrada->email }}</td>
            <td>{{ $registrada->num_seguridad_social }}</td>
            <td>{{ optional($registrada->paises)->descripcion }}
            </td>
            <td>{{ optional($registrada->entidades)->nombre }}</td>
            <td>{{ $registrada->created_at }}</td>
            <td>{{ $registrada->id }}</td>
        </tr>
    @endforeach
</tbody>
</table>
