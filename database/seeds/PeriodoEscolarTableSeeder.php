<?php

use App\Models\PeriodoEscolar;
use Illuminate\Database\Seeder;

class PeriodoEscolarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PeriodoEscolar::class,1)->create(
            [
                'ciclo_escolar_id' => 1,
                'descripcion'      => 'Ciclo Escolar 2019-2020 Semestre A',
                'fecha_inicio'     =>'2019-08-29',
                'fecha_fin'        =>'2019-12-13',
                'vigente'          => 'N'
            ]
        );

        factory(PeriodoEscolar::class,1)->create(
            [
                'ciclo_escolar_id' => 1,
                'descripcion'      => 'Ciclo Escolar 2019-2020 Semestre B',
                'fecha_inicio'     =>'2020-01-27',
                'fecha_fin'        =>'2020-06-05',
                'vigente'          => 'S'
            ]
        );
    }
}
