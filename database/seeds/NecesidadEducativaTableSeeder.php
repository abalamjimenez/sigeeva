<?php

use App\Models\NecesidadEducativa;
use Illuminate\Database\Seeder;

class NecesidadEducativaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(NecesidadEducativa::class,1)->create(['clave' => '00','descripcion' => 'NO APLICA']);
        factory(NecesidadEducativa::class,1)->create(['clave' => '01','descripcion' => 'ESPECIAL']);
        factory(NecesidadEducativa::class,1)->create(['clave' => '02','descripcion' => 'SOBRESALIENTE']);
    }
}
