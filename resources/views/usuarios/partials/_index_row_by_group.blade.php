

<table class="table table-condensed table-hover table-responsive">
<thead>
<tr>
    <th>Acciones</th>
    <td>Tipo</td>
    <td>Usuario</td>
    <td>Nombre</td>
    <td>CURP</td>
    <td>RFC</td>
    <td>Última conexión</td>
    <td>Activo</td>
    <td>Correo institucional</td>
    <td>Correo institucional validado</td>
    <td>Correo personal</td>
</tr>
</thead>
<tbody>
@foreach($usuarios as $usuario)
    <tr>
        <td>

            <div class="dropdown position-static show">
                <a class="btn btn-secondary" href="#" data-toggle="dropdown" data-boundary="window">
                    Acciones
                </a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('usuarios.cambiarClaveAcceso',$usuario->uuid) }}">
                        Contraseña
                    </a>
                    <a class="dropdown-item" href="{{ route('usuarios.editarAccesos',$usuario->uuid) }}">
                        Accesos
                    </a>
                    <a class="dropdown-item" href="{{ route('usuarios.editarDatos',$usuario->uuid) }}">
                        Datos
                    </a>
                </div>
            </div>

        </td>
        <td>{{ $usuario->tipo_registro }}</td>
        <td>{{ $usuario->username }}</td>
        <td>{{ $usuario->nombre_completo }}</td>
        <td>{{ $usuario->curp }}</td>
        <td>{{ $usuario->rfc }}</td>
        <td>{{ $usuario->last_login_at }}</td>
        <td>{{ $usuario->active }}</td>
        <td>{{ $usuario->correo_institucional }}</td>
        <td>{{ $usuario->correo_institucional_validado }}</td>
        <td>{{ $usuario->correo_personal }}</td>
    </tr>
@endforeach
</tbody>
</table>
