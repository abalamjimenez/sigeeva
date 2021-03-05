<?php

namespace App\Http\Controllers\Docentes;

use App\Group;
use App\Http\Controllers\Controller;
use App\Models\AsignaturaGrupo;
use App\Models\Entidad;
use App\Models\EsExtranjero;
use App\Models\EsIndigena;
use App\Models\Idioma;
use App\Models\NecesidadEducativa;
use App\Models\Pais;
use App\Models\PeriodoEscolar;
use App\Models\Persona;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        try {

            $nombre_completo = $request->get('nombre_completo');
            $curp            = $request->get('curp');
            $rfc             = $request->get('rfc');

            $docentes = Persona::with(['paises','entidades']);

            $docentes->where('tipo_registro','DOCENTE');

            if ($request->has('rfc') and !empty($request->get('rfc'))):
                $docentes->where('rfc', 'LIKE', '%' . $request->get('rfc') . '%');
            endif;

            if ($request->has('curp') and !empty($request->get('curp'))):
                $docentes->where('curp', 'LIKE', '%' . $request->get('curp') . '%');
            endif;

            if ($request->has('nombre_completo') and !empty($request->get('nombre_completo'))):
                $docentes->where('nombre_completo', 'LIKE', '%' . str_replace(' ','%',$request->get('nombre_completo')) . '%');
            endif;

            $docentes = $docentes->orderBy('created_at', 'DESC')->paginate(100);

            return view('docentes.index', compact('docentes'));

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

            return view('docentes.edit' ,compact('persona','arreglo_referencias','paises','entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
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

    public function create()
    {
        try
        {
            $paises                 = Pais::all()->pluck('descripcion', 'id');
            $entidades              = Entidad::all()->pluck('fullName', 'id');
            $necesidades_educativas = NecesidadEducativa::all()->pluck('descripcion','id');
            $idiomas                = Idioma::all()->pluck('descripcion','id');
            $es_extranjero_array    = EsExtranjero::all()->pluck('descripcion','id');
            $es_indigena_array      = EsIndigena::all()->pluck('descripcion','id');

            return view('docentes.create' ,compact('paises','entidades','necesidades_educativas','idiomas','es_extranjero_array','es_indigena_array'));
        }
        catch (\Exception $e) {

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function store(Request $request)
    {
        try
        {
            \DB::beginTransaction();

            $persona = new Persona();
            $persona->rfc                     = $request->input('rfc');
            $persona->curp                    = $request->input('curp');
            $persona->fecha_nacimiento        = $request->input('fecha_nacimiento');
            $persona->telefono                = $request->input('telefono');
            $persona->email                   = $request->input('email');
            $persona->nombre                  = $request->input('nombre');
            $persona->primer_apellido         = $request->input('primer_apellido');
            $persona->segundo_apellido        = $request->input('segundo_apellido');
            $persona->sexo                    = $request->input('sexo');
            $persona->entidad_nacimiento_id   = $request->input('entidad_nacimiento_id');
            $persona->pais_nacimiento_id      = $request->input('pais_nacimiento_id');
            $persona->idioma_id               = $request->input('idioma_id');
            $persona->es_indigena_id          = $request->input('es_indigena_id');
            $persona->es_extranjero_id        = $request->input('es_extranjero_id');
            $persona->numero_seguridad_social = $request->input('numero_seguridad_social');
            $persona->tipo_registro           = 'DOCENTE';
            $persona->save();

            $miUsuario = new User([
                'username' => $request->input('rfc'),
                'email'    => $request->input('rfc').'@evasamano.edu.mx',
                'password' => bcrypt($request->input('rfc')),
                'active'   => true
            ]);

            $persona->usuario()->save($miUsuario);

            $group = Group::where('descripcion','docente')->first();

            $miUsuario->groups()->save($group);

            \DB::commit();

            return redirect()->to(route('docentes.index'));
        }
        catch (\Exception $e) {

            \DB::rollback();

            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }

    public function gruposAsignados(Request $request)
    {
        try
        {
            // O B T E N E R   E L   P E R I O D O   A C T I V O
            $periodoEscolar = PeriodoEscolar::where('vigente','=','S')->first();


            $persona = Persona::find(Auth()->user()->id);

            $query = AsignaturaGrupo::query();

            $gruposAsignados = $query->selectRaw('
                    asignatura_grupo.id AS asignatura_grupo_id,
                    asignatura_grupo.uuid AS asignatura_grupo_uuid,
                    asi.abreviacion AS asignatura_abreviacion,
                    asi.descripcion AS asignatura_descripcion,
                    grupo.descripcion AS grupo_descripcion,
                    carrera.descripcion AS carrera_descripcion,
                    grado.numero AS semestre,
                    turno.descripcion AS turno_descripcion')
                ->join('sigeeva.asignaturas AS asi','asi.id','=','asignatura_grupo.asignatura_id')
                ->join('sigeeva.grupos AS grupo','grupo.id','=','asignatura_grupo.grupo_id')
                ->join('sigeeva.carreras AS carrera','carrera.id','=','grupo.carrera_id')
                ->join('sigeeva.grados AS grado','grado.id','=','grupo.grado_id')
                ->join('sigeeva.turnos AS turno','turno.id','=','grupo.turno_id')
                ->where('asignatura_grupo.persona_id',Auth()->user()->id)
                ->where('grupo.periodo_escolar_id',$periodoEscolar->id)
                ->orderBy('turno.id','ASC')
                ->orderBy('grado.numero','ASC')
                ->orderBy('asi.abreviacion','ASC')
                ->orderBy('carrera.descripcion','ASC')
                ->get();

            return view('docentes.gruposAsignados',compact('gruposAsignados','persona'));

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
