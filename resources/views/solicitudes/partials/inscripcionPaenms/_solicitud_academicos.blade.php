<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('carrera') !!}
            {!! Form::text('carrera',$solicitud->carrera_descripcion,['class'=>'form-control form-control-lg','id'=>'carrera','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('semestre') !!}
            {!! Form::text('semestre',$solicitud->grado_id,['class'=>'form-control form-control-lg','id'=>'semestre','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('turno') !!}
            {!! Form::text('turno','Pendiente por asignar',['class'=>'form-control form-control-lg','id'=>'turno','disabled']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Escuela de procedencia CCT') !!}
            {!! Form::text('secundaria_procedencia_cct',$solicitud->secundaria_procedencia_cct,['class'=>'form-control form-control-lg','minlength'=>10, 'maxlength'=>10]) !!}

            <small class="text-muted">
                La clave de centro de trabajo (CCT) se encuentra en tu boleta de secundaria.
            </small>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('Escuela de procedencia Nombre') !!}
            {!! Form::text('secundaria_procedencia_descripcion_etiqueta',$solicitud->secundaria_procedencia_descripcion,['class'=>'form-control form-control-lg','disabled']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Año de egreso de la secundaria') !!}
            {!! Form::text('secundaria_procedencia_fecha_egreso',$solicitud->secundaria_procedencia_fecha_egreso,['class'=>'form-control form-control-lg','minlength'=>4, 'maxlength'=>4]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Promedio general') !!}
            {!! Form::text('secundaria_procedencia_promedio',$solicitud->secundaria_procedencia_promedio,['class'=>'form-control form-control-lg']) !!}
        </div>
    </div>
</div>
