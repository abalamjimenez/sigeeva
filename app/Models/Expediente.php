<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Expediente extends Model
{
    protected $table = 'expedientes';

    protected $fillable = [
        'alumno_id','uuid','periodo_escolar_id',
        'grupo_id','carrera_id','turno_id',
        'grado_id',
        'es_readmision','es_cedar','vigente',
        'created_at','updated_at'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }


    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turno_id');
    }

    public function generacion()
    {
        return $this->belongsTo(Generacion::class, 'generacion_id');
    }
}
