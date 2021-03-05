<?php

namespace App\Exports;

use App\Models\Grupo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SabanaGrupoExport implements FromView
{
    protected $grupo;
    protected $arregloAlumnos;
    protected $arregloAlumnosEnRepeticion;
    protected $arregloAsignaturas;
    protected $arregloCalificaciones;

    public function __construct(Grupo $grupo,array $arregloAlumnos,array $arregloAlumnosEnRepeticion,array $arregloAsignaturas,array $arregloCalificaciones)
    {
        $this->grupo                      = $grupo;
        $this->arregloAlumnos             = $arregloAlumnos;
        $this->arregloAlumnosEnRepeticion = $arregloAlumnosEnRepeticion;
        $this->arregloAsignaturas         = $arregloAsignaturas;
        $this->arregloCalificaciones      = $arregloCalificaciones;
    }

    public function view(): View
    {
        return view('exports.sabanaGrupos',[
            'grupo'                      => $this->grupo,
            'arregloAlumnos'             => $this->arregloAlumnos,
            'arregloAlumnosEnRepeticion' => $this->arregloAlumnosEnRepeticion,
            'arregloAsignaturas'         => $this->arregloAsignaturas,
            'arregloCalificaciones'      => $this->arregloCalificaciones
        ]);
    }
}
