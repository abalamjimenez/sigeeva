expediente <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('carrera') !!} <span class="required">*</span>
            {!! Form::select('carrera_id',$carreras,(isset($solicitud->carrera_id))?$solicitud->carrera_id:NULL,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'carrera_id','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('semestre') !!} <span class="required">*</span>
            {!! Form::select('grado_id',[1=>1,3=>3,5=>5],(isset($solicitud->grado_id))?$solicitud->grado_id:NULL,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'grado_id','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('turno') !!} <span class="required">*</span>
            {!! Form::select('turno_id',[1=>'Matutino',2=>'Vespertino'],(isset($solicitud->turno_id))?$solicitud->turno_id:NULL,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'turno_id','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Adeudas alguna materia?') !!} <span class="required">*</span>
            {!! Form::select('materias_reprobadas',['S'=>'Si','N'=>'No'],(isset($solicitud->materias_reprobadas))?$solicitud->materias_reprobadas:NULL,['class'=>'form-control s2','placeholder'=>'Seleccione','id'=>'materias_reprobadas','required']) !!}



        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('¿Cuantas materias adeudas?') !!}
            {!! Form::number('materias_reprobadas_cantidad',(isset($solicitud->materias_reprobadas_cantidad))?$solicitud->materias_reprobadas_cantidad:NULL,['class'=>'form-control','min'=>0,'max'=>6]);  !!}
        </div>
    </div>
</div>
