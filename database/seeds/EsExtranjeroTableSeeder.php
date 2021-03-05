<?php

use App\Models\EsExtranjero;
use Illuminate\Database\Seeder;

class EsExtranjeroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EsExtranjero::class,1)->create(['clave'=>'0','descripcion' => 'NO ES EXTRANJERO']);
        factory(EsExtranjero::class,1)->create(['clave'=>'1','descripcion' => 'ES EXTRANJERO']);
    }
}
