<h1 style="text-align: center">C.E.B.T. EVA SÁMANO DE LÓPEZ MATEOS</h1>
<h2 style="text-align: center">SEMESTRE: 2019-2020 "B"</h2>
<h2>GRUPO: {{ $grupo->clave }}</h2>

<table>
<thead>
    <tr>
        <th>#</th>
        <th>Primer apellido</th>
        <th>Segundo apellido</th>
        <th>Nombre</th>
        <th>CURP</th>
        <th>Usuario SIGEEVA</th>
        <th>TELEFONO DE CONTACTO</th>
        <th>CORREO PERSONAL</th>
        <th>CORREO INSTITUCIONAL</th>
    </tr>
</thead>
<tbody>
@foreach($expedientes AS $expediente)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $expediente->primer_apellido }}</td>
        <td>{{ $expediente->segundo_apellido }}</td>
        <td>{{ $expediente->nombre }}</td>
        <td>{{ $expediente->curp }}</td>
        <td>{{ $expediente->USUARIO_SIGEEVA }}</td>
        <td>{{ $expediente->TELEFONO_CONTACTO }}</td>
        <td>{{ $expediente->CORREO_PERSONAL }}</td>
        <td>{{ $expediente->CORREO_INSTITUCIONAL }}</td>
    </tr>
@endforeach
</tbody>
</table>
