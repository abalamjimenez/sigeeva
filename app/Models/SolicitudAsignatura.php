<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudAsignatura extends Model
{
    protected $table = 'solicitud_asignatura';

    protected $fillable = [
        'solicitud_id','asignatura_grupo_id'
    ];

    protected $guarded = [];
}
