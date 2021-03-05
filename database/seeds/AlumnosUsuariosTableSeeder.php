<?php

use App\models\Alumno;
use App\models\Expediente;
use App\models\Horario;
use App\models\PeriodoEscolar;
use App\Models\Persona;
use App\User;
use App\Group;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class AlumnosUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $alumnos = \DB::connection('mysql')->table('temp_listado_alumnos')->get();

        // GENERAR CORREO INSTUCIONAL DEL ALUMNO Y
        // ACTUALIZAMOS EMAIL EN DATOS CARGADOS
        foreach ($alumnos AS $alumno)
        {
            $arreglo_nombre = explode(' ',$alumno->nombre);
            $arreglo_apellido = explode(' ',$alumno->primer_apellido);
            $email = mb_strtolower($arreglo_nombre[0].'.'.$arreglo_apellido[0]).$alumno->id.'@evasamano.edu.mx';

            \DB::connection('mysql')->table('temp_listado_alumnos')
                ->where('id',$alumno->id)
                ->update([
                    'email'=> $email
                ]);
        }


        //
        // Volvemos a realizar la consulta ya con el correo actualizado
        //
        $alumnos = \DB::connection('mysql')->table('temp_listado_alumnos')->get();

        $consecutivo2_2019=0;
        $consecutivo4_2018=0;
        $consecutivo6_2017=0;
        foreach ($alumnos AS $alumno)
        {
            $persona = new Persona();
            $persona->uuid             = Uuid::uuid4()->toString();
            $persona->curp             = $alumno->curp;
            $persona->fecha_nacimiento = $alumno->fecha_nac;
            $persona->primer_apellido  = $alumno->primer_apellido;
            $persona->segundo_apellido = $alumno->segundo_apellido;
            $persona->nombre           = $alumno->nombre;
            $persona->tipo_registro    = 'ALUMNO';
            $persona->sexo             = substr($alumno->curp,10,1);
            $persona->email            = $alumno->email;
            $persona->telefono         = '';
            $persona->save();

            // Generamos número de control
            if ($alumno->semestre == 2)
            {
                $consecutivo2_2019++;
                $numero_control='2019'.str_pad($consecutivo2_2019,4,'0',STR_PAD_LEFT);
            }
            else if ($alumno->semestre == 4)
            {
                $consecutivo4_2018++;
                $numero_control='2018'.str_pad($consecutivo4_2018,4,'0',STR_PAD_LEFT);
            }
            else if ($alumno->semestre == 6)
            {
                $consecutivo6_2017++;

                $numero_control = '2017'.str_pad($consecutivo6_2017,4,'0',STR_PAD_LEFT);
            }

            // = = = = = = = = = = = = = = = = = = = = = = = = =
            // Buscamos a la persona que acabamos de registrar para registrar el usuario
            // = = = = = = = = = = = = = = = = = = = = = = = = =
            //$persona = App\models\Persona::where('curp',$alumno->curp)->first();

            $claveAcceso = md5($numero_control);
            $claveAcceso = substr($claveAcceso,0,8);

            $miUsuario = new User([
                'username' => $numero_control,
                'email'    => $alumno->email,
                'password' => bcrypt($claveAcceso),
                'active'   => true
            ]);

            $persona->usuario()->save($miUsuario);

            $group = Group::where('descripcion','alumno')->first();

            $miUsuario->groups()->save($group);

            // = = = = = = = = = = = = = = = = = = = = = = = = =
            // REGISTRAMOS AL ALUMNO
            // = = = = = = = = = = = = = = = = = = = = = = = = =

            $turno_id = '';
            if ($alumno->turno == 'MATUTINO')
                $turno_id = 1;
            else if ($alumno->turno == 'VESPERTINO')
                $turno_id = 2;
            else
            {
                echo 'ERROR AL CARGAR LOS TURNOS';
                exit;
            }

            $carrera_id = '';
            if ($alumno->carrera == 'DEPORTES')
                $carrera_id = 1;
            else if ($alumno->carrera == 'INFORMÁTICA')
                $carrera_id = 2;
            else if ($alumno->carrera == 'MERCADOTECNIA')
                $carrera_id = 3;
            else if ($alumno->carrera == 'RECREACIÓN')
                $carrera_id = 4;
            else if ($alumno->carrera == 'TURISMO ALTERNATIVO')
                $carrera_id = 5;
            else
            {
                echo 'ERROR AL CARGAR LA CARRERA';
                echo 'Alumno:'.$alumno->id.' CARRERA:"'.$alumno->carrera.'"';
                exit;
            }

            $miAlumno = new Alumno;
            $miAlumno->uuid           = Uuid::uuid4()->toString();
            $miAlumno->numero_control = $numero_control;
            $miAlumno->persona_id     = $persona->id;
            $miAlumno->vigente        = 'S';
            $miAlumno->save();

            $miPeriodoEscolar = PeriodoEscolar::where('descripcion','Ciclo Escolar 2019-2020 Semestre B')->first();

            $horario_id = null;
            if ($alumno->es_cedar == 'N')
            {
                $miHorario = Horario::where('clave',$alumno->horario)->first();

                if (empty($miHorario->id))
                {
                    echo '<br />ERROR AL CARGAR EL HORARIO';
                    echo '<br />Alumno:'.$alumno->id.' Horario:"'.$alumno->horario.'"';
                }

                $horario_id = $miHorario->id;
            }

            // CREAR EXPEDIENTE
            $miExpediente = new Expediente();
            $miExpediente->alumno_id          = $miAlumno->id;
            $miExpediente->uuid               = Uuid::uuid4()->toString();
            $miExpediente->periodo_escolar_id = $miPeriodoEscolar->id;
            $miExpediente->carrera_id         = $carrera_id;
            $miExpediente->turno_id           = $turno_id;
            $miExpediente->grado_id           = $alumno->semestre;
            $miExpediente->horario_id         = $horario_id;
            $miExpediente->es_cedar           = $alumno->es_cedar;
            $miExpediente->vigente            = 'S';
            $miExpediente->save();

        }
    }
}
