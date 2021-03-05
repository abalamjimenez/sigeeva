Mostrando {{collect($docentes->items())->count()}} registros de un total de {{$docentes->total()}}

<table class="table table-condensed table-hover table-responsive">
<thead>
    <tr>
        <th>Acciones</th>
        <td>Curp</td>
        <td>RFC</td>
        <td>Nombre</td>
        <td>Fecha de nacimiento</td>
        <td>Teléfono</td>
        <td>Correo</td>
        <td>Núm. Seguridad Social</td>

        <td>Pais de nacimiento</td>
        <td>Entidad de nacimiento</td>
        <td>ID</td>
        <td>Fecha de registro</td>
    </tr>
</thead>
<tbody>
    @foreach($docentes as $docente)
        <tr>
            <td>
                <div class="dropdown position-static show">
                    <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('docentes.edit', $docente->uuid)}}">Actualizar datos</a>
                    </div>
                </div>
            </td>
            <td>{{ $docente->curp }}</td>
            <td>{{ $docente->rfc }}</td>
            <td>{{ $docente->nombre_completo }}</td>
            <td>{{ $docente->fecha_nacimiento }}</td>
            <td>{{ $docente->telefono }}</td>
            <td>{{ $docente->email }}</td>
            <td>{{ $docente->num_seguridad_social }}</td>
            <td>{{ optional($docente->paises)->descripcion }}
            </td>
            <td>{{ optional($docente->entidades)->nombre }}</td>
            <td>{{ $docente->id }}</td>
            <td>{{ $docente->created_at }}</td>
        </tr>
    @endforeach
</tbody>
</table>
