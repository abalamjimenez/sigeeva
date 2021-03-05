<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Alumno extends Model
{
    protected $table = 'alumnos';

    protected $fillable = [

    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    public function expediente()
    {
        return $this->hasOne(Expediente::class, 'alumno_id');
    }
}
