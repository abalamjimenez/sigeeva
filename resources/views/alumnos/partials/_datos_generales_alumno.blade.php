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

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Domicilio personal</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Calle') !!}
                    {!! Form::text('domicilio_calle',(isset($alumno->domicilio_calle))?$alumno->domicilio_calle:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_calle','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Número exterior') !!}
                    {!! Form::text('domicilio_numero_exterior',(isset($alumno->domicilio_numero_exterior))?$alumno->domicilio_numero_exterior:NULL,['class'=>'form-control form-control-lg ','id'=>'domicilio_numero_exterior','']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Colonia') !!}
                    {!! Form::text('domicilio_colonia',(isset($alumno->domicilio_colonia))?$alumno->domicilio_colonia:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_colonia','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Código postal') !!}
                    {!! Form::text('domicilio_codigo_postal',(isset($alumno->domicilio_codigo_postal))?$alumno->domicilio_codigo_postal:NULL,['class'=>'form-control form-control-lg ','minlength'=>5, 'maxlength'=>5,'id'=>'domicilio_codigo_postal','']) !!}
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
                    {!! Form::select('domicilio_localidad_id',$localidades,(isset($alumno->domicilio_localidad_id))?$alumno->domicilio_localidad_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'domicilio_localidad_id','']) !!}
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
                    {!! Form::text('domicilio_trabajo_calle',(isset($alumno->domicilio_trabajo_calle))?$alumno->domicilio_trabajo_calle:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_trabajo_calle','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Número exterior') !!}
                    {!! Form::text('domicilio_trabajo_numero_exterior',(isset($alumno->domicilio_trabajo_numero_exterior))?$alumno->domicilio_trabajo_numero_exterior:NULL,['class'=>'form-control form-control-lg ','id'=>'domicilio_trabajo_numero_exterior','']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('Colonia') !!}
                    {!! Form::text('domicilio_trabajo_colonia',(isset($alumno->domicilio_trabajo_colonia))?$alumno->domicilio_trabajo_colonia:NULL,['class'=>'form-control form-control-lg','id'=>'domicilio_trabajo_colonia','']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('Código postal') !!}
                    {!! Form::text('domicilio_trabajo_codigo_postal',(isset($alumno->domicilio_trabajo_codigo_postal))?$alumno->domicilio_trabajo_codigo_postal:NULL,['class'=>'form-control form-control-lg ','minlength'=>5, 'maxlength'=>5,'id'=>'domicilio_trabajo_codigo_postal','']) !!}
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
                    {!! Form::select('domicilio_trabajo_localidad_id',$localidades,(isset($alumno->domicilio_trabajo_localidad_id))?$alumno->domicilio_trabajo_localidad_id:NULL,['class'=>'form-control s2','placeholder'=>'','id'=>'domicilio_trabajo_localidad_id','']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
