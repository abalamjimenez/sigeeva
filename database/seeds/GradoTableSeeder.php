<?php

use App\Models\Grado;
use Illuminate\Database\Seeder;

class GradoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Grado::class,1)->create(['numero' => '1','descripcion'=>'PRIMERO','aplicacion'=>'PRIMER']);
        factory(Grado::class,1)->create(['numero' => '2','descripcion'=>'SEGUNDO','aplicacion'=>'SEGUNDO']);
        factory(Grado::class,1)->create(['numero' => '3','descripcion'=>'TERCERO','aplicacion'=>'TERCER']);
        factory(Grado::class,1)->create(['numero' => '4','descripcion'=>'CUARTO', 'aplicacion'=>'CUARTO']);
        factory(Grado::class,1)->create(['numero' => '5','descripcion'=>'QUINTO', 'aplicacion'=>'QUINTO']);
        factory(Grado::class,1)->create(['numero' => '6','descripcion'=>'SEXTO',  'aplicacion'=>'SEXTO']);
    }
}
