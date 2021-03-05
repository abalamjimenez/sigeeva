<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grados';

    protected $fillable = [
        'numero','descripcion','aplicacion'
    ];

    protected $guarded = [];
}
