<?php

namespace App\Http\Controllers;

use App\Group;
use App\Models\Domicilio;
use App\Models\Expediente;
use App\Models\Grupo;
use App\Models\Localidad;
use App\Models\PeriodoEscolar;
use App\Models\Solicitud;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $periodoEscolar = PeriodoEscolar::where('vigente','=','S')->first();

        $grupos = Grupo::where('periodo_escolar_id','=',$periodoEscolar->id)->pluck('clave','id');

        if ($request->has('grupo_id') and !empty($request->get('grupo_id')))
        {
            $qry = User::query();

            $usuarios = $qry->selectRaw("
            users.uuid,users.username,users.last_login_at,users.active,
            users.email AS correo_institucional,
            if (users.correo_institucional_validado=1,'SI','NO') AS correo_institucional_validado,
            personas.tipo_registro,personas.nombre_completo,personas.curp,personas.rfc,
            personas.email AS correo_personal
            ")
            ->join('sigeeva.personas','personas.id','=','users.userable_id')
            ->join('sigeeva.alumnos','alumnos.persona_id','=','personas.id')
            ->join('sigeeva.expedientes','expedientes.alumno_id','=','alumnos.id')
            ->where('users.userable_type','like','%Persona')
            ->where('expedientes.grupo_id',$request->get('grupo_id'))
            ->get();

            return view('usuarios.indexByGroup',compact('usuarios','grupos'));
        }
        else
        {
            $usuarios = User::with(['userable']);

            $curp            = $request->get('curp');
            $tipo_registro   = $request->get('tipo_registro');
            $nombre_completo = $request->get('nombre_completo');

            if ($request->has('username') and !empty($request->get('username'))):
                $usuarios->where('username', '=',  $request->get('username') );
            endif;

            if ($request->has('curp') and !empty($request->get('curp'))):
                $usuarios->whereHasMorph('userable',['App\Models\Persona'], function ($query) use ($curp){
                    $query->where('curp','=',$curp);
                });
            endif;

            if ($request->has('tipo_registro') and !empty($request->get('tipo_registro'))):
                $usuarios->whereHasMorph('userable',['App\Models\Persona'], function ($query) use ($tipo_registro){
                    $query->where('tipo_registro','=',$tipo_registro);
                });
            endif;

            if ($request->has('nombre_completo') and !empty($request->get('nombre_completo'))):
                $usuarios->whereHasMorph('userable',['App\Models\Persona'], function ($query) use ($nombre_completo){
                    $query->where('nombre_completo','LIKE','%'.str_replace(' ','%',$nombre_completo).'%');
                });
            endif;

            $usuarios = $usuarios->orderBy('username')->paginate(100);

            return view('usuarios.index',compact('usuarios','grupos'));
        }
    }

    public function edit($usuario)
    {
        if (request()->ajax())
        {
            $data = User::findOrFail($usuario);

            return response()->json(['result'=>$data]);
        }
    }

    public function usersList(Request $request)
    {
        if ($request->ajax())
        {
            $users = \DB::table('users')->select("*");

            return DataTables::of($users)
                ->addColumn('action', function ($data){
                    $button = '<button type="button" style="margin-left:1em"
                              name="edit" id="'.$data->id.'"
                              class="edit btn btn-primary btn-sm">
                              Edit</button>';

                    $button.= '<button type="button" style="margin-left:1em"
                                name="edit" id="'.$data->id.'"
                                class="delete btn btn-danger btn-sm">Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = array(
            //'name' => ['required', 'string', 'max:180'],
            'username' => ['required', 'string', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails())
        {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        $form_data = array(
            //'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        );

        User::create($form_data);

        return response()->json(['success'=> 'Registro agregado satisfactoriamente']);
    }

    public function update(Request $request)
    {
        $rules = array(
            //'name' => ['required', 'string', 'max:180'],
            'username' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:4', 'confirmed'],
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails())
        {
            return response()->json(['errors'=> $error->errors()->all()]);
        }

        $form_data = array(
            //'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email
            //'password' => Hash::make($request->password),
        );

        User::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success'=>'Cambios realizados satisfactoriamente']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function cambiarClaveAcceso(Request $request,User $user)
    {
        return view('usuarios.cambiar_clave_acceso', compact('user'));
    }

    public function updateClaveAcceso(Request $request,User $user)
    {
        $user->password = bcrypt($request->input('password'));
        $user->save();

        flash('La contraseña se actualizó correctamente')->success();

        return redirect()->back();
    }

    public function editarAccesos(Request $request,User $user)
    {
        $query = Group::query();

        $accesos = $query->selectRaw("
            groups.id,groups.descripcion,group_user.user_id
        ")
        ->leftJoin('sigeeva.group_user', function ($join) use ($user){
            $join->on('group_user.group_id','=','groups.id')
                ->on('group_user.user_id','=',\DB::raw($user->id) );
        })
        ->get();

        return view('usuarios.editar_accesos', compact('user','accesos'));
    }

    public function actualizarAccesos(Request $request,User $user)
    {
        $user->groups()->sync($request->input('permiso'));

        flash('Permisos actualizados satisfactoriamente')->success();

        return redirect()->back();
    }

    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    //
    // A C T U A L I Z A R   U S U A R I O   R E G I S T R A D O
    //
    //                    C O N T R A S E Ñ A
    //
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function editarMiPassword()
    {
        $user = currentUser();

        $persona = $user->userable;

        return view('usuarios.editarMiPassword', compact('user','persona'));
    }

    public function updateMiPassword(Request $request, User $user)
    {
        $rules    = [
            'password' => 'required|confirmed|min:6',
        ];
        $messages = [
            'min' => 'La contraseña debe contener al menos 6 caracteres [A-Za-z0-9] ',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user->password = bcrypt($request->input('password'));
        $user->save();

        flash('La contraseña se actualizó correctamente')->success();

        return redirect()->back();
    }

    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    //
    // A C T U A L I Z A R   U S U A R I O   R E G I S T R A D O
    //
    //                        P E R F I L
    //
    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function editarMiPerfil()
    {
        $localidades = Localidad::othonpblanco()->get()->pluck('descripcion','id');

        $user = currentUser();

        $domicilio = new Domicilio();
        if ($user->userable->domicilios()->count()>0 )
        {
            $domicilio = $user->userable->domicilios()->first();
        }

        $persona = $user->userable;

        return view('usuarios.editarMiPerfil', compact('user','persona','domicilio','localidades'));
    }

    public function updateMiPerfil(Request $request, User $user)
    {
        $rules    = [
            'domicilio_codigo_postal' => 'required|numeric|digits:5',
        ];
        $messages = [
            'domicilio_codigo_postal.required' => 'El código postal es requerido',
            'domicilio_codigo_postal.numeric'  => 'El código postal debe ser numérico',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!empty( $request->get('numero_seguridad_social')) AND strlen($request->get('numero_seguridad_social')) > 11)
        {
            return back()
                ->withErrors(['tutor_domicilio_codigo_postal' => ['El número de seguridad social debe ser máximo de 11 caracteres']])
                ->withInput();
        }







        if ($user->userable->domicilios()->count()>0 )
        {
            $user->userable->domicilios()->update([
                'domicilio_calle'           => $request->input('domicilio_calle'),
                'domicilio_numero_exterior' => $request->input('domicilio_numero_exterior'),
                'domicilio_colonia'         => $request->input('domicilio_colonia'),
                'domicilio_codigo_postal'   => $request->input('domicilio_codigo_postal'),
                'domicilio_localidad_id'    => $request->input('domicilio_localidad_id')
            ]);
        }
        else
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

            $user->userable->domicilios()->save($domicilio_personal);
        }

        $user->update(array(
            'cuenta_validada' => 'S'
        ));


        $user->userable()->update(array(
            'email'                   => $request->input('correo_personal'),
            'telefono'                => $request->input('telefono'),
            'numero_seguridad_social' => $request->input('numero_seguridad_social'),
            'fecha_nacimiento'        => $request->input('fecha_nacimiento')
        ));

        flash('Los datos se actualizaron correctamente')->success();

        return redirect()->back();
    }

    //
    public function accesosDocentes(Request $request)
    {
        $query = User::query();

        $ultimosAccesos = $query->selectRaw("
            personas.nombre_completo,users.username,users.last_login_at
        ")
        ->join('sigeeva.personas','personas.id','=','users.userable_id')
        ->where('users.userable_type','LIKE','%Persona')
        ->where('personas.tipo_registro','=','DOCENTE')
        ->orderBy('users.last_login_at','DESC')
        ->get();

        return view('usuarios.accesosDocentes', compact('ultimosAccesos'));
    }

    public function accesosAlumnos(Request $request)
    {
        $query = User::query();

        $ultimosAccesos = $query->selectRaw("
            personas.nombre_completo,users.username,users.last_login_at
        ")
            ->join('sigeeva.personas','personas.id','=','users.userable_id')
            ->where('users.userable_type','LIKE','%Persona')
            ->where('personas.tipo_registro','=','ALUMNO')
            ->orderBy('users.last_login_at','DESC')
            ->get();

        return view('usuarios.accesosAlumnos', compact('ultimosAccesos'));
    }

    public function accesosAdministrativos(Request $request)
    {
        $query = User::query();

        $ultimosAccesos = $query->selectRaw("
            personas.nombre_completo,users.username,users.last_login_at
        ")
        ->join('sigeeva.personas','personas.id','=','users.userable_id')
        ->where('users.userable_type','LIKE','%Persona')
        ->where('personas.tipo_registro','=','ADMINISTRATIVO')
        ->orderBy('users.last_login_at','DESC')
        ->get();

        return view('usuarios.accesosAdministrativos', compact('ultimosAccesos'));
    }

    public function estadisticas()
    {
        $query = User::query();

        $usuarios = $query->selectRaw("
            SUM(if (users.correo_automatico_enviado='S',1,0)) AS correo_automatico_enviado_count_s,
            SUM(if (users.correo_manual_enviado='S',1,0)) AS correo_manual_enviado_count_s,
            SUM(if (users.cuenta_validada='S',1,0)) AS cuenta_validada_count_s,
            SUM(if (users.cuenta_validada='N',1,0)) AS cuenta_validada_count_n
        ")
        ->join('sigeeva.personas', function ($join) {
            $join->on('personas.id','=','users.userable_id')
                ->where('personas.tipo_registro','=','ALUMNO');
        })
        ->where('users.userable_type','LIKE','%Persona')
        ->first();




        $query = Solicitud::query();

        $solicitudes = $query->selectRaw("
        SUM(if (solicitudes.estatus_solicitud_id=1,1,0)) AS solicitudes_en_borrador,
        SUM(if (solicitudes.estatus_solicitud_id=2,1,0)) AS solicitudes_rechazadas,
        SUM(if (solicitudes.estatus_solicitud_id=3,1,0)) AS solicitudes_enviadas,
        SUM(if (solicitudes.estatus_solicitud_id=4,1,0)) AS solicitudes_validadas,
        SUM(if (solicitudes.estatus_solicitud_id=5,1,0)) AS solicitudes_en_revision,
        SUM(if (solicitudes.estatus_solicitud_id=6,1,0)) AS solicitudes_procesadas,
        SUM(if (solicitudes.estatus_solicitud_id=7,1,0)) AS solicitudes_aplicadas,

        SUM(if (solicitudes.estatus_solicitud_id=1 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_en_borrador_1,
        SUM(if (solicitudes.estatus_solicitud_id=1 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_en_borrador_3,
        SUM(if (solicitudes.estatus_solicitud_id=1 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_en_borrador_5,

        SUM(if (solicitudes.estatus_solicitud_id=2 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_rechazadas_1,
        SUM(if (solicitudes.estatus_solicitud_id=2 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_rechazadas_3,
        SUM(if (solicitudes.estatus_solicitud_id=2 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_rechazadas_5,

        SUM(if (solicitudes.estatus_solicitud_id=3 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_enviadas_1,
        SUM(if (solicitudes.estatus_solicitud_id=3 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_enviadas_3,
        SUM(if (solicitudes.estatus_solicitud_id=3 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_enviadas_5,

        SUM(if (solicitudes.estatus_solicitud_id=4 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_validadas_1,
        SUM(if (solicitudes.estatus_solicitud_id=4 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_validadas_3,
        SUM(if (solicitudes.estatus_solicitud_id=4 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_validadas_5,

        SUM(if (solicitudes.estatus_solicitud_id=5 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_en_revision_1,
        SUM(if (solicitudes.estatus_solicitud_id=5 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_en_revision_3,
        SUM(if (solicitudes.estatus_solicitud_id=5 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_en_revision_5,

        SUM(if (solicitudes.estatus_solicitud_id=6 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_procesadas_1,
        SUM(if (solicitudes.estatus_solicitud_id=6 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_procesadas_3,
        SUM(if (solicitudes.estatus_solicitud_id=6 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_procesadas_5,

        SUM(if (solicitudes.estatus_solicitud_id=7 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_aplicadas_1,
        SUM(if (solicitudes.estatus_solicitud_id=7 AND solicitudes.grado_id = 3,1,0)) AS solicitudes_aplicadas_3,
        SUM(if (solicitudes.estatus_solicitud_id=7 AND solicitudes.grado_id = 5,1,0)) AS solicitudes_aplicadas_5,


        SUM(if (solicitudes.estatus_solicitud_id=1 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_pendientes_nuevo_ingreso,
        SUM(if (solicitudes.estatus_solicitud_id=2 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_rechazadas_nuevo_ingreso,
        SUM(if (solicitudes.estatus_solicitud_id=3 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_enviadas_nuevo_ingreso,
        SUM(if (solicitudes.estatus_solicitud_id=4 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_validadas_nuevo_ingreso,
        SUM(if (solicitudes.estatus_solicitud_id=5 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_en_revision_nuevo_ingreso,
        SUM(if (solicitudes.estatus_solicitud_id=6 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_procesadas_nuevo_ingreso,
        SUM(if (solicitudes.estatus_solicitud_id=7 AND solicitudes.grado_id = 1,1,0)) AS solicitudes_aplicadas_nuevo_ingreso,


        SUM(if (solicitudes.estatus_solicitud_id=1 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_pendientes_nuevo_ingreso_curp,
        SUM(if (solicitudes.estatus_solicitud_id=2 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_rechazadas_nuevo_ingreso_curp,
        SUM(if (solicitudes.estatus_solicitud_id=3 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_enviadas_nuevo_ingreso_curp,
        SUM(if (solicitudes.estatus_solicitud_id=4 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_validadas_nuevo_ingreso_curp,
        SUM(if (solicitudes.estatus_solicitud_id=5 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_en_revision_nuevo_ingreso_curp,
        SUM(if (solicitudes.estatus_solicitud_id=6 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_procesadas_nuevo_ingreso_curp,
        SUM(if (solicitudes.estatus_solicitud_id=7 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO',1,0)) AS solicitudes_aplicadas_nuevo_ingreso_curp,

        SUM(if (solicitudes.estatus_solicitud_id=1 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_pendientes_nuevo_ingreso_folio,
        SUM(if (solicitudes.estatus_solicitud_id=2 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_rechazadas_nuevo_ingreso_folio,
        SUM(if (solicitudes.estatus_solicitud_id=3 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_enviadas_nuevo_ingreso_folio,
        SUM(if (solicitudes.estatus_solicitud_id=4 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_validadas_nuevo_ingreso_folio,
        SUM(if (solicitudes.estatus_solicitud_id=5 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_en_revision_nuevo_ingreso_folio,
        SUM(if (solicitudes.estatus_solicitud_id=6 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_procesadas_nuevo_ingreso_folio,
        SUM(if (solicitudes.estatus_solicitud_id=7 AND solicitudes.grado_id = 1 AND solicitudes.tipo_solicitud = 'NUEVO_INGRESO_PAENMS',1,0)) AS solicitudes_aplicadas_nuevo_ingreso_folio
        ")->first();

        return view('usuarios.estadisticas',
            compact(
                'usuarios',
                'solicitudes'
            )
        );
    }

    public function editarDatos(Request $request,User $user)
    {
        $persona = $user->userable;

        return view('usuarios.editarDatos', compact('user','persona'));
    }

    public function updateDatos(Request $request,User $user)
    {
        $correo_institucional_validado = 0;
        if ($request->input('correo_institucional_validado') == 1)
            $correo_institucional_validado = $request->input('correo_institucional_validado');

        $user->email                         = $request->input('correo_institucional');
        $user->correo_institucional_validado = $correo_institucional_validado;
        $user->save();

        $user->userable()->update(array(
            'email'    => $request->input('correo_personal'),
            'telefono' => $request->input('telefono'),
        ));

        flash('Los datos se actualizaron correctamente')->success();

        return redirect()->back();
    }
}
