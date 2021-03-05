<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('carrera') !!}
            {!! Form::text('carrera',$arregloSolicitud['carrera_descripcion'],['class'=>'form-control form-control-lg','id'=>'carrera','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('semestre') !!}
            {!! Form::text('semestre',$arregloSolicitud['grado_id'],['class'=>'form-control form-control-lg','id'=>'semestre','disabled']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('turno') !!}
            {!! Form::text('turno',$arregloSolicitud['turno_descripcion'],['class'=>'form-control form-control-lg','id'=>'turno','disabled']) !!}
        </div>
    </div>
</div>
