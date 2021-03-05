<table>
<thead>
    <tr>
        <th>#</th>
        <th>Cuenta validada</th>
        <th>Usuario</th>
        <th>Último acceso</th>
        <th>Nombre completo</th>
        <th>CURP</th>
        <th>Teléfono</th>
        <th>Correo electrónico</th>
        <th>Número de seguridad social</th>
        <th>Carrera</th>
        <th>Turno</th>
        <th>Semestre</th>
    </tr>
</thead>
<tbody>
    @foreach ($cuentasValidadas AS $cuenta)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cuenta->cuenta_validada }}</td>
            <td>{{ $cuenta->username }}</td>
            <td>{{ $cuenta->last_login_at }}</td>
            <td>{{ $cuenta->nombre_completo }}</td>
            <td>{{ $cuenta->curp }}</td>
            <td>{{ $cuenta->telefono }}</td>
            <td>{{ $cuenta->email }}</td>
            <td>{{ $cuenta->numero_seguridad_social }}</td>
            <td>{{ $cuenta->descripcion_carrera }}</td>
            <td>{{ $cuenta->descripcion_turno }}</td>
            <td>{{ $cuenta->semestre }}</td>
        </tr>
    @endforeach
</tbody>
</table>
