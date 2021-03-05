<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DescargarCuentasExport implements FromView
{
    protected $cuentas;

    public function __construct(array $cuentas)
    {
        $this->cuentas = $cuentas;
    }

    public function view(): View
    {
        return view('exports.descargarCuentas',[
            'cuentas' => $this->cuentas
        ]);
    }
}
