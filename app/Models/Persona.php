<?php

namespace App\Models;

use App\User;
use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'uuid',
        'curp', 'sexo', 'nombre', 'primer_apellido', 'segundo_apellido',
        'fecha_nacimiento', 'telefono', 'email', 'idioma_id',
        'pais_nacimiento_id', 'entidad_nacimiento_id', 'numero_seguridad_social', 'tipo_registro',
        'necesidad_educativa_id', 'es_extranjero_id', 'es_indigena_id'
    ];

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
            $model->nombre_completo = "{$model->primer_apellido} {$model->segundo_apellido} {$model->nombre}";
        });

        static::updating(function ($model) {
            $model->nombre_completo = "{$model->primer_apellido} {$model->segundo_apellido} {$model->nombre}";
        });
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'persona_id');
    }

    public function paises()
    {
        return $this->belongsTo(Pais::class, 'pais_nacimiento_id');
    }

    public function entidades()
    {
        return $this->belongsTo(Entidad::class, 'entidad_nacimiento_id');
    }

    public function referencias()
    {
        return $this->belongsToMany(Referencia::class, 'persona_referencia', 'persona_id', 'referencia_id');
    }

    public function domicilios()
    {
        return $this->morphMany(Domicilio::class,'domiciliable');
    }

    public function usuario()
    {
        return $this->morphOne(User::class,'userable');
    }
}
