<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CicloEscolar extends Model
{
    protected $table = 'ciclos_escolares';

    protected $fillable = [
        'descripcion','fecha_inicio','fecha_fin','vigente'
    ];

    protected $guarded =[];
}
