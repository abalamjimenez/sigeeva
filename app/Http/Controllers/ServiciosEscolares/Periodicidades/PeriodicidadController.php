<?php

namespace App\Http\Controllers\ServiciosEscolares\Periodicidades;

use App\Http\Controllers\Controller;
use App\Models\Periodicidad;
use Illuminate\Http\Request;
use Validator;

class PeriodicidadController extends Controller
{
    public function index(Request $request)
    {
        try {
            $periodicidades = Periodicidad::orderBy('id','desc')->paginate(100);

            return view('serviciosescolares.periodicidades.index',compact('periodicidades'));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function edit(Request $request, Periodicidad $periodicidad)
    {
        try {

            return view('serviciosescolares.periodicidades.edit',compact('periodicidad'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function update(Request $request, Periodicidad $periodicidad)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                'descripcion' => 'unique:App\Models\Periodicidad,descripcion,'.$periodicidad->id,
            ],[
                'descripcion.required' => 'La descripción es requerida'
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $periodicidad->update([
                'titulo'      => $request->post('titulo'),
                'descripcion' => $request->post('descripcion'),
            ]);

            \DB::commit();

            flash('Los datos se registraron satisfactoriamente')->success();

            return redirect()->to(route('periodicidades.edit',$periodicidad->id));
        }
        catch (\Exception $e)
        {
            \DB::rollBack();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function create()
    {
        try
        {
            return view('serviciosescolares.periodicidades.create');
        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function store(Request $request)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                'descripcion' => 'unique:App\Models\Periodicidad,descripcion',
            ],[
                'descripcion.required' => 'La descripción es requerida'
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $periodicidad = new Periodicidad();
            $periodicidad->titulo      = $request->post('titulo');
            $periodicidad->descripcion = $request->post('descripcion');
            $periodicidad->save();

            \DB::commit();

            flash('Los datos se registraron satisfactoriamente')->success();

            return redirect()->to(route('periodicidades.edit',$periodicidad->id));
        }
        catch (\Exception $e)
        {
            \DB::rollBack();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function confirmDelete(Request $request, Periodicidad $periodicidad)
    {
        try {

            return view('serviciosescolares.periodicidades.confirmDelete',compact('periodicidad'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function delete(Request $request, Periodicidad $periodicidad)
    {
        if (!$periodicidad->delete())
        {
            flash('No se pudo eliminar la periodicidad')->warning();

            return redirect()->to(route('periodicidades.edit',$periodicidad->id));
        }

        flash('El registro se eliminó correctamente')->success();

        return redirect()->to(route('periodicidades.index'));
    }
}
