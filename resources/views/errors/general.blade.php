@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Error</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Error</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container">

        <div class="media">
            <img src="{{ asset("img/sadwindow.png") }}" class="align-self-start mr-3" alt="sadwindow">
            <div class="media-body">
                <h5 class="mt-0">{{ $titulo }}</h5>
                <p>
                    {!! $mensaje  !!}
                </p>

                <p>
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        Página principal
                    </a>
                </p>
            </div>
        </div>
    </div>

@endsection

@section('jscripts')
@endsection
