<table class="table table-condensed table-hover table-responsive">
<thead>
<tr>
    <th></th>
    <th>Materia</th>
    <th>Grupo</th>
    <th>Carrera</th>
    <th>Semestre</th>
    <th>Turno</th>
</tr>
</thead>
<tbody>
    @foreach($gruposAsignados AS $grupo)
        <tr>
            <td>

                <div class="dropdown position-static show">
                    <a class="btn btn-primary" href="#" data-toggle="dropdown" data-boundary="window">
                        Acciones
                    </a>

                    <div class="dropdown-menu">

                        <a href="{{route('grupos.capturarCalificaciones', $grupo->asignatura_grupo_uuid)}}" class="dropdown-item">
                            Calificaciones
                        </a>

                        <a href="{{route('grupos.imprimirListado', $grupo->asignatura_grupo_id)}}" class="dropdown-item">
                            Generar PDF
                        </a>
                    </div>
                </div>



            </td>
            <td title="{{ $grupo->asignatura_descripcion }}">{{ $grupo->asignatura_abreviacion }}</td>
            <td>{{ $grupo->grupo_descripcion }}</td>
            <td>{{ $grupo->carrera_descripcion }}</td>
            <td>{{ $grupo->semestre }}</td>
            <td>{{ $grupo->turno_descripcion }}</td>
        </tr>
    @endforeach
</tbody>
</table>
