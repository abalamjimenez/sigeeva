<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $table = 'referencias';

    protected $fillable = [
        'nombre', 'primer_apellido', 'segundo_apellido'
    ];

    public function personas()
    {
        //return $this->belongsToMany(Persona::class, 'persona_referencia', 'referencia_id', 'persona_id')->withTimestamps();
        return $this->belongsToMany(Persona::class, 'persona_referencia','referencia_id','persona_id');
    }

    public function domicilios()
    {
        return $this->morphMany(Domicilio::class, 'domiciliable');
        //return $this->morphMany(Domicilio::class, 'domiciliable','domiciliable_type','domiciliable_id','id');
    }

    public function usuario()
    {
        return $this->morphOne(User::clas,'userable');
    }
}
