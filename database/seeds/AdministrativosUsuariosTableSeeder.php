<?php

use App\Models\Persona;
use App\User;
use App\Group;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AdministrativosUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrativos = \DB::connection('mysql')->table('temp_listado_administrativos')->get();

        foreach ($administrativos AS $administrativo)
        {
            $persona = new Persona();
            $persona->uuid             = Uuid::uuid4()->toString();
            $persona->rfc              = $administrativo->rfc;
            $persona->curp             = $administrativo->curp;
            $persona->email            = $administrativo->correo_electronico;
            $persona->primer_apellido  = $administrativo->apellido_paterno;
            $persona->segundo_apellido = $administrativo->apellido_materno;
            $persona->nombre           = $administrativo->nombre;
            $persona->tipo_registro    = 'ADMINISTRATIVO';
            $persona->sexo             = $administrativo->sexo;
            $persona->save();

            $claveAcceso = md5($administrativo->rfc);
            $claveAcceso = substr($claveAcceso,0,8);

            $miUsuario = new User([
                'username' => $administrativo->rfc,
                'email'    => $administrativo->correo_electronico,
                'password' => bcrypt($claveAcceso),
                'active'   => true
            ]);

            $persona->usuario()->save($miUsuario);

            $group = Group::where('descripcion','administrativo')->first();

            $miUsuario->groups()->save($group);
        }
    }
}
