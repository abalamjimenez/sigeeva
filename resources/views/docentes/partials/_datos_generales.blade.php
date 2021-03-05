<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {!! Form::label("Curp") !!} <span class="required">*</span>
            {!! Form::text('curp',(isset($persona->curp))?$persona->curp:NULL,['class'=>'form-control form-control-lg','id'=>'curp','required','pattern'=>'.{18}','minlength'=>'18']) !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {!! Form::label("RFC") !!} <span class="required">*</span>
            {!! Form::text('rfc',(isset($persona->rfc))?$persona->rfc:NULL,['class'=>'form-control form-control-lg','id'=>'rfc','required','pattern'=>'.{13}','minlength'=>'13']) !!}
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="form-group">
            {!! Form::label('fecha nacimiento') !!} <span class="required">*</span>
            {!! Form::date('fecha_nacimiento',(isset($persona->fecha_nacimiento))?$persona->fecha_nacimiento:NULL,['class'=>'form-control form-control-lg segmento','id'=>'fecha_nacimiento','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required">*</span>
            {!! Form::text('telefono',(isset($persona->telefono))?$persona->telefono:NULL,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono','required']) !!}
        </div>
    </div>
    <div class="col-lg-4 col-md-8">
        <div class="form-group">
            {!! Form::label('email') !!} <span class="required">*</span>
            {!! Form::text('email',(isset($persona->email))?$persona->email:NULL,['class'=>'form-control form-control-lg ','id'=>'email','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!} <span class="required">*</span>
            {!! Form::text('nombre',(isset($persona->nombre))?$persona->nombre:NULL,['class'=>'form-control form-control-lg segmento','id'=>'nombre','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required">*</span>
            {!! Form::text('primer_apellido',(isset($persona->primer_apellido))?$persona->primer_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('segundo_apellido',(isset($persona->segundo_apellido))?$persona->segundo_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sexo') !!} <span class="required">*</span>
            {!! Form::select('sexo',['H'=>'Hombre','M'=>'Mujer'],(isset($persona->sexo))?$persona->sexo:NULL,['class'=>'form-control s2 segmento','placeholder'=>'Seleccione','id'=>'sexo','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('País de nacimiento') !!} <span class="required">*</span>
            {!! Form::select('pais_nacimiento_id',$paises,(isset($persona->pais_nacimiento_id))?$persona->pais_nacimiento_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'pais_nacimiento_id','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Entidad de nacimiento') !!} <span class="required">*</span>
            {!! Form::select('entidad_nacimiento_id',$entidades,(isset($persona->entidad_nacimiento_id))?$persona->entidad_nacimiento_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'entidad_nacimiento_id','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('numero_seguridad_social') !!}
            {!! Form::text('numero_seguridad_social',(isset($persona->numero_seguridad_social))?$persona->numero_seguridad_social:NULL,['class'=>'form-control form-control-lg','id'=>'numero_seguridad_social']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Idioma') !!}
            {!! Form::select('idioma_id',$idiomas,(isset($persona->idioma_id))?$persona->idioma_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'idioma_id','']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Es Extranjero') !!}
            {!! Form::select('es_extranjero_id',$es_extranjero_array,(isset($persona->es_extranjero_id))?$persona->es_extranjero_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'es_extranjero_id','']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Es Indigena') !!}
            {!! Form::select('es_indigena_id',$es_indigena_array,(isset($persona->es_indigena_id))?$persona->es_indigena_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'es_indigena_id','']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">

        </div>
    </div>
</div>
