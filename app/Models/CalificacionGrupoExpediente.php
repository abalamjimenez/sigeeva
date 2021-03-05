<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalificacionGrupoExpediente extends Model
{
    protected $table = 'calificacion_grupo_expediente';

    protected $fillable = [
        'calificacion_grupo_id','expediente_id','es_adicional'
    ];

    // = = = = = = = = = =
    // R E L A C I O N E S
    // = = = = = = = = = =

    public function calificacionGrupo()
    {
        return $this->belongsTo(CalificacionGrupo::class,'calificacion_grupo_id');
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class,'expediente_id');
    }
}
