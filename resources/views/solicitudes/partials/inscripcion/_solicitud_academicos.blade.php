<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('carrera') !!}  <span class="required" style="color:red">*</span>
            {!! Form::select('carrera_id',$carreras,$solicitud->carrera_id,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'carrera_id',$required]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('semestre') !!} <span class="required" style="color:red">*</span>
            {!! Form::select('semestre',['2'=>'2','4'=>'4','6'=>'6'],$solicitud->grado_id,['class'=>'form-control s2 segmento','placeholder'=>'Seleccione','id'=>'semestre',$required]) !!}
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
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Nombre de tu Bachillerato de procedencia') !!}
            {!! Form::text('bachillerato_procedencia_descripcion',$solicitud->bachillerato_procedencia_descripcion,['class'=>'form-control form-control-lg']) !!}
            <small class="text-muted">
                Escribe en que bachillerato estudiaste los semestres anteriores.
            </small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('CCT de Secundaria de procedencia') !!}
            {!! Form::text('secundaria_procedencia_cct',$solicitud->secundaria_procedencia_cct,['class'=>'form-control form-control-lg','minlength'=>10, 'maxlength'=>10]) !!}

            <small class="text-muted">
                <strong style="color:cornflowerblue">
                    La clave de centro de trabajo (CCT)</strong> se encuentra en tu boleta de calificaciones, comienza con 23
            </small>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('Nombre de tu Secundaria de procedencia') !!}
            {!! Form::text('secundaria_procedencia_descripcion',$solicitud->secundaria_procedencia_descripcion,['class'=>'form-control form-control-lg']) !!}
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
