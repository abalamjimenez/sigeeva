<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GroupsExport implements FromView
{
    protected $arregloAlumnos;
    protected $generales;

    public function __construct(Object $generales,array $arregloAlumnos)
    {
        $this->generales      = $generales;
        $this->arregloAlumnos = $arregloAlumnos;
    }

    public function view(): View
    {
        return view('exports.grupos',[
            'generales'      => $this->generales,
            'arregloAlumnos' => $this->arregloAlumnos
        ]);
    }
}
