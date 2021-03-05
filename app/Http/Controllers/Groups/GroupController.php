<?php

namespace App\Http\Controllers\Groups;

use App\Group;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Ramsey\Uuid\Uuid;
use Validator;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $qry = Group::query();

            $registros = $qry->selectRaw("
            groups.id,groups.descripcion,count(*) AS total
            ")
            ->join('sigeeva.group_user','group_user.group_id','=','groups.id')
            ->groupBy('groups.id')->paginate(50);

            return view('groups.index', compact('registros'));

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage() . $e->getLine() . $e->getFile());
        }
    }
}
