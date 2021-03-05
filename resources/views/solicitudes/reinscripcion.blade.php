@extends('layouts.privado')

@section('page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    Cedula de Reinscripción
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Preinscripción</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::get('msgExito'))
                    <div class="alert alert-success">
                        {{ Session::get('msgExito') }}
                    </div>
                @endif
            </div>
        </div>

        {!! Form::open(['route'=>'solicitudes.storeReinscripcion','method'=>'post','id'=>'form']) !!}

        <div class="row">
            <div class="col">
                <p>
                    La información capturada es responsabilidad del alumno y/o padre de familia o tutor, se deberán
                    llenar todos los datos. La escuela hará uso de la información capturada para trámites como la
                    beca benito juárez entre otros.
                </p>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATOS ACADÉMICOS DEL SOLICITANTE</h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials._solicitud_academicos')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    DATOS GENERALES DEL SOLICITANTE<br>
                    <small>
                        <em>
                        Si detectas alguna inconsistencia en tus datos personales,
                        envía copia de tu curp y copia de tu acta de nacimiento
                            al correo servicios.escolares@evasamano.edu.mx
                        </em>
                    </small>
                </h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials._solicitud_generales')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATOS DEL PADRE O TUTOR</h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials._solicitud_datos_tutor')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">DATOS LABORALES DEL PADRE O TUTOR</h3>
            </div>
            <div class="card-body">
                @include('solicitudes.partials._solicitud_centro_trabajo')
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-body">
                @if($imprime_solicitud == 'N')
                    {{--
                    <button type="submit" class="btn btn-success" name="guardar" id="guardar" value="true">
                        Guardar
                    </button>
                    --}}

                    <button type="submit" onclick="return confirm('Ya no podrá realizar cambios, esta seguro?')" class="btn btn-success" name="guardarFinalizar" id="guardarFinalizar" value="true">
                        Guardar y finalizar
                    </button>
                @else
                    <a href="{{ route('solicitudes.imprimir',$solicitud->uuid) }}" class="btn btn-success">
                        Descargar solicitud
                    </a>

                    <a href="{{ route('alumnos.conceptoDePago.descargarFormatoApoyoEducacionReinscripcion',$solicitud->uuid) }}" class="btn btn-success">
                        Descargar Formato Apoyo a la educación
                    </a>
                @endif

                <a href="{{ route('home') }}" class="btn btn-default pull-right">Regresar</a>
            </div>

            @if($imprime_solicitud == 'N')
                <div class="card-footer">
                    * Si presionas el botón Guardar y finalizar, ya no podrás realizar cambios en tu solicitud, pero ya la podrás imprimir
                </div>
            @else
                <div class="card-footer">
                    <div class="callout callout-warning">
                        <h5>Importante.</h5>

                        <p>
                            <strong>ENVÍA el comprobante bancario </strong> (escaneado, foto o PDF) <strong>al correo
                            inscripciones2021@evasamano.edu.mx para finalizar tu inscripción</strong>. En el correo deberás
                            anotar tu: Nombre completo, Carrera, Semestre a cursar y Turno.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        {!! Form::close() !!}

    </div>


@endsection

@section('jscripts')
    <script src="{{ mix('js/solicitudes/reinscripcion.js') }}"></script>
@endsection
