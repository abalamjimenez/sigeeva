<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AsignaturaGrupo extends Model
{
    protected $table = 'asignatura_grupo';

    protected $fillable = [
        'grupo_id','asignatura_id','persona_id','uuid'
    ];

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    // = = = = = = = = = =
    // R E L A C I O N E S
    // = = = = = = = = = =
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class,'asignatura_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class,'grupo_id');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'persona_id');
    }
}
