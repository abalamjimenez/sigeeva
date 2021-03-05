<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	protected $connection = 'inegi_db';
	protected $table = 'paises';


}
