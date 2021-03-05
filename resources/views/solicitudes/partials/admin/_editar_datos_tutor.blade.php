<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required">*</span>
            {!! Form::text('tutor_primer_apellido',(isset($solicitud->solicitudTutor->primer_apellido))?$solicitud->solicitudTutor->primer_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('tutor_segundo_apellido',(isset($solicitud->solicitudTutor->segundo_apellido))?$solicitud->solicitudTutor->segundo_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!} <span class="required">*</span>
            {!! Form::text('tutor_nombre',(isset($solicitud->solicitudTutor->nombre))?$solicitud->solicitudTutor->nombre:NULL,['class'=>'form-control form-control-lg segmento','id'=>'nombre','required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!}
            {!! Form::text('tutor_curp',(isset($solicitud->solicitudTutor->curp))?$solicitud->solicitudTutor->curp:NULL,['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18']) !!}
            <small>
                <a href="https://www.gob.mx/curp/" target="_blank">
                    Localiza aqui tu CURP
                </a>
            </small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('tutor_email',(isset($solicitud->solicitudTutor->email))?$solicitud->solicitudTutor->email:NULL,['class'=>'form-control form-control-lg ','id'=>'email']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!}
            {!! Form::text('tutor_telefono',(isset($solicitud->solicitudTutor->telefono))?$solicitud->solicitudTutor->telefono:NULL,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del padre o tutor</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!}
            {!! Form::text('tutor_domicilio_calle',(isset($solicitud->solicitudTutor->domicilio_calle))?$solicitud->solicitudTutor->domicilio_calle:NULL,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_calle']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!}
            {!! Form::text('tutor_domicilio_numero',(isset($solicitud->solicitudTutor->domicilio_numero))?$solicitud->solicitudTutor->domicilio_numero:NULL,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_numero']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!}
            {!! Form::text('tutor_domicilio_cruzamientos',(isset($solicitud->solicitudTutor->domicilio_cruzamientos))?$solicitud->solicitudTutor->domicilio_cruzamientos:NULL,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_cruzamientos']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!}
            {!! Form::text('tutor_domicilio_codigo_postal',(isset($solicitud->solicitudTutor->domicilio_codigo_postal))?$solicitud->solicitudTutor->domicilio_codigo_postal:NULL,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_codigo_postal']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y Localidad') !!}
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('tutor_domicilio_colonia',(isset($solicitud->solicitudTutor->domicilio_colonia))?$solicitud->solicitudTutor->domicilio_colonia:NULL,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_colonia']) !!}
        </div>
    </div>
</div>
