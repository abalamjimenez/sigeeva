<?php

use App\Models\Turno;
use Illuminate\Database\Seeder;

class TurnoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Turno::class,1)->create(['abreviacion'=>'TM','descripcion' => 'Matutino']);
        factory(Turno::class,1)->create(['abreviacion'=>'TV','descripcion' => 'Vespertino']);
    }
}
