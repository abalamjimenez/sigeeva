<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required">*</span>
            {!! Form::text('primer_apellido',$arregloSolicitud['primer_apellido'],['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido','disabled','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('segundo_apellido',$arregloSolicitud['segundo_apellido'],['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!}
            {!! Form::text('nombre',$arregloSolicitud['nombre'],['class'=>'form-control form-control-lg segmento','id'=>'nombre','disabled']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!}
            {!! Form::text('curp',$arregloSolicitud['curp'],['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fecha nacimiento') !!}
            {!! Form::date('fecha_nacimiento',$arregloSolicitud['fecha_nacimiento'],['class'=>'form-control form-control-lg segmento','id'=>'fecha_nacimiento','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sexo') !!}
            {!! Form::select('sexo',['H'=>'Hombre','M'=>'Mujer'],$arregloSolicitud['sexo'],['class'=>'form-control s2 segmento','placeholder'=>'Seleccione','id'=>'sexo','disabled']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Correo electrónico') !!} <span class="required">*</span>
            {!! Form::text('email',$arregloSolicitud['email'],['class'=>'form-control form-control-lg ','id'=>'email','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required">*</span>
            {!! Form::text('telefono',$arregloSolicitud['telefono'],['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo de sangre') !!} <span class="required">*</span>
            {!! Form::select('tipo_sangre_id',$tipo_sangre,$arregloSolicitud['tipo_sangre_id'],['class'=>'form-control s2','placeholder'=>'','id'=>'tipo_sangre_id','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Padeces alguna enfermedad, cuál?') !!} <span class="required">*</span>
            {!! Form::text('enfermedad',$arregloSolicitud['enfermedad'],['class'=>'form-control form-control-lg ','id'=>'enfermedad','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo nacionalidad') !!} <span class="required">*</span>
            {!! Form::select('nacionalidad_tipo',['MEXICANA'=>'MEXICANA','EXTRANJERA'=>'EXTRANJERA'],$arregloSolicitud['nacionalidad_tipo'],['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'nacionalidad_tipo','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nacionalidad') !!}
            {!! Form::select('nacionalidad_id',$nacionalidades,$arregloSolicitud['nacionalidad_id'],['class'=>'form-control s2','placeholder'=>'','id'=>'nacionalidad_id']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del solicitante</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required">*</span>
            {!! Form::text('domicilio_calle',$arregloSolicitud['domicilio_calle'],['class'=>'form-control form-control-lg segmento','id'=>'domicilio_calle','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required">*</span>
            {!! Form::text('domicilio_numero',$arregloSolicitud['domicilio_numero'],['class'=>'form-control form-control-lg segmento','id'=>'domicilio_numero','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required">*</span>
            {!! Form::text('domicilio_cruzamientos',$arregloSolicitud['domicilio_cruzamientos'],['class'=>'form-control form-control-lg','id'=>'domicilio_cruzamientos','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!} <span class="required">*</span>
            {!! Form::text('domicilio_codigo_postal',$arregloSolicitud['domicilio_codigo_postal'],['class'=>'form-control form-control-lg','id'=>'domicilio_codigo_postal','maxlength'=>5,'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!} <span class="required">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('domicilio_colonia',$arregloSolicitud['domicilio_colonia'],['class'=>'form-control form-control-lg','id'=>'domicilio_colonia','required']) !!}
        </div>
    </div>
</div>
