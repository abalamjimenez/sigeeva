<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Primer apellido') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('primer_apellido',$solicitud->primer_apellido,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido',$required]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Segundo apellido') !!}
            {!! Form::text('segundo_apellido',$solicitud->segundo_apellido,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!}  <span class="required" style="color:red">*</span>
            {!! Form::text('nombre',$solicitud->nombre,['class'=>'form-control form-control-lg segmento','id'=>'nombre',$required]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Curp") !!} <span class="required" style="color:red">*</span>
            {!! Form::text('curp_etiqueta',$solicitud->curp,['class'=>'form-control form-control-lg','id'=>'curp','pattern'=>'.{18}','minlength'=>'18','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fecha nacimiento') !!}  <span class="required" style="color:red">*</span>
            {!! Form::date('fecha_nacimiento',$solicitud->fecha_nacimiento,['class'=>'form-control form-control-lg segmento','id'=>'fecha_nacimiento',$required]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('sexo') !!}  <span class="required" style="color:red">*</span>
            {!! Form::select('sexo',['H'=>'Hombre','M'=>'Mujer'],$solicitud->sexo,['class'=>'form-control s2 segmento','placeholder'=>'Seleccione','id'=>'sexo',$required]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Correo electrónico') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('email',$solicitud->email,['class'=>'form-control form-control-lg ','id'=>'email',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('telefono',$solicitud->telefono,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo de sangre') !!} <span class="required" style="color:red">*</span>
            {!! Form::select('tipo_sangre_id',$tipo_sangre,$solicitud->tipo_sangre_id,['class'=>'form-control s2','placeholder'=>'','id'=>'tipo_sangre_id',"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Padeces alguna enfermedad, cuál?') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('enfermedad',$solicitud->enfermedad,['class'=>'form-control form-control-lg ','id'=>'enfermedad']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Tipo nacionalidad') !!} <span class="required" style="color:red">*</span>
            {!! Form::select('nacionalidad_tipo',['MEXICANA'=>'MEXICANA','EXTRANJERA'=>'EXTRANJERA'],$solicitud->nacionalidad_tipo,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'nacionalidad_tipo',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nacionalidad') !!}
            {!! Form::select('nacionalidad_id',$nacionalidades,$solicitud->nacionalidad_id,['class'=>'form-control s2','placeholder'=>'','id'=>'nacionalidad_id']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del solicitante</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('domicilio_calle',$solicitud->domicilio_calle,['class'=>'form-control form-control-lg segmento','id'=>'domicilio_calle',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('domicilio_numero',$solicitud->domicilio_numero,['class'=>'form-control form-control-lg segmento','id'=>'domicilio_numero',"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('domicilio_cruzamientos',$solicitud->domicilio_cruzamientos,['class'=>'form-control form-control-lg','id'=>'domicilio_cruzamientos',"$optional_required"]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('Código postal') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('domicilio_codigo_postal',$solicitud->domicilio_codigo_postal,['class'=>'form-control form-control-lg','id'=>'domicilio_codigo_postal','maxlength'=>5,"$optional_required"]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!} <span class="required" style="color:red">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('domicilio_colonia',$solicitud->domicilio_colonia,['class'=>'form-control form-control-lg','id'=>'domicilio_colonia',"$optional_required"]) !!}
        </div>
    </div>
</div>
