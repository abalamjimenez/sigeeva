<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalificacionGrupo extends Model
{
    protected $table = 'calificacion_grupo';

    protected $fillable = [
        'persona_id','horario_id','asignatura_id'
    ];

    // = = = = = = = = = =
    // R E L A C I O N E S
    // = = = = = = = = = =

    public function persona()
    {
        return $this->belongsTo(Persona::class,'persona_id');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class,'asignatura_id');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class,'horario_id');
    }

    public function calificaciongrupoexpedientes()
    {
        return $this->hasMany(CalificacionGrupoExpediente::class,'calificacion_grupo_id');
    }
}
