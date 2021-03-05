<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $connection = 'inegi_db';
    protected $table = 'localidades';

    public function getDescripcionAttribute()
    {
        return $this->NOM_LOC;
    }

    public static function othonpblanco()
    {
        $collection = self::where('CVE_MUN','004')
        ->where('NOM_LOC','!=','NINGUNO');

        return $collection;
    }

    /*
    public static function ciclosByPeriodicidadNivel($periodicidad_id, $nivel = NULL)
    {
        $collection = NULL;
        if($nivel == 'SUPERIOR'){
            $collection = self::orderBy('mes_inicio','desc')->orderBy('inicio','desc');
        }else {
            if ( ! in_array($periodicidad_id, [ 3, 4 ])) {
                $collection = self::where('es_periodo', '=', "1")
                    ->where('periodicidad_id', '=', (String)$periodicidad_id)
                    ->orderBy('mes_inicio', 'DESC');
            }else {
                $collection = self::where('es_periodo', '=', "0")->orderBy('inicio', 'desc');
            }
        }
        return $collection;
    }
    */
}
