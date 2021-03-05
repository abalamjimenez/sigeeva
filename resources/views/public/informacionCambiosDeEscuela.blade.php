@extends('layouts.public')

@section('content')

    <div class="row">
        <div class="col-sm-12 mx-auto text-center">
            <img class="img-fluid" src="{{ asset("img/informacion-cambios-escuela.jfif") }}">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mx-auto text-center">
            <a href="{{ route('home') }}" style="cursor:pointer" class="btn btn-success">
                Regresar
            </a>
        </div>
    </div>

@endsection
