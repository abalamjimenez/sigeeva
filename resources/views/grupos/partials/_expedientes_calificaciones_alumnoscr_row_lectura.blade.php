<table class="table table-condensed table-hover table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>Alumno</th>
        <th>Unidad1</th>
        <th>Unidad2</th>
        <th>Unidad3</th>
        <th>Promedio</th>
        <th>Final</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alumnosCr AS $expediente)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $expediente->nombre_completo }}</td>
            <td>{{ $expediente->unidad1 }}</td>
            <td>{{ $expediente->unidad2 }}</td>
            <td>{{ $expediente->unidad3 }}</td>
            <td>{{ $expediente->promedio }}</td>
            <td>{{ $expediente->calificacion_final }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
