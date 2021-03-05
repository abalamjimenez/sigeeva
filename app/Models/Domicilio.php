<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $table = 'domicilios';

    protected $fillable = ['domicilio_tipo','domicilio_calle','domicilio_numero_exterior','domicilio_colonia','domicilio_codigo_postal','domicilio_localidad_id'];

    public function domiciliable()
    {
        return $this->morphTo();
    }
}
