<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required">*</span>
            {!! Form::text('tutor_primer_apellido',$arregloSolicitud['tutor_primer_apellido'],['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('tutor_segundo_apellido',$arregloSolicitud['tutor_segundo_apellido'],['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!} <span class="required">*</span>
            {!! Form::text('tutor_nombre',$arregloSolicitud['tutor_nombre'],['class'=>'form-control form-control-lg segmento','id'=>'nombre','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!}
            {!! Form::text('tutor_curp',$arregloSolicitud['tutor_curp'],['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18']) !!}
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
            {!! Form::text('tutor_email',$arregloSolicitud['tutor_email'],['class'=>'form-control form-control-lg ','id'=>'email']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required">*</span>
            {!! Form::text('tutor_telefono',$arregloSolicitud['tutor_telefono'],['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono','required']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del padre o tutor</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!}  <span class="required">*</span>
            {!! Form::text('tutor_domicilio_calle',$arregloSolicitud['tutor_domicilio_calle'],['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_calle','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required">*</span>
            {!! Form::text('tutor_domicilio_numero',$arregloSolicitud['tutor_domicilio_numero'],['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_numero','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required">*</span>
            {!! Form::text('tutor_domicilio_cruzamientos',$arregloSolicitud['tutor_domicilio_cruzamientos'],['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_cruzamientos','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!} <span class="required">*</span>
            {!! Form::text('tutor_domicilio_codigo_postal',$arregloSolicitud['tutor_domicilio_codigo_postal'],['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_codigo_postal','maxlength'=>5,'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y Localidad') !!} <span class="required">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('tutor_domicilio_colonia',$arregloSolicitud['tutor_domicilio_colonia'],['class'=>'form-control form-control-lg segmento','id'=>'tutor_domicilio_colonia','required']) !!}
        </div>
    </div>
</div>
