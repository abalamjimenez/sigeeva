<?php

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Carrera::class,1)->create([
            'clave_federal' => '244207',
            'abreviacion'   => 'DEPORTES',
            'descripcion'   => 'TÉCNICO EN DEPORTES',
            'vigente'       => 'S'
        ]);

        factory(Carrera::class,1)->create([
            'clave_federal' => '611215',
            'abreviacion'   => 'INFORMÁTICA',
            'descripcion'   => 'TÉCNICO EN INFORMÁTICA',
            'vigente'       => 'S'
        ]);

        factory(Carrera::class,1)->create([
            'clave_federal' => '622204',
            'abreviacion'   => 'MERCADOTECNIA',
            'descripcion'   => 'TÉCNICO EN MERCADOTECNIA',
            'vigente'       => 'S'
        ]);

        factory(Carrera::class,1)->create([
            'clave_federal' => '244209',
            'abreviacion'   => 'RECREACIÓN',
            'descripcion'   => 'TÉCNICO EN RECREACIÓN',
            'vigente'       => 'S'
        ]);

        factory(Carrera::class,1)->create([
            'clave_federal' => '615102',
            'abreviacion'   => 'TURISMO ALTERNATIVO',
            'descripcion'   => 'TÉCNICO EN TURISMO ALTERNATIVO',
            'vigente'       => 'S'
        ]);
    }
}
