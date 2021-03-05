@extends('layouts.public')

@section('content')
    <header style="margin-bottom: 2em">
        <div class="row">
            <div class="col-sm-12 mx-auto text-center">
                <img  src="{{ asset("img/eva-samano-logos.png") }}">
            </div>
        </div>
    </header>

    <h1>Lista preliminar <small>SEMESTRE A 2020-2021</small></h1>

    <p style="text-align:center">
    <object height="400px" width="100%" data="{{ asset("pdf/listaadmisionsemestrea20202021.pdf") }}" type="application/pdf">
        <embed src="{{ asset("pdf/listaadmisionsemestrea20202021.pdf") }}" type="application/pdf" />
    </object>
    </p>

    <div class="row">
        <div class="col-lg-6 mx-auto text-center">

            <a target="_blank" href="{{ asset("pdf/listaadmisionsemestrea20202021.pdf") }}" class="btn btn-primary">
                DESCARGAR LISTA DE ADMISIÓN
            </a>

            <a href="{{ route('home') }}" style="cursor:pointer" class="btn btn-success">
                Regresar
            </a>
        </div>
    </div>

@endsection
