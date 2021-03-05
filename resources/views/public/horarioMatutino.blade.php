@extends('layouts.public')

@section('content')
    <header style="margin-bottom: 2em">
        <div class="row">
            <div class="col-sm-12 mx-auto text-center">
                <img  src="{{ asset("img/eva-samano-logos.png") }}">
            </div>
        </div>
    </header>

    <h1>Horarios del turno matutino</h1>


    <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-header">
                    DEPORTES
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/DEPORTES2ATM.pdf") }}">DEPORTES2ATM</a>
                            <br>
                            Tutor: PROF. CASTULO JIMENEZ RODRIGUEZ
                            <br>
                            Correo electrónico: ariel.jimenez@evasamano.edu.mx
                            <br>
                            Teléfono: 98315559149
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/DEPORTES2BTM.pdf") }}">DEPORTES2BTM</a>
                            <br>
                            Tutor: PROFA. LUCY GABRIELA AVILA GONZALEZ
                            <br>
                            Correo electrónico: lucy.avila@evasamano.edu.mx
                            <br>
                            Teléfono: 9831225361
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/DEPORTES4TM.pdf") }}">DEPORTES4TM</a>
                            <br>
                            Tutor: PROFA. GIULIANIN HOIL ALONSO
                            <br>
                            Correo electrónico: giuliani.hoil@evasamano.edu.mx
                            <br>
                            Teléfono: 9838671072
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/DEPORTES6TM.pdf") }}">DEPORTES6TM</a>
                            <br>
                            Tutor: PROF. RODOLFO OCAMPO RUIZ
                            <br>
                            Correo electrónico: rodolfo.ocampo@evasamano.edu.mx
                            <br>
                            Teléfono: 9838391400
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-header">
                    INFORMATICA
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/INFORMATICA2ATM.pdf") }}">INFORMATICA2ATM</a>
                            <br>
                            Tutor: PROFA. LIGIA BEATRIZ TORRES ABAN
                            <br>
                            Correo electrónico: ligia.torres@evasamano.edu.mx
                            <br>
                            Teléfono: 9831765425
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/INFORMATICA2BTM.pdf") }}">INFORMATICA2BTM</a>
                            <br>
                            Tutor: PROFA. NAYLA REGINA CAHUICH POOT
                            <br>
                            Correo electrónico: nayla.cahuich@evasamano.edu.mx
                            <br>
                            Teléfono: 9831647092
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/INFORMATICA4TM.pdf") }}">INFORMATICA4TM</a>
                            <br>
                            Tutor: PROF. JOSE MANUEL GONZALEZ FERNANDEZ
                            <br>
                            Correo electrónico: josemanuelgonzalez@evasamano.edu.mx
                            <br>
                            Teléfono: 9831832761
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/INFORMATICA6TM.pdf") }}">INFORMATICA6TM</a>
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
                    MERCADOTECNIA
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/MERCADOTECNIA4TM.pdf") }}">MERCADOTECNIA4TM</a>
                            <br>
                            Tutor: PROFA. FATIMA YERVES PERAZA
                            <br>
                            Correo electrónico: fatima.yerves@evasamano.edu.mx
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/MERCADOTECNIA6TM.pdf") }}">MERCADOTECNIA6TM</a>
                            <br>
                            Tutor: PROFA. LAURA ESTHER AREVALO FLORES
                            <br>
                            Correo electrónico: laura.arevalo@evasamano.edu.mx
                            <br>
                            Teléfono: 9831206186
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
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/RECREACION2ATM.pdf") }}">RECREACION2ATM</a>
                            <br>
                            Tutor: PROFA. JENIFFER PAOLA MORELOS ACEVEDO
                            <br>
                            Correo electrónico: jeniffer.morelos@evasamano.edu.mx
                            <br>
                            Teléfono: 9831842964
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/RECREACION2BTM.pdf") }}">RECREACION2BTM</a>
                            <br>
                            Tutor: PROF. JOSE EDUARDO CAMARA ESPINOSA
                            <br>
                            Correo electrónico: eduardo.camara@evasamano.edu.mx
                            <br>
                            Teléfono: 9831303605
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/RECREACION4TM.pdf") }}">RECREACION4TM</a>
                            <br>
                            Tutor: PROF. MARCO A. ROSETTI CASTILLO
                            <br>
                            Correo electrónico: marco.rosseti@evasamano.edu.mx
                            <br>
                            Teléfono: 9831138301
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/RECREACION6TM.pdf") }}">RECREACION6TM</a>
                            <br>
                            Tutor: PROF. MARIO H. GONGORA VAZQUEZ
                            <br>
                            Correo electrónico: mario.gongora@evasamano.edu.mx
                            <br>
                            Teléfono: 9831837243
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
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/TURISMO2TM.pdf") }}">TURISMO2TM</a>
                            <br>
                            Tutor: PROFA. ADDA L. MEDINA PEREZ
                            <br>
                            Correo electrónico: adda.medina@evasamano.edu.mx
                            <br>
                            Teléfono: 9831209288
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/TURISMO4TM.pdf") }}">TURISMO4TM</a>
                            <br>
                            Tutor: PROF. JOSE ENRIQUE ALBORNOZ CASTILLO
                            <br>
                            Correo electrónico: jose.albornoz@evasamano.edu.mx
                            <br>
                            Teléfono: 9831231005
                        </li>
                        <li class="list-group-item">
                            <a target="_blank" href="{{ asset("horarios/periodo4/tm/TURISMO6TM.pdf?time=".date('YmdHis')) }}">TURISMO6TM</a>
                            <br>
                            Tutor: PROF. ERIKC F. PERCASTRE CANUL
                            <br>
                            Correo electrónico: erikc.percastre@evasamano.edu.mx
                            <br>
                            Teléfono: 9831232979
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

            <a href="{{ route('public.horarioVespertino') }}" style="cursor:pointer;color:white;" class="btn btn-info">
                HORARIOS DEL TURNO VESPERTINO
            </a>
        </div>
    </div>

@endsection
