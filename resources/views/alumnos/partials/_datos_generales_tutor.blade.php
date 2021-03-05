{!! Form::hidden('id',$referencia->id) !!}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Nombre(s)') !!}
            {!! Form::text('nombre',(isset($referencia->nombre))?$referencia->nombre:NULL,['class'=>'form-control form-control-lg segmento','id'=>'nombre','']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Apellido paterno') !!}
            {!! Form::text('primer_apellido',(isset($referencia->primer_apellido))?$referencia->primer_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Apellido materno') !!}
            {!! Form::text('segundo_apellido',(isset($referencia->segundo_apellido))?$referencia->segundo_apellido:NULL,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Curp') !!}
            {!! Form::text('curp',(isset($referencia->curp))?$referencia->curp:NULL,['class'=>'form-control form-control-lg','id'=>'curp','','pattern'=>'.{18}','minlength'=>'18']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!}
            {!! Form::text('telefono',(isset($referencia->telefono))?$referencia->telefono:NULL,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono','']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email',(isset($referencia_email))?$referencia_email:NULL,['class'=>'form-control form-control-lg ','id'=>'email','']) !!}
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Domicilio personal</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Calle') !!}
                    {!! Form::text('domicilio_calle',(isset($referencia->domicilio_calle))?$referencia->domicilio_calle:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_calle','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Número exterior') !!}
                    {!! Form::text('domicilio_numero_exterior',(isset($referencia->domicilio_numero_exterior))?$referencia->domicilio_numero_exterior:NULL,['class'=>'form-control form-control-lg ','id'=>'domicilio_numero_exterior','']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Colonia') !!}
                    {!! Form::text('domicilio_colonia',(isset($referencia->domicilio_colonia))?$referencia->domicilio_colonia:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_colonia','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Código postal') !!}
                    {!! Form::text('domicilio_codigo_postal',(isset($referencia->domicilio_codigo_postal))?$referencia->domicilio_codigo_postal:NULL,['class'=>'form-control form-control-lg ','minlength'=>5, 'maxlength'=>5,'id'=>'domicilio_codigo_postal','']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Municipio') !!}
                    {!! Form::text('domicilio_municipio','Othon P. Blanco',['class'=>'form-control form-control-lg ','id'=>'domicilio_municipio','readonly'=>'readonly']) !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Localidad') !!}
                    {!! Form::select('domicilio_localidad_id',$localidades,(isset($referencia->domicilio_localidad_id))?$referencia->domicilio_localidad_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'domicilio_localidad_id','']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Domicilio del centro de trabajo</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Calle') !!}
                    {!! Form::text('domicilio_trabajo_calle',(isset($referencia->domicilio_trabajo_calle))?$referencia->domicilio_trabajo_calle:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_trabajo_calle','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Número exterior') !!}
                    {!! Form::text('domicilio_trabajo_numero_exterior',(isset($referencia->domicilio_trabajo_numero_exterior))?$referencia->domicilio_trabajo_numero_exterior:NULL,['class'=>'form-control form-control-lg ','id'=>'domicilio_trabajo_numero_exterior','']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Colonia') !!}
                    {!! Form::text('domicilio_trabajo_colonia',(isset($referencia->domicilio_trabajo_colonia))?$referencia->domicilio_trabajo_colonia:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_trabajo_colonia','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Código postal') !!}
                    {!! Form::text('domicilio_trabajo_codigo_postal',(isset($referencia->domicilio_trabajo_codigo_postal))?$referencia->domicilio_trabajo_codigo_postal:NULL,['class'=>'form-control form-control-lg ','minlength'=>5, 'maxlength'=>5,'id'=>'domicilio_trabajo_codigo_postal','']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Municipio') !!}
                    {!! Form::text('domicilio_municipio','Othon P. Blanco',['class'=>'form-control form-control-lg ','id'=>'domicilio_municipio','readonly'=>'readonly']) !!}
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Localidad') !!}
                    {!! Form::select('domicilio_trabajo_localidad_id',$localidades,(isset($referencia->domicilio_trabajo_localidad_id))?$referencia->domicilio_trabajo_localidad_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'domicilio_trabajo_localidad_id','']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
