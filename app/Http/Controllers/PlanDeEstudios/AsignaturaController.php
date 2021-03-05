<?php

namespace App\Http\Controllers\PlanDeEstudios;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AsignaturaController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $registros = Asignatura::paginate('100');

            return view('plandeestudios.asignaturas.index',compact('registros'));
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function create()
    {
        try
        {
            return view('plandeestudios.asignaturas.create');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function edit(Asignatura $asignatura,Request $request)
    {
        try
        {
            return view('plandeestudios.asignaturas.edit',compact('asignatura'));
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function update(Asignatura $asignatura,Request $request)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),
                [
                    'abreviacion' => 'required',
                    'descripcion'       => 'required',
                ],
                [
                    'carrera_id.required' => 'La carrera es requerida',
                    'curp.required'    => 'La curp es requerida',
                ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $asignatura->abreviacion = $request->input('abreviacion');
            $asignatura->descripcion = $request->input('descripcion');
            $asignatura->save();

            \DB::commit();

            $mensajeExito = 'Los cambios fueron almacenados satisfactoriamente.';

            return redirect()->back()->with(['msgExito'=>$mensajeExito]);
        }
        catch (\Exception $e)
        {
            \DB::rollback();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
