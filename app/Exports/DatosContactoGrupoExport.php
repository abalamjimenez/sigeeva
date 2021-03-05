<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DatosContactoGrupoExport implements FromView
{
    protected $grupo;
    protected $expedientes;

    public function __construct(Object $grupo,Object $expedientes)
    {
        $this->grupo       = $grupo;
        $this->expedientes = $expedientes;
    }

    public function view(): View
    {
        return view('exports.datosContactoGrupo',[
            'grupo'       => $this->grupo,
            'expedientes' => $this->expedientes
        ]);
    }
}
