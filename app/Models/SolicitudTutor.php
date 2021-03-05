<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudTutor extends Model
{
    protected $table = 'solicitud_tutor';

    protected $fillable = [
        'solicitud_id','primer_apellido','segundo_apellido','nombre',
        'curp','email','telefono',
        'domicilio_calle','domicilio_numero','domicilio_cruzamientos',
        'domicilio_codigo_postal','domicilio_colonia'
    ];

    protected $guarded = [];
}
