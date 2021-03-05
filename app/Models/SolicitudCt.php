<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudCt extends Model
{
    protected $table = 'solicitud_ct';

    protected $fillable = [
        'solicitud_id',
        'ct','ocupacion','telefono', 'telefono_extension',
        'domicilio_calle','domicilio_numero','domicilio_cruzamientos',
        'domicilio_codigo_postal','domicilio_colonia'
    ];

    protected $guarded = [];
}
