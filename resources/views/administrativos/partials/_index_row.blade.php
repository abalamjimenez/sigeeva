Mostrando {{collect($administrativos->items())->count()}} registros de un total de {{$administrativos->total()}}

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
        <td>Fecha de registro</td>
    </tr>
</thead>
<tbody>
    @foreach($administrativos as $administrativos)
        <tr>
            <td>
                <div class="dropdown position-static show">
                    <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('administrativos.edit', $administrativos->uuid)}}">Actualizar datos</a>
                    </div>
                </div>
            </td>
            <td>{{ $administrativos->curp }}</td>
            <td>{{ $administrativos->rfc }}</td>
            <td>{{ $administrativos->nombre_completo }}</td>
            <td>{{ $administrativos->fecha_nacimiento }}</td>
            <td>{{ $administrativos->telefono }}</td>
            <td>{{ $administrativos->email }}</td>
            <td>{{ $administrativos->num_seguridad_social }}</td>
            <td>{{ optional($administrativos->paises)->descripcion }}
            </td>
            <td>{{ optional($administrativos->entidades)->nombre }}</td>
            <td>{{ $administrativos->created_at }}</td>
        </tr>
    @endforeach
</tbody>
</table>
