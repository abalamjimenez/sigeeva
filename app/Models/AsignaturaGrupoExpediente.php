<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AsignaturaGrupoExpediente extends Model
{
    protected $table = 'asignatura_grupo_expediente';

    protected $fillable = [
        'uuid','asignatura_grupo_id','expediente_id','es_adicional',
        'created_at','updated_at'
    ];

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'expediente_id');
    }
}
