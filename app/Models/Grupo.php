<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = [
        'clave','descripcion',
        'periodo_escolar_id','carrera_id','grado_id','turno_id'
    ];

    protected $guarded = [];

    // = = = = = = = = = =
    // R E L A C I O N E S
    // = = = = = = = = = =
    public function carrera()
    {
        return $this->belongsTo(Carrera::class,'carrera_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class,'turno_id');
    }

    public function controlEscolar()
    {
        return $this->belongsToMany(Persona::class, 'grupo_control_escolar', 'grupo_id', 'persona_id');
    }

    public function tutor()
    {
        return $this->belongsToMany(Persona::class, 'grupo_tutor', 'grupo_id', 'persona_id');
    }
}
