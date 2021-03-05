<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'nacionalidades';

	public function getFullNameAttribute()
	{
		return $this->clave.' - '.$this->descripcion;
	}


}
