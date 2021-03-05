<?php

namespace App\Http\Controllers\API;

use App\Models\AsignaturaHorario;
use App\Models\CalificacionGrupo;
use App\Models\CalificacionGrupoExpediente;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;



class GroupController extends Controller
{
    public function index(Request $request)
    {
        $qry = GroupUser::query();

        $asignaciones = $qry->selectRaw("
        users.username,
        users.email AS correo_institucional,
        personas.email AS correo_personal,
        personas.nombre_completo
        ")
        ->join('sigeeva.users','users.id','=','group_user.user_id')
        ->join('sigeeva.personas','personas.id','=','users.userable_id')
        ->where('group_user.group_id','=',$request->get('registro_id'))
        ->where('users.userable_type','LIKE','%Persona')
        ->get();

        return response()->json(compact('asignaciones'));
    }
}
