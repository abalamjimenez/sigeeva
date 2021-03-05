<?php

use App\Models\SituacionAcademica;
use Illuminate\Database\Seeder;

class SituacionAcademicaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SituacionAcademica::class,1)->create(['clave' => 'R','descripcion' => 'Regular']);
        factory(SituacionAcademica::class,1)->create(['clave' => 'I','descripcion' => 'Irregular']);

    }
}
