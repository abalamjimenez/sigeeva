<table>
<thead>
<tr>
    <th>AlumnoActivo</th>
    <th>Carrera</th>
    <th>Turno</th>
    <th>Semestre</th>
    <th>GRUPO</th>
    <th>Usuario SIGEEVA</th>
    <th>CURP</th>
    <th>Sexo</th>
    <th>Primer apellido</th>
    <th>Segundo apellido</th>
    <th>Nombre</th>
    <th>Fecha nacimiento</th>
    <th>Correo institucional</th>
    <th>Correo personal</th>
    <th>Teléfono</th>
    <th>Número seguridad social</th>

    <th>CURP (Tutor)</th>
    <th>Apellido paterno (Tutor)</th>
    <th>Apellido materno (Tutor)</th>
    <th>Nombre (Tutor)</th>
    <th>Teléfono (Tutor)</th>
    <th>Email (Tutor)</th>
    <th>Centro trabajo (Tutor)</th>
    <th>Ocupación (Tutor)</th>

    <th>Calle (domicilio tutor)</th>
    <th>Núm. (domicilio tutor)</th>
    <th>Colonia (domicilio tutor)</th>
    <th>Código postal (domicilio tutor)</th>

    <th>Calle (domicilio centro trabajo)</th>
    <th>Núm. (domicilio centro trabajo)</th>
    <th>Colonia (domicilio centro trabajo)</th>
    <th>Código postal (domicilio centro trabajo)</th>
</tr>
</thead>
<tbody>
@foreach ($expedientes AS $expediente)
    <tr>
        <td>{{ $expediente->vigente }}</td>
        <td>{{ $expediente->descripcion_carrera }}</td>
        <td>{{ $expediente->descripcion_turno }}</td>
        <td>{{ $expediente->semestre }}</td>
        <td>{{ $expediente->clave_grupo }}</td>
        <td>{{ $expediente->usuario_sigeeva }}</td>
        <td>{{ $expediente->curp }}</td>
        <td>{{ $expediente->sexo }}</td>
        <td>{{ $expediente->primer_apellido }}</td>
        <td>{{ $expediente->segundo_apellido }}</td>
        <td>{{ $expediente->nombre }}</td>
        <td>{{ $expediente->fecha_nacimiento }}</td>
        <td>{{ $expediente->correo_institucional }}</td>
        <td>{{ $expediente->correo_personal }}</td>
        <td>{{ $expediente->telefono }}</td>
        <td>{{ $expediente->numero_seguridad_social }}</td>

        <td>{{ $expediente->tutor_curp }}</td>
        <td>{{ $expediente->tutor_primer_apellido }}</td>
        <td>{{ $expediente->tutor_segundo_apellido }}</td>
        <td>{{ $expediente->tutor_nombre }}</td>
        <td>{{ $expediente->tutor_telefono }}</td>
        <td>{{ $expediente->tutor_email }}</td>
        <td>{{ $expediente->tutor_centro_trabajo }}</td>
        <td>{{ $expediente->tutor_ocupacion }}</td>

        <td>{{ $expediente->ct_domicilio_calle }}</td>
        <td>{{ $expediente->ct_domicilio_numero_exterior }}</td>
        <td>{{ $expediente->ct_domicilio_colonia }}</td>
        <td>{{ $expediente->ct_domicilio_codigo_postal }}</td>


    </tr>
@endforeach
</tbody>
</table>
