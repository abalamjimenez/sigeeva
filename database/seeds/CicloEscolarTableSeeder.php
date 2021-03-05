<?php

use App\Models\CicloEscolar;
use Illuminate\Database\Seeder;

class CicloEscolarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CicloEscolar::class,1)->create(['descripcion' => '2019-2020','fecha_inicio'=>'2019-08-29','fecha_fin'=>'2020-06-05','vigente' => 'S']);
    }
}
