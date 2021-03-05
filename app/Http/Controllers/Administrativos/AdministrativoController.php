<?php

namespace App\Http\Controllers\Administrativos;

use App\Models\Alumno;
use App\Models\Domicilio;
use App\Models\Referencia;
use Auth;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Localidad;
use App\Models\Entidad;
use App\Models\NecesidadEducativa;
use App\Models\Idioma;
use App\Models\EsExtranjero;
use App\Models\EsIndigena;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Ramsey\Uuid\Uuid;
use Validator;

class AdministrativoController extends Controller
{
    public function index(Request $request)
    {
        try {

            $administrativos = Persona::with(['paises','entidades']);

            $administrativos->where('tipo_registro','ADMINISTRATIVO');

            if ($request->has('rfc') and !empty($request->get('rfc'))):
                $administrativos->where('rfc', 'LIKE', '%' . $request->get('rfc') . '%');
            endif;

            if ($request->has('curp') and !empty($request->get('curp'))):
                $administrativos->where('curp', 'LIKE', '%' . $request->get('curp') . '%');
            endif;

            if ($request->has('nombre_completo') and !empty($request->get('nombre_completo'))):
                $administrativos->where('nombre_completo', 'LIKE', '%' . str_replace(' ','%',$request->get('nombre_completo')) . '%');
            endif;

            $administrativos = $administrativos->orderBy('created_at', 'DESC')->paginate(100);

            return view('administrativos.index', compact('administrativos'));

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function edit(Request $request,Persona $persona)
    {
        try
        {
            $paises                 = Pais::all()->pluck('descripcion', 'id');
            $entidades              = Entidad::all()->pluck('fullName', 'id');
            $necesidades_educativas = NecesidadEducativa::all()->pluck('descripcion','id');
            $idiomas                = Idioma::all()->pluck('descripcion','id');
            $es_extranjero_array    = EsExtranjero::all()->pluck('descripcion','id');
            $es_indigena_array      = EsIndigena::all()->pluck('descripcion','id');

            $contador = 1;
            foreach ($persona->referencias as $referencia)
            {
                $arreglo_referencias[$contador] = $referencia;
                $contador++;
            }

            return view('administrativos.edit' ,compact('persona','arreglo_referencias','paises','entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function update(Request $request, Persona $persona)
    {
        try
        {
            \DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                "fecha_nacimiento" => [ 'required', 'date' ],
                "curp" => [ 'required', 'regex:/([A-Z|a-z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM|hm](AS|as|BC|bc|BS|bs|CC|cc|CL|cl|CM|cm|CS|cs|CH|ch|DF|df|DG|dg|GT|gt|GR|gr|HG|hg|JC|jc|MC|mc|MN|mn|MS|ms|NT|nt|NL|nl|OC|oc|PL|pl|QT|qt|QR|qr|SP|sp|SL|sl|SR|sr|TC|tc|TS|ts|TL|tl|VZ|vz|YN|yn|ZS|zs|NE|ne)[A-Z|a-z]{3})/' ],
                "nombre"             => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                "primer_apellido"    => [ 'required', 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
                "segundo_apellido"   => [ 'regex:/^[a-zA-Z\s\á\Á\é\É\í\Í\ó\Ó\ú\ÚÑñüÜçêõóôãâ.\´\'\-]{1,}$/' ],
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!$persona->update($request->input())) {
                flash('Los datos no se pudieron actualizar.')->warning();
                return redirect()->back();
            }

            flash('Los datos se actualizaron correctamente')->success();

            \DB::commit();

            return redirect()->back();
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
