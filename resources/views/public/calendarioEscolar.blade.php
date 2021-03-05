@extends('layouts.public')

@section('content')
    <header style="margin-bottom: 2em">
        <div class="row">
            <div class="col-sm-12 mx-auto text-center">
                <img  src="{{ asset("img/eva-samano-logos.png") }}">
            </div>
        </div>
    </header>

    <div class="row">
        <div class="col-sm-12 mx-auto text-center">
            <img class="img-fluid" src="{{ asset("calendarioEscolar/calendario-escolar.png") }}">
        </div>
    </div>


    <div class="row" style="margin-top:1em; margin-bottom:1em">
        <div class="col-lg-6 mx-auto text-center">
            <a target="_blank" href="{{ asset("calendarioEscolar/calendario-escolar.pdf") }}" class="btn btn-primary">
                DESCARGAR CALENDARIO ESCOLAR
            </a>

            <a href="{{ route('home') }}" style="cursor:pointer" class="btn btn-success">
                Regresar
            </a>
        </div>
    </div>

@endsection
