<table>
<thead>
    <tr>
        <th>#</th>
        <th>Tipo solicitud</th>
        <th>Estatus solicitud</th>
        <th>Grupo</th>
        <th>Carrera</th>
        <th>Semestre</th>
        <th>Turno</th>

        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>Nombre</th>
        <th>CURP</th>
        <th>Fecha nacimiento</th>
        <th>Sexo</th>
        <th>Correo electronico</th>
        <th>Telefono</th>
        <th>Tipo sangre</th>
        <th>Padeces alguna enfermedad?</th>
        <th>Dependencia de servicio médico?</th>
        <th>Tipo nacionalidad</th>
        <th>Nacionalidad</th>
        <th>Beca?</th>

        <th>Calle(Solicitante)</th>
        <th>Numero(Solicitante)</th>
        <th>Cruzamientos(Solicitante)</th>
        <th>CP(Solicitante)</th>
        <th>Colonia Localidad(Solicitante)</th>

        <th>Primer apellido(Tutor)</th>
        <th>Segundo apellido(Tutor)</th>
        <th>Nombre(Tutor)</th>
        <th>CURP (Tutor)</th>
        <th>Correo electrónico (Tutor)</th>
        <th>Teléfono (Tutor)</th>

        <th>Calle(Tutor)</th>
        <th>Numero(Tutor)</th>
        <th>Cruzamientos(Tutor)</th>
        <th>CP(Tutor)</th>
        <th>Colonia Localidad(Tutor)</th>

        <th>Centro de trabajo(Datos laborales)</th>
        <th>Ocupacion(Datos laborales)</th>
        <th>Telefono(Datos laborales)</th>
        <th>Extensión(Datos laborales)</th>

        <th>Calle(Datos laborales)</th>
        <th>Numero(Datos laborales)</th>
        <th>Cruzamientos(Datos laborales)</th>
        <th>CP(Datos laborales)</th>
        <th>Colonia Localidad(Datos laborales)</th>

    </tr>
</thead>
<tbody>
    @foreach ($solicitudes AS $solicitud)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $solicitud->tipo_solicitud }}</td>
            <td>{{ $solicitud->estatus_solicitud_descripcion }}</td>
            <td>{{ $solicitud->claveGrupo }}</td>
            <td>{{ $solicitud->carrera_descripcion }}</td>
            <td>{{ $solicitud->grado_id }}</td>
            <td>{{ $solicitud->turno_descripcion }}</td>

            <td>{{ $solicitud->primer_apellido }}</td>
            <td>{{ $solicitud->segundo_apellido }}</td>
            <td>{{ $solicitud->nombre }}</td>
            <td>{{ $solicitud->curp }}</td>
            <td>{{ $solicitud->fecha_nacimiento }}</td>
            <td>{{ $solicitud->sexo }}</td>
            <td>{{ $solicitud->email }}</td>
            <td>{{ $solicitud->telefono }}</td>
            <td>{{ $solicitud->tipo_sangre_descripcion }}</td>
            <td>{{ $solicitud->enfermedad }}</td>
            <td>{{ $solicitud->servicio_medico }}</td>
            <td>{{ $solicitud->nacionalidad_tipo }}</td>
            <td>{{ $solicitud->nacionalidad_descripcion }}</td>
            <td>{{ $solicitud->beca }}</td>

            <td>{{ $solicitud->domicilio_calle }}</td>
            <td>{{ $solicitud->domicilio_numero }}</td>
            <td>{{ $solicitud->domicilio_cruzamientos }}</td>
            <td>{{ $solicitud->domicilio_codigo_postal }}</td>
            <td>{{ $solicitud->domicilio_colonia }}</td>

            <td>{{ $solicitud->tutor_primer_apellido }}</td>
            <td>{{ $solicitud->tutor_segundo_apellido }}</td>
            <td>{{ $solicitud->tutor_nombre }}</td>
            <td>{{ $solicitud->tutor_curp }}</td>
            <td>{{ $solicitud->tutor_email }}</td>
            <td>{{ $solicitud->tutor_telefono }}</td>

            <td>{{ $solicitud->tutor_domicilio_calle }}</td>
            <td>{{ $solicitud->tutor_domicilio_numero }}</td>
            <td>{{ $solicitud->tutor_domicilio_cruzamientos }}</td>
            <td>{{ $solicitud->tutor_domicilio_codigo_postal }}</td>
            <td>{{ $solicitud->tutor_domicilio_colonia }}</td>

            <td>{{ $solicitud->ct }}</td>
            <td>{{ $solicitud->ct_ocupacion }}</td>
            <td>{{ $solicitud->ct_telefono }}</td>
            <td>{{ $solicitud->ct_telefono_extension }}</td>

            <td>{{ $solicitud->ct_domicilio_calle }}</td>
            <td>{{ $solicitud->ct_domicilio_numero }}</td>
            <td>{{ $solicitud->ct_domicilio_cruzamientos }}</td>
            <td>{{ $solicitud->ct_domicilio_codigo_postal }}</td>
            <td>{{ $solicitud->ct_domicilio_colonia }}</td>
        </tr>
    @endforeach
</tbody>
</table>
