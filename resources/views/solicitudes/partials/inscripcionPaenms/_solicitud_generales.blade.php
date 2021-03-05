<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required">*</span>
            {!! Form::text('primer_apellido_etiqueta',$solicitud->primer_apellido,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido','disabled','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('segundo_apellido_etiqueta',$solicitud->segundo_apellido,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!}
            {!! Form::text('nombre_etiqueta',$solicitud->nombre,['class'=>'form-control form-control-lg segmento','id'=>'nombre','disabled']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!}
            {!! Form::text('curp_etiqueta',$solicitud->curp,['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fecha nacimiento') !!}
            {!! Form::date('fecha_nacimiento',$solicitud->fecha_nacimiento,['class'=>'form-control form-control-lg segmento','id'=>'fecha_nacimiento','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sexo') !!}
            {!! Form::select('sexo',['H'=>'Hombre','M'=>'Mujer'],$solicitud->sexo,['class'=>'form-control s2 segmento','placeholder'=>'Seleccione','id'=>'sexo','disabled']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Correo electrónico') !!} <span class="required">*</span>
            {!! Form::text('email',$solicitud->email,['class'=>'form-control form-control-lg ','id'=>'email',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required">*</span>
            {!! Form::text('telefono',$solicitud->telefono,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo de sangre') !!} <span class="required">*</span>
            <!-- TODO: ponerle required !-->
            {!! Form::select('tipo_sangre_id',$tipo_sangre,$solicitud->tipo_sangre_id,['class'=>'form-control s2','placeholder'=>'','id'=>'tipo_sangre_id',"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Padeces alguna enfermedad, cuál?') !!}
            {!! Form::text('enfermedad',$solicitud->enfermedad,['class'=>'form-control form-control-lg ','id'=>'enfermedad']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Servicio médico?') !!}  <span class="required">*</span>
            {!! Form::text('servicio_medico',$solicitud->servicio_medico,['class'=>'form-control form-control-lg ','id'=>'servicio_medico',"$optional_required"]) !!}

            <small>Indica en que dependencía cuentas con tu servicio médico</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿No. de seguridad social?') !!} <span class="required">*</span>
            {!! Form::text('numero_seguridad_social',$solicitud->numero_seguridad_social,['class'=>'form-control form-control-lg ','id'=>'numero_seguridad_social',"$optional_required"]) !!}
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
            {!! Form::select('nacionalidad_tipo',['MEXICANA'=>'MEXICANA','EXTRANJERA'=>'EXTRANJERA'],$solicitud->nacionalidad_tipo,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'nacionalidad_tipo',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nacionalidad') !!}
            {!! Form::select('nacionalidad_id',$nacionalidades,$solicitud->nacionalidad_id,['class'=>'form-control s2','placeholder'=>'','id'=>'nacionalidad_id']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Tienes beca, cuál?') !!}
            {!! Form::text('beca',$solicitud->beca,['class'=>'form-control form-control-lg ','id'=>'beca']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del solicitante</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required">*</span>
            {!! Form::text('domicilio_calle',$solicitud->domicilio_calle,['class'=>'form-control form-control-lg segmento','id'=>'domicilio_calle',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required">*</span>
            {!! Form::text('domicilio_numero',$solicitud->domicilio_numero,['class'=>'form-control form-control-lg segmento','id'=>'domicilio_numero',"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required">*</span>
            {!! Form::text('domicilio_cruzamientos',$solicitud->domicilio_cruzamientos,['class'=>'form-control form-control-lg','id'=>'domicilio_cruzamientos',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('Código postal') !!} <span class="required">*</span>
            {!! Form::text('domicilio_codigo_postal',$solicitud->domicilio_codigo_postal,['class'=>'form-control form-control-lg','id'=>'domicilio_codigo_postal','maxlength'=>5,"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!} <span class="required">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('domicilio_colonia',$solicitud->domicilio_colonia,['class'=>'form-control form-control-lg','id'=>'domicilio_colonia',"$optional_required"]) !!}
        </div>
    </div>
</div>
