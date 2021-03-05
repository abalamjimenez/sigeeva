<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('tipo_solicitud','Tipo') !!}
            {!! Form::select('tipo_solicitud',['REINSCRIPCION'=>'REINSCRIPCION','NUEVO_INGRESO'=>'NUEVO_INGRESO','NUEVO_INGRESO_PAENMS'=>'NUEVO_INGRESO_PAENMS'],request('tipo_solicitud'),['class'=>'form-control','placeholder'=>'Seleccione','id'=>'tipo_solicitud']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('grado_id','Semestre') !!}
            {!! Form::select('grado_id',['1'=>'1','2'=>'2','3'=>'3',4=>4,5=>5,6=>6],request('grado_id'),['class'=>'form-control','placeholder'=>'Seleccione','id'=>'grado_id']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('estatus_solicitud_id','Estatus') !!}
            {!! Form::select('estatus_solicitud_id',$arregloEstatusSolicitud,request('estatus_solicitud_id'),['class'=>'form-control','placeholder'=>'Seleccione','id'=>'estatus_solicitud_id']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('nombre','Nombre completo') !!}
            {!! Form::input('text','nombre',request('nombre'),['class'=>'form-control']) !!}
            <small>Ingresar: Apellido(s) Nombre(s)</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('curp','Curp') !!}
            {!! Form::input('text','curp',request('curp'),['class'=>'form-control']) !!}
        </div>
    </div>
</div>
