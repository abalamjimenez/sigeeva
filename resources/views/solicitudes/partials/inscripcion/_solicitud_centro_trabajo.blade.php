<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('Centro de trabajo') !!} <span class="required" style="color:red">*</span> <small class="text-muted"> (Lugar donde desarrolla su actividad económica principal)</small>
            {!! Form::text('ct',optional($solicitud->solicitudCt)->ct,['class'=>'form-control form-control-lg segmento','id'=>'primer_apellido']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Ocupacion') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('ct_ocupacion',optional($solicitud->solicitudCt)->ocupacion,['class'=>'form-control form-control-lg segmento','id'=>'segundo_apellido']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('telefono') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('ct_telefono',optional($solicitud->solicitudCt)->telefono,['class'=>'form-control form-control-lg ','minlength'=>10, 'maxlength'=>10,'id'=>'telfono']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('Extensión') !!}
            {!! Form::text('ct_telefono_extension',optional($solicitud->solicitudCt)->telefono_extension,['class'=>'form-control form-control-lg ','maxlength'=>5,'id'=>'telefono_extensión']) !!}
        </div>
    </div>
</div>

<h4>Domicilio del centro de trabajo</h4>
<hr>

<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Calle') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('ct_domicilio_calle',optional($solicitud->solicitudCt)->domicilio_calle,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_calle']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('No.') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('ct_domicilio_numero',optional($solicitud->solicitudCt)->domicilio_numero,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_numero']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group">
            {!! Form::label('Cruzamientos') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('ct_domicilio_cruzamientos',optional($solicitud->solicitudCt)->domicilio_cruzamientos,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_cruzamientos']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('C.P.') !!} <span class="required" style="color:red">*</span>
            {!! Form::text('ct_domicilio_codigo_postal',optional($solicitud->solicitudCt)->domicilio_codigo_postal,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_codigo_postal','maxlength'=>5]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('Colonia y localidad') !!} <span class="required" style="color:red">*</span>
            <small class="text-muted">Ejemplo: Proterritorio, Chetumal, Quintana Roo.</small>
            {!! Form::text('ct_domicilio_colonia',optional($solicitud->solicitudCt)->domicilio_colonia,['class'=>'form-control form-control-lg segmento','id'=>'ct_domicilio_colonia']) !!}
        </div>
    </div>
</div>
