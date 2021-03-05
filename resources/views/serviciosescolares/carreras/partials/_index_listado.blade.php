Mostrando {{ $carreras->count() }} registros de un total de {{ $carreras->total() }}

<table class="table table-condensed table-hover table-responsive">
    <thead>
    <tr>
        <th>Acciones</th>
        <th>Clave Federal</th>
        <th>Abreviación</th>
        <th>Descripción</th>
        <th>Vigente</th>
        <td>Fecha de registro</td>
    </tr>
    </thead>
    <tbody>
    @foreach($carreras as $carrera)
        <tr>
            <td>
                <div class="dropdown position-static show">
                    <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('carreras.edit', $carrera->id)}}">Editar</a>
                        <a class="dropdown-item" href="{{route('carreras.confirmDelete', $carrera->id)}}">Eliminar</a>
                    </div>
                </div>
            </td>
            <td>{{ $carrera->clave_federal }}</td>
            <td>{{ $carrera->abreviacion }}</td>
            <td>{{ $carrera->descripcion }}</td>
            <td>{{ $carrera->vigente }}</td>
            <td>{{ $carrera->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
