<?php

use App\Models\EsIndigena;
use Illuminate\Database\Seeder;

class EsIndigenaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EsIndigena::class,1)->create(['clave'=>'0','descripcion' => 'NO ES INDIGENA']);
        factory(EsIndigena::class,1)->create(['clave'=>'1','descripcion' => 'ES INDIGENA']);
    }
}
