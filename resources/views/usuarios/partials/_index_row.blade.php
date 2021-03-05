Mostrando {{ collect($usuarios->items())->count() }} registros de un total de {{ $usuarios->total() }}

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
        <td>{{ $usuario->userable->tipo_registro }}</td>
        <td>{{ $usuario->username }}</td>
        <td>{{ $usuario->userable->nombre_completo }}</td>
        <td>{{ $usuario->userable->curp }}</td>
        <td>{{ $usuario->userable->rfc }}</td>
        <td>{{ $usuario->last_login_at }}</td>
        <td>{{ $usuario->active }}</td>
        <td>{{ $usuario->email }}</td>
        <td>{{ $usuario->userable->email }}</td>
    </tr>
@endforeach
</tbody>
</table>
