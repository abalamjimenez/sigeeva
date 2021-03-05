<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required">*</span>
            {!! Form::text('primer_apellido',(isset($solicitud->primer_apellido))?$solicitud->primer_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('segundo_apellido',(isset($solicitud->segundo_apellido))?$solicitud->segundo_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!} <span class="required">*</span>
            {!! Form::text('nombre',(isset($solicitud->nombre))?$solicitud->nombre:NULL,['class'=>'form-control form-control-lg segmento','id'=>'nombre','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!} <span class="required">*</span>
            {!! Form::text('curp',(isset($solicitud->curp))?$solicitud->curp:NULL,['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fecha nacimiento') !!} <span class="required">*</span>
            {!! Form::date('fecha_nacimiento',(isset($solicitud->fecha_nacimiento))?$solicitud->fecha_nacimiento:NULL,['class'=>'form-control form-control-lg segmento','id'=>'fecha_nacimiento','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sexo') !!} <span class="required">*</span>
            {!! Form::select('sexo',['H'=>'Hombre','M'=>'Mujer'],(isset($solicitud->sexo))?$solicitud->sexo:NULL,['class'=>'form-control s2 segmento','placeholder'=>'Seleccione','id'=>'sexo','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Correo electrónico') !!} <span class="required">*</span>
            {!! Form::text('email',(isset($solicitud->email))?$solicitud->email:NULL,['class'=>'form-control form-control-lg ','id'=>'email','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required">*</span>
            {!! Form::text('telefono',(isset($solicitud->telefono))?$solicitud->telefono:NULL,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo de sangre') !!} <span class="required">*</span>
            {!! Form::select('tipo_sangre_id',$tipo_sangre,(isset($solicitud->tipo_sangre_id))?$solicitud->tipo_sangre_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'tipo_sangre_id','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Padeces alguna enfermedad, cuál?') !!}
            {!! Form::text('enfermedad',(isset($solicitud->enfermedad))?$solicitud->enfermedad:NULL,['class'=>'form-control form-control-lg ','id'=>'enfermedad']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿En que dependencia cuentas con servicio médico?') !!}  <span class="required">*</span>
            {!! Form::text('servicio_medico',(isset($solicitud->servicio_medico))?$solicitud->servicio_medico:NULL,['class'=>'form-control form-control-lg ','id'=>'servicio_medico','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿No. de seguridad social?') !!} <span class="required">*</span>
            {!! Form::text('numero_seguridad_social',(isset($solicitud->numero_seguridad_social))?$solicitud->numero_seguridad_social:NULL,['class'=>'form-control form-control-lg ','id'=>'numero_seguridad_social','required']) !!}
            <small>
                <a href="http://www.imss.gob.mx/tramites/imss02008" target="_blank">
                    Localiza aqui tu número de seguridad social
                </a>
            </small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo nacionalidad') !!} <span class="required">*</span>
            {!! Form::select('nacionalidad_tipo',['MEXICANA'=>'MEXICANA','EXTRANJERA'=>'EXTRANJERA'],(isset($solicitud->nacionalidad_tipo))?$solicitud->nacionalidad_tipo:NULL,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'nacionalidad_tipo']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nacionalidad') !!}
            {!! Form::select('nacionalidad_id',$nacionalidades,(isset($solicitud->nacionalidad_id))?$solicitud->nacionalidad_id:NULL,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'nacionalidad_id']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Tienes beca, cuál?') !!}
            {!! Form::text('beca',(isset($solicitud->beca))?$solicitud->beca:NULL,['class'=>'form-control form-control-lg ','id'=>'beca']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del solicitante</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required">*</span>
            {!! Form::text('domicilio_calle',(isset($solicitud->domicilio_calle))?$solicitud->domicilio_calle:NULL,['class'=>'form-control form-control-lg segmento','id'=>'domicilio_calle','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required">*</span>
            {!! Form::text('domicilio_numero',(isset($solicitud->domicilio_numero))?$solicitud->domicilio_numero:NULL,['class'=>'form-control form-control-lg segmento','id'=>'domicilio_numero','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required">*</span>
            {!! Form::text('domicilio_cruzamientos',(isset($solicitud->domicilio_cruzamientos))?$solicitud->domicilio_cruzamientos:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_cruzamientos','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!} <span class="required">*</span>
            {!! Form::text('domicilio_codigo_postal',(isset($solicitud->domicilio_codigo_postal))?$solicitud->domicilio_codigo_postal:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_codigo_postal','maxlength'=>5,'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!} <span class="required">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('domicilio_colonia',(isset($solicitud->domicilio_colonia))?$solicitud->domicilio_colonia:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_colonia','required']) !!}
        </div>
    </div>
</div>
