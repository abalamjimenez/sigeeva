<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {!! Form::label("Abreviación") !!} <span class="required">*</span>
            {!! Form::text('abreviacion',(isset($asignatura->abreviacion))?$asignatura->abreviacion:NULL,['class'=>'form-control form-control-lg','id'=>'abreviacion','required']) !!}
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="form-group">
            {!! Form::label("Descripción") !!} <span class="required">*</span>
            {!! Form::text('descripcion',(isset($asignatura->descripcion))?$asignatura->descripcion:NULL,['class'=>'form-control form-control-lg','id'=>'abreviacion','required']) !!}
        </div>
    </div>
</div>
