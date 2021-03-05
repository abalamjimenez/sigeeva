<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DescargarConcentradoDeCalificacionesExport implements FromView
{
    protected $expedientes;

    public function __construct(object $expedientes)
    {
        $this->expedientes = $expedientes;
    }

    public function view(): View
    {
        return view('exports.descargarConcentradoDeCalificaciones',[
            'expedientes' => $this->expedientes
        ]);
    }
}
