<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CuentasExport implements FromView
{
    protected $cuentasValidadas;
    protected $generales;

    public function __construct(Object $generales,Object $cuentasValidadas)
    {
        $this->generales        = $generales;
        $this->cuentasValidadas = $cuentasValidadas;
    }

    public function view(): View
    {
        return view('exports.cuentasValidadas',[
            'generales'        => $this->generales,
            'cuentasValidadas' => $this->cuentasValidadas
        ]);
    }
}
