<?php

namespace App\Http\Controllers\Personas;

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

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        try {

            $registradas = Persona::with(['paises','entidades']);

            $registradas->where('tipo_registro','ALUMNO');

            if ($request->has('curp') and !empty($request->get('curp'))):
                $registradas->where('curp', 'LIKE', '%' . $request->get('curp') . '%');
            endif;

            if ($request->has('nombre') and !empty($request->get('nombre'))):
                $registradas->where('nombre_completo', 'LIKE', '%' . $request->get('nombre') . '%');
            endif;

            $registradas = $registradas->orderBy('created_at', 'DESC')->paginate(100);

            return view('personas.index', compact('registradas'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function create()
    {
        try {
            $entidades = Entidad::all()->pluck('fullName', 'id');
            $paises = Pais::all()->pluck('descripcion', 'id');
            $necesidades_educativas = NecesidadEducativa::all()->pluck('descripcion','id');
            $idiomas = Idioma::all()->pluck('descripcion','id');
            $es_extranjero_array = EsExtranjero::all()->pluck('descripcion','id');
            $es_indigena_array = EsIndigena::all()->pluck('descripcion','id');

            return view('personas.create', compact('paises', 'entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function store(Request $request)
    {
        try {

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

            $usuario = Auth::user()->id;

            // GUARDAMOS LOS DATOS DE LA PERSONA

                $persona = Persona::firstOrNew([
                    'curp' => $request->get('curp'),
                    'nombre' => $request->get('nombre'),
                    'primer_apellido' => $request->get('primer_apellido'),
                    'fecha_nacimiento' => $request->get('fecha_nacimiento')
                ]);

                $persona->fill($request->except('_token', 'guardar'));
                $persona->nombre_completo = sprintf('%s %s %s', $request->get('nombre'), $request->get('primer_apellido'), $request->get('segundo_apellido'));
                $persona->tipo_registro = 'ALUMNO'; // 'ALUMNO','PERSONAL'

                if (isset($persona->id) and $persona->id):
                    $persona->updated_by = $usuario;
                else:
                    $persona->created_by = $usuario;
                endif;

                $persona->save();

            \DB::commit();

            if ($request->get('guardar') == 'true') {
                flash('Los datos se registraron satisfactoriamente')->success();

                return redirect()->to(route('personas.edit',$persona));
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function edit(Request $request,Persona $persona)
    {
        try
        {
            $paises = Pais::all()->pluck('descripcion', 'id');
            $entidades = Entidad::all()->pluck('fullName', 'id');
            $necesidades_educativas = NecesidadEducativa::all()->pluck('descripcion','id');
            $idiomas = Idioma::all()->pluck('descripcion','id');
            $es_extranjero_array = EsExtranjero::all()->pluck('descripcion','id');
            $es_indigena_array = EsIndigena::all()->pluck('descripcion','id');

            $contador = 1;
            foreach ($persona->referencias as $referencia)
            {
                $arreglo_referencias[$contador] = $referencia;
                $contador++;
            }

            return view('personas.edit' ,compact('persona','arreglo_referencias','paises','entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
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

    public function editarTutor(Request $request,Persona $persona)
    {
        $referencia = new Referencia();
        if ($persona->referencias()->count() > 0)
            $referencia = $persona->referencias[0];

        $localidades = Localidad::othonpblanco()->get()->pluck('descripcion','id');

        $domicilios = Domicilio::where('domiciliable_type','App\models\Referencia')
            ->where('domiciliable_id',$referencia->id)
            ->get();

        foreach ($domicilios AS $domicilio)
        {
            if ($domicilio->domicilio_tipo == 'PERSONAL')
            {
                $referencia->domicilio_calle           = $domicilio->domicilio_calle;
                $referencia->domicilio_numero_exterior = $domicilio->domicilio_numero_exterior;
                $referencia->domicilio_colonia         = $domicilio->domicilio_colonia;
                $referencia->domicilio_codigo_postal   = $domicilio->domicilio_codigo_postal;
                $referencia->domicilio_localidad_id    = $domicilio->domicilio_localidad_id;
            }
            else if ($domicilio->domicilio_tipo == 'TRABAJO')
            {
                $referencia->domicilio_trabajo_calle           = $domicilio->domicilio_calle;
                $referencia->domicilio_trabajo_numero_exterior = $domicilio->domicilio_numero_exterior;
                $referencia->domicilio_trabajo_colonia         = $domicilio->domicilio_colonia;
                $referencia->domicilio_trabajo_codigo_postal   = $domicilio->domicilio_codigo_postal;
                $referencia->domicilio_trabajo_localidad_id    = $domicilio->domicilio_localidad_id;
            }
        }

        return view('personas.editartutor',compact('persona','referencia','localidades'));
    }

    public function storeTutor(Request $request,Persona $persona)
    {
        try {
            \DB::beginTransaction();

            if (empty($request->input('id')))
                $referencia = new Referencia;
            else
                $referencia = Referencia::find($request->input('id'));

            $referencia->uuid             = Uuid::uuid4()->toString();
            $referencia->nombre           = $request->input('nombre');
            $referencia->primer_apellido  = $request->input('primer_apellido');
            $referencia->segundo_apellido = $request->input('segundo_apellido');
            $referencia->curp             = $request->input('curp');
            $referencia->telefono         = $request->input('telefono');
            $referencia->email            = $request->input('email');
            $referencia->save();

            //Si esta vacio el id es que es la primera vez que se esta guardando
            //Entonces hay que agregarlo en la relacion de muchos a muchos
            if (empty($request->input('id')))
            {
                $persona->referencias()->attach($referencia->id);
            }

            $existe_domicilio_personal = Domicilio::where('domiciliable_type', 'App\models\Referencia')
                ->where('domiciliable_id', $referencia->id)
                ->where('domicilio_tipo','PERSONAL')
                ->first();

            if ($existe_domicilio_personal == NULL)
            {
                $domicilio_personal = new Domicilio([
                        'domicilio_tipo'            => 'PERSONAL',
                        'domicilio_calle'           => $request->input('domicilio_calle'),
                        'domicilio_numero_exterior' => $request->input('domicilio_numero_exterior'),
                        'domicilio_colonia'         => $request->input('domicilio_colonia'),
                        'domicilio_codigo_postal'   => $request->input('domicilio_codigo_postal'),
                        'domicilio_localidad_id'    => $request->input('domicilio_localidad_id')
                    ]
                );

                $referencia->domicilios()->save($domicilio_personal);
            }
            else
            {
                $existe_domicilio_personal->update([
                    'domicilio_calle'           => $request->input('domicilio_calle'),
                    'domicilio_numero_exterior' => $request->input('domicilio_numero_exterior'),
                    'domicilio_colonia'         => $request->input('domicilio_colonia'),
                    'domicilio_codigo_postal'   => $request->input('domicilio_codigo_postal'),
                    'domicilio_localidad_id'    => $request->input('domicilio_localidad_id')
                ]);
            }

            $existe_domicilio_trabajo = Domicilio::where('domiciliable_type', 'App\models\Referencia')
                ->where('domiciliable_id', $referencia->id)
                ->where('domicilio_tipo','TRABAJO')
                ->first();

            if ($existe_domicilio_trabajo ==  NULL)
            {
                $domicilio_trabajo = new Domicilio([
                        'domicilio_tipo'            => 'TRABAJO',
                        'domicilio_calle'           => $request->input('domicilio_trabajo_calle'),
                        'domicilio_numero_exterior' => $request->input('domicilio_trabajo_numero_exterior'),
                        'domicilio_colonia'         => $request->input('domicilio_trabajo_colonia'),
                        'domicilio_codigo_postal'   => $request->input('domicilio_trabajo_codigo_postal'),
                        'domicilio_localidad_id'    => $request->input('domicilio_trabajo_localidad_id')
                    ]
                );

                $referencia->domicilios()->save($domicilio_trabajo);
            }
            else
            {
                $existe_domicilio_trabajo->update([
                    'domicilio_calle'           => $request->input('domicilio_trabajo_calle'),
                    'domicilio_numero_exterior' => $request->input('domicilio_trabajo_numero_exterior'),
                    'domicilio_colonia'         => $request->input('domicilio_trabajo_colonia'),
                    'domicilio_codigo_postal'   => $request->input('domicilio_trabajo_codigo_postal'),
                    'domicilio_localidad_id'    => $request->input('domicilio_trabajo_localidad_id')
                ]);
            }


            \DB::commit();

            if ($request->get('guardar') == 'true')
            {
                flash('Los datos se registraron satisfactoriamente')->success();

                return redirect()->to(route('personas.editarTutor',$persona->uuid));
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function editarAlumno(Request $request,Persona $persona)
    {
        $localidades = Localidad::othonpblanco()->get()->pluck('descripcion','id');


        $alumno = Alumno::where('persona_id',$persona->id)->first();

        if ($alumno == null)
            $alumno = new Alumno();

        return view('personas.editaralumno',compact('persona','alumno','localidades'));
    }
}
