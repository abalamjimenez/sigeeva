Mostrando {{collect($registros->items())->count()}} registros de un total de {{$registros->total()}}

<table class="table table-condensed table-hover table-responsive" width="100%">
<thead>
    <tr>
        <th>#</th>
        <th>Descripción</th>
        <th>Asignados</th>
    </tr>
</thead>
<tbody>
    @foreach($registros as $registro)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <a
                    href="#!"
                    id="btnMostrarOcultar{{ $registro->id }}"
                    class="cargarOcultar"
                    data-registro-id="{{ $registro->id }}"
                    style="cursor:pointer;display:none">
                    {{ $registro->descripcion }}
                </a>

                <a
                    href="#!"
                    id="btnCargar{{ $registro->id }}"
                    class="detalle"
                    data-registro-id="{{ $registro->id }}"
                    style="cursor:pointer">
                    {{ $registro->descripcion }}
                </a>
            </td>
            <td style="text-align:center">{{ $registro->total }}</td>
        </tr>
        <tr style="display: none" id="fila_{{ $registro->id }}">
            <td colspan="3" id="columna_{{ $registro->id }}">

                <h5>Personas asignadas</h5>

                <table class="table table-condensed table-hover table-responsive personasAsignadas">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nombre completo</th>
                        <th>Correo institucional</th>
                        <th>Correo personal</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                </table>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
