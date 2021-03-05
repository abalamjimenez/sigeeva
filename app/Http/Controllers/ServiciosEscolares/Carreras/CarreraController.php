<?php

namespace App\Http\Controllers\ServiciosEscolares\Carreras;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\CarreraTitulo;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index(Request $request)
    {
        try {
            $carreras = Carrera::paginate(100);

            return view('serviciosescolares.carreras.index',compact('carreras'));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function edit(Request $request, Carrera $carrera)
    {
        try {

            $titulo_hombre = '';
            $titulo_mujer = '';
            foreach($carrera->titulos AS $titulo)
            {
                if ($titulo->sexo=='H')
                {
                    $titulo_hombre = $titulo->titulo;
                }
                else if ($titulo->sexo == 'M')
                {
                    $titulo_mujer = $titulo->titulo;
                }
            }

            return view('serviciosescolares.carreras.edit',compact('carrera','titulo_hombre','titulo_mujer'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function update(Request $request, Carrera $carrera)
    {
        try
        {
            \DB::beginTransaction();

            $carrera->update([
                'clave_federal' => $request->post('clave_federal'),
                'abreviacion'   => $request->post('abreviacion'),
                'descripcion'   => $request->post('descripcion')
            ]);

            CarreraTitulo::updateOrCreate(
                [ 'sexo' => 'H', 'carrera_id' => $carrera->id ],
                [ 'titulo' => $request->post('titulo_hombre') ]
            );

            CarreraTitulo::updateOrCreate(
                [ 'sexo' => 'M', 'carrera_id' => $carrera->id ],
                [ 'titulo' => $request->post('titulo_mujer') ]
            );

            \DB::commit();

            flash('Los datos se registraron satisfactoriamente')->success();

            return redirect()->to(route('carreras.edit',$carrera->id));
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
            return view('serviciosescolares.carreras.create');
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

            $carrera = new Carrera();
            $carrera->clave_federal = $request->post('clave_federal');
            $carrera->abreviacion   = $request->post('abreviacion');
            $carrera->descripcion   = $request->post('descripcion');
            $carrera->save();

            $titulo_hombre = new CarreraTitulo([
                'titulo' => $request->post('titulo_hombre'),
                'sexo'   => 'H'
            ]);

            $titulo_mujer = new CarreraTitulo([
                'titulo' => $request->post('titulo_mujer'),
                'sexo'   => 'M'
            ]);

            $carrera->titulos()->saveMany([$titulo_hombre,$titulo_mujer]);

            \DB::commit();

            flash('Los datos se registraron satisfactoriamente')->success();

            return redirect()->to(route('carreras.edit',$carrera->id));
        }
        catch (\Exception $e)
        {
            \DB::rollBack();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function confirmDelete(Request $request, Carrera $carrera)
    {
        try {

            $titulo_hombre = '';
            $titulo_mujer = '';
            foreach($carrera->titulos AS $titulo)
            {
                if ($titulo->sexo=='H')
                {
                    $titulo_hombre = $titulo->titulo;
                }
                else if ($titulo->sexo == 'M')
                {
                    $titulo_mujer = $titulo->titulo;
                }
            }

            return view('serviciosescolares.carreras.confirmDelete',compact('carrera','titulo_hombre','titulo_mujer'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function delete(Request $request, Carrera $carrera)
    {
        try
        {
            \DB::beginTransaction();

            if (!$carrera->delete())
            {
                flash('No se pudo eliminar la carrera')->warning();

                return redirect()->to(route('carreras.edit',$carrera->id));
            }

            flash('El registro se eliminó correctamente')->success();

            \DB::commit();

            return redirect()->to(route('carreras.index'));
        }
        catch (\Exception $e) {

            \DB::rollBack();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
