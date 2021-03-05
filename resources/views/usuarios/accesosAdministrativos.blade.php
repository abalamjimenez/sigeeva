@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3>Últimos accesos de Administrativos</h3>
            </div>
            <div class="card-body">
                <table class="table table-condensed table-hover table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre completo</th>
                        <th>Usuario</th>
                        <th>Último acceso</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ultimosAccesos AS $ultimoAcceso)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $ultimoAcceso->nombre_completo }}</td>
                            <td>{{ $ultimoAcceso->username }}</td>
                            <td>
                                {{ $ultimoAcceso->last_login_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('jscripts')
@endsection
