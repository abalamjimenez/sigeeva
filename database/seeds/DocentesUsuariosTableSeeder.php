<?php

use App\Models\Persona;
use App\User;
use App\Group;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DocentesUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docentes = \DB::connection('mysql')->table('temp_listado_docentes')->get();

        foreach ($docentes AS $docente)
        {
            $persona = new Persona();
            $persona->uuid             = Uuid::uuid4()->toString();
            $persona->rfc              = $docente->rfc;
            $persona->curp             = $docente->curp;
            $persona->email            = $docente->email;
            $persona->primer_apellido  = $docente->apellido_paterno;
            $persona->segundo_apellido = $docente->apellido_materno;
            $persona->nombre           = $docente->nombre;
            $persona->tipo_registro    = 'DOCENTE';
            $persona->sexo             = $docente->sexo;
            $persona->save();

            $claveAcceso = md5($docente->rfc);
            $claveAcceso = substr($claveAcceso,0,8);

            $miUsuario = new User([
                'username' => $docente->rfc,
                'email'    => $docente->email,
                'password' => bcrypt($claveAcceso),
                'active'   => true
            ]);

            $persona->usuario()->save($miUsuario);

            $group = Group::where('descripcion','docente')->first();

            $miUsuario->groups()->save($group);
        }
    }
}
