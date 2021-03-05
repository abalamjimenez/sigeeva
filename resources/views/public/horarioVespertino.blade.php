@extends('layouts.public')

@section('content')
    <header style="margin-bottom: 2em">
        <div class="row">
            <div class="col-sm-12 mx-auto text-center">
                <img  src="{{ asset("img/eva-samano-logos.png") }}">
            </div>
        </div>
    </header>

    <h1>Horarios del turno vespertino</h1>


    <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-header">
                    DEPORTES
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/DEPORTES2TV.pdf") }}">DEPORTES2TV</a>
                            <br>
                            Tutor: PROF. MANUEL ALEJANDRO CEBALLOS SANTOS
                            <br>
                            Correo electrónico: manuel.ceballos@evasamano.edu.mx
                            <br>
                            Teléfono: 9842085929
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-header">
                    INFORMÁTICA
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/INFORMATICA2TV.pdf?time=".date('Ymdhis')) }}">INFORMATICA2TV</a>
                            <br>
                            Tutor: PROF. JULIO SOSA GOMEZ
                            <br>
                            Correo electrónico: julio.sosa@evasamano.edu.mx
                            <br>
                            Teléfono: 9838388437
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/INFORMATICA4TV.pdf") }}">INFORMATICA4TV</a>
                            <br>
                            Tutor: PROFA. LIDIZE F. CALDERON MARIN
                            <br>
                            Correo electrónico: lidize.calderon@evasamano.edu.mx
                            <br>
                            Teléfono: 9838383223
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/INFORMATICA6TV.pdf") }}">INFORMATICA6TV</a>
                            <br>
                            Tutor: PROFA. MARIA DEL CARMEN DIAZ CRUZ
                            <br>
                            Correo electrónico: maria.diaz@evasamano.edu.mx
                            <br>
                            Teléfono: 9831540304
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-header">
                    RECREACIÓN
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/RECREACION2TV.pdf") }}">RECREACION2TV</a>
                            <br>
                            Tutor: PROFA. JULIA CAROLINA BRICEÑO VALDEZ
                            <br>
                            Correo electrónico: julia.briceño@evasamano.edu.mx
                            <br>
                            Teléfono: 9831207368
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/RECREACION4TV.pdf") }}">RECREACION4TV</a>
                            <br>
                            Tutor: PROF. MARIO EFRAIN CANTO DUARTE
                            <br>
                            Correo electrónico: mario.duarte@evasamano.edu.mx
                            <br>
                            Teléfono: 9831685625
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/RECREACION6TV.pdf") }}">RECREACION6TV</a>
                            <br>
                            Tutor: PROF. CARLOS EDUARDO PALMA TAMAY
                            <br>
                            Correo electrónico: carlos.palma@evasamano.edu.mx
                            <br>
                            Teléfono: 9831250121
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-header">
                    TURISMO
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/TURISMO2TV.pdf") }}">TURISMO2TV</a>
                            <br>
                            Tutor: PROFA. ADDA L. MEDINA PEREZ
                            <br>
                            Correo electrónico: adda.medina@evasamano.edu.mx
                            <br>
                            Teléfono: 9831209288
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tv/TURISMO4TV.pdf") }}">TURISMO4TV</a>
                            <br>
                            Tutor: PROFA. YANET M. GONZALEZ MORENO
                            <br>
                            Correo electrónico: yanet.gonzalez@evasamano.edu.mx
                            <br>
                            Teléfono: 9831546210
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mx-auto text-center">
            <a href="{{ route('home') }}" style="cursor:pointer" class="btn btn-success">
                Regresar
            </a>

            <a href="{{ route('public.horarioMatutino') }}" style="cursor:pointer;color:white;" class="btn btn-info">
                HORARIOS DEL TURNO MATUTINO
            </a>
        </div>
    </div>

@endsection
