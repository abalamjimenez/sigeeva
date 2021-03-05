{!! Form::hidden('id',$alumno->id) !!}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!}
            {!! Form::text('nombre',(isset($alumno->nombre))?$alumno->nombre:NULL,['class'=>'form-control form-control-lg segmento','id'=>'nombre','']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Apellido paterno') !!}
            {!! Form::text('primer_apellido',(isset($alumno->primer_apellido))?$alumno->primer_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Apellido materno') !!}
            {!! Form::text('segundo_apellido',(isset($alumno->segundo_apellido))?$alumno->segundo_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Curp') !!}
            {!! Form::text('curp',(isset($alumno->curp))?$alumno->curp:NULL,['class'=>'form-control form-control-lg','id'=>'curp','','pattern'=>'.{18}','minlength'=>'18']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!}
            {!! Form::text('telefono',(isset($alumno->telefono))?$alumno->telefono:NULL,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono','']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email',(isset($alumno_email))?$alumno_email:NULL,['class'=>'form-control form-control-lg ','id'=>'email','']) !!}
        </div>
    </div>
</div>
