<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_primer_apellido',optional($solicitud->solicitudTutor)->primer_apellido,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('tutor_segundo_apellido',optional($solicitud->solicitudTutor)->segundo_apellido,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_nombre',optional($solicitud->solicitudTutor)->nombre,['class'=>'form-control form-control-lg segmento','id'=>'nombre',"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!}
            {!! Form::text('tutor_curp',optional($solicitud->solicitudTutor)->curp,['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18']) !!}
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
            {!! Form::text('tutor_email',optional($solicitud->solicitudTutor)->email,['class'=>'form-control form-control-lg ','id'=>'email']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_telefono',optional($solicitud->solicitudTutor)->telefono,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono',"$optional_required"]) !!}
        </div>
    </div>
</div>

<h4>Domicilio del padre o tutor</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_domicilio_calle',optional($solicitud->solicitudTutor)->domicilio_calle,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_calle']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_domicilio_numero',optional($solicitud->solicitudTutor)->domicilio_numero,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_numero']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_domicilio_cruzamientos',optional($solicitud->solicitudTutor)->domicilio_cruzamientos,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_cruzamientos']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('tutor_domicilio_codigo_postal',optional($solicitud->solicitudTutor)->domicilio_codigo_postal,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_codigo_postal','maxlength'=>5]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y Localidad') !!} <span class="required" style="color:red">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('tutor_domicilio_colonia',optional($solicitud->solicitudTutor)->domicilio_colonia,['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_colonia']) !!}
        </div>
    </div>
</div>
