<table>
<thead>
<tr>
    <th>Expediente</th>
    <th>Primer apellido alumno</th>
    <th>Segundo apellido alumno</th>
    <th>Nombre alumno</th>
    <th>tipo inscripción</th>
    <th>Es Repetición</th>
    <th>Carrera</th>
    <th>Turno</th>
    <th>Semestre</th>
    <th>Grupo</th>
    <th>Asignatura</th>
    <th>Primer apellido docente</th>
    <th>Segundo apellido docente</th>
    <th>Nombre docente</th>
    <th>Unidad 1</th>
    <th>Unidad 2</th>
    <th>Unidad 3</th>
    <th>Promedio</th>
    <th>Calificacion final</th>
    <th>Extraordinario1</th>
    <th>Extraordinario2</th>
    <th>Exámen especial</th>
</tr>
</thead>
<tbody>
@foreach ($expedientes AS $expediente)
    <tr>
        <td>{{ $expediente->expediente_id }}</td>
        <td>{{ $expediente->ap_paterno_alumno }}</td>
        <td>{{ $expediente->ap_materno_alumno }}</td>
        <td>{{ $expediente->nombre_alumno }}</td>
        <td>{{ $expediente->tipo_inscripcion }}</td>
        <td>{{ $expediente->es_repeticion }}</td>
        <td>{{ $expediente->descripcion_carrera }}</td>
        <td>{{ $expediente->descripcion_turno }}</td>
        <td>{{ $expediente->semestre }}</td>
        <td>{{ $expediente->clave }}</td>
        <td>{{ $expediente->descripcion_asignatura }}</td>
        <td>{{ $expediente->ap_paterno_docente }}</td>
        <td>{{ $expediente->ap_materno_docente }}</td>
        <td>{{ $expediente->nombre_docente }}</td>
        <td>{{ $expediente->unidad1 }}</td>
        <td>{{ $expediente->unidad2 }}</td>
        <td>{{ $expediente->unidad3 }}</td>
        <td>{{ $expediente->promedio }}</td>
        <td>{{ $expediente->calificacion_final }}</td>
        <td>{{ $expediente->extraordinario1 }}</td>
        <td>{{ $expediente->extraordinario2 }}</td>
        <td>{{ $expediente->examen_especial }}</td>
    </tr>
@endforeach
</tbody>
</table>
