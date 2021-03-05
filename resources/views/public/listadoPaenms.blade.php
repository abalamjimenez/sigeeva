@extends('layouts.public')

@section('content')

    <table class="table table-striped">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Nombre completo</th>
            <th>Nombre</th>
            <th>Primer apellido</th>
            <th>Segundo apellido</th>
        </tr>
    </thead>
    <tbody>
    @foreach($paenms AS $registro)
        <tr>
            <td>{{ $registro->folio }}</td>
            <td>{{ $registro->nombre_completo }}</td>
            <td>{{ $registro->nombre }}</td>
            <td>{{ $registro->primer_apellido }}</td>
            <td>{{ $registro->segundo_apellido }}</td>
        </tr>
    @endforeach
    </tbody>
    </table>


@endsection
