<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label("Clave federal") !!}
            {!! Form::text('clave_federal',(isset($carrera->clave_federal))?$carrera->clave_federal:NULL,['class'=>'form-control form-control-lg','id'=>'clave_federal']) !!}
            <small class="form-text text-muted">
                Anotar la <strong>Clave DGP</strong>
            </small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label("Abreviación") !!}
            {!! Form::text('abreviacion',(isset($carrera->abreviacion))?$carrera->abreviacion:NULL,['class'=>'form-control form-control-lg','id'=>'abreviacion']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label("Nombre de la carrera") !!}
            {!! Form::text('descripcion',(isset($carrera->descripcion))?$carrera->descripcion:NULL,['class'=>'form-control form-control-lg','id'=>'descripcion']) !!}
            <small class="form-text text-muted">
                Anotar el <strong>nombre de la carrera DGP</strong>
            </small>
        </div>
    </div>
</div>

<h5>Nombre de los estudios cursados</h5>

<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label("Hombre") !!}
            {!! Form::text('titulo_hombre',(isset($titulo_hombre))?$titulo_hombre:NULL,['class'=>'form-control form-control-lg','id'=>'titulo_hombre']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label("Mujer") !!}
            {!! Form::text('titulo_mujer',(isset($titulo_mujer))?$titulo_mujer:NULL,['class'=>'form-control form-control-lg','id'=>'titulo_mujer']) !!}
        </div>
    </div>
</div>
