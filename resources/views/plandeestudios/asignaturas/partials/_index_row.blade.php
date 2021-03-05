Mostrando {{collect($registros->items())->count()}} registros de un total de {{$registros->total()}}

<table class="table table-condensed table-hover table-responsive">
<thead>
    <tr>
        <th>Acciones</th>
        <td>Abreviación</td>
        <td>Descripción</td>
        <td>Vigente</td>
        <td>ID</td>
        <td>Creación</td>
        <td>Última actualización</td>
    </tr>
</thead>
<tbody>
    @foreach($registros as $registro)
        <tr>
            <td>
                <div class="dropdown position-static show">
                    <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('plandeestudios.asignaturas.edit', $registro->id)}}">Actualizar datos</a>
                    </div>
                </div>
            </td>
            <td>{{ $registro->abreviacion }}</td>
            <td>{{ $registro->descripcion }}</td>
            <td>{{ $registro->vigente }}</td>
            <td>{{ $registro->id }}</td>
            <td>{{ $registro->created_at}}</td>
            <td>{{ $registro->updated_at}}</td>
        </tr>
    @endforeach
</tbody>
</table>
