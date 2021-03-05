<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('Centro de trabajo') !!} <small class="text-muted"> (Lugar donde desarrolla su actividad económica principal)</small>
            {!! Form::text('ct',(isset($solicitud->solicitudCt->ct))?$solicitud->solicitudCt->ct:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ct']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Ocupacion') !!}
            {!! Form::text('ct_ocupacion',(isset($solicitud->solicitudCt->ocupacion))?$solicitud->solicitudCt->ocupacion:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ocupacion']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!}
            {!! Form::text('ct_telefono',(isset($solicitud->solicitudCt->telefono))?$solicitud->solicitudCt->telefono:NULL,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telefono']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Extensión') !!}
            {!! Form::text('ct_telefono_extension',(isset($solicitud->solicitudCt->telefono_extension))?$solicitud->solicitudCt->telefono_extension:NULL,['class'=>'form-control form-control-lg ','maxlength'=>5,'id'=>'telefono_extensión']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del centro de trabajo</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!}
            {!! Form::text('ct_domicilio_calle',(isset($solicitud->solicitudCt->domicilio_calle))?$solicitud->solicitudCt->domicilio_calle:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_calle']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!}
            {!! Form::text('ct_domicilio_numero',(isset($solicitud->solicitudCt->domicilio_numero))?$solicitud->solicitudCt->domicilio_numero:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_numero']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!}
            {!! Form::text('ct_domicilio_cruzamientos',(isset($solicitud->solicitudCt->domicilio_cruzamientos))?$solicitud->solicitudCt->domicilio_cruzamientos:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_cruzamientos']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!}
            {!! Form::text('ct_domicilio_codigo_postal',(isset($solicitud->solicitudCt->domicilio_codigo_postal))?$solicitud->solicitudCt->domicilio_codigo_postal:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_codigo_postal']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!}
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('ct_domicilio_colonia',(isset($solicitud->solicitudCt->domicilio_colonia))?$solicitud->solicitudCt->domicilio_colonia:NULL,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_colonia']) !!}
        </div>
    </div>
</div>
