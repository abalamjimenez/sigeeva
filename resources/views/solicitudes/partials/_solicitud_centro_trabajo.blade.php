<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('Centro de trabajo') !!}  <span class="required">*</span> <small class="text-muted"> (Lugar donde desarrolla su actividad económica principal)</small>
            {!! Form::text('ct',$arregloSolicitud['ct'],['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Ocupacion') !!} <span class="required">*</span>
            {!! Form::text('ct_ocupacion',$arregloSolicitud['ocupacion'],['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required">*</span>
            {!! Form::text('ct_telefono',$arregloSolicitud['ct_telefono'],['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telfono','required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Extensión') !!}
            {!! Form::text('ct_telefono_extension',$arregloSolicitud['ct_telefono_extension'],['class'=>'form-control form-control-lg ','maxlength'=>5,'id'=>'telefono_extensión']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del centro de trabajo</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required">*</span>
            {!! Form::text('ct_domicilio_calle',$arregloSolicitud['ct_domicilio_calle'],['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_calle','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required">*</span>
            {!! Form::text('ct_domicilio_numero',$arregloSolicitud['ct_domicilio_numero'],['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_numero','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!}  <span class="required">*</span>
            {!! Form::text('ct_domicilio_cruzamientos',$arregloSolicitud['ct_domicilio_cruzamientos'],['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_cruzamientos','required']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!} <span class="required">*</span>
            {!! Form::text('ct_domicilio_codigo_postal',$arregloSolicitud['ct_domicilio_codigo_postal'],['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_codigo_postal','maxlength'=>5,'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!} <span class="required">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('ct_domicilio_colonia',$arregloSolicitud['ct_domicilio_colonia'],['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_colonia','required']) !!}
        </div>
    </div>
</div>
