<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
	protected $connection = 'inegi_db';
	protected $table = 'entidades';

	public function getFullNameAttribute()
	{
		return $this->clave.' - '.$this->nombre;
	}


}
