<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SolicitudesExport implements FromView
{
    protected $solicitudes;
    protected $datos;

    public function __construct(Object $solicitudes,array $datos)
    {
        $this->solicitudes = $solicitudes;
        $this->datos       = $datos;
    }

    public function view(): View
    {
        if ($this->datos['tipo_reporte'] == 'REINSCRIPCION')
        {
            return view('exports.solicitudesReinscripcion',[
                'solicitudes'=>$this->solicitudes,
                'datos'      =>$this->datos
            ]);
        }
    }
}
