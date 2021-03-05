<?php

use App\models\Asignatura;
use App\models\AsignaturaHorario;
use App\Models\CalificacionGrupo;
use App\Models\CalificacionGrupoExpediente;
use App\models\Horario;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargarRepetidoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // = = = = = = = = = = =
        // PASO 1/5. OBTENER LOS HORARIOS (GRUPOS)
        // = = = = = = = = = = =

        $DEPORTES4TM      = Horario::where('clave','DEPORTES4TM')->first();
        $INFORMATICA2ATM  = Horario::where('clave','INFORMATICA2ATM')->first();
        $INFORMATICA2BTM  = Horario::where('clave','INFORMATICA2BTM')->first();
        $MERCADOTECNIA2TM = Horario::where('clave','MERCADOTECNIA2TM')->first();
        $MERCADOTECNIA4TM = Horario::where('clave','MERCADOTECNIA4TM')->first();
        $RECREACION2TM    = Horario::where('clave','RECREACION2TM')->first();
        $TURISMOALT2TM    = Horario::where('clave','TURISMOALT2TM')->first();
        $TURISMOALT4TM    = Horario::where('clave','TURISMOALT4TM')->first();

        $INFORMATICA2TV   = Horario::where('clave','INFORMATICA2TV')->first();
        $INFORMATICA4TV   = Horario::where('clave','INFORMATICA4TV')->first();
        $RECREACION2TV    = Horario::where('clave','RECREACION2TV')->first();
        $RECREACION4TV    = Horario::where('clave','RECREACION4TV')->first();
        $TURISMOALT2TV    = Horario::where('clave','TURISMOALT2TV')->first();
        $TURISMOALT4TV    = Horario::where('clave','TURISMOALT4TV')->first();

        // = = = = = = = = = = =
        // PASO 2/5. OBTENER LAS ASIGNATURAS
        // = = = = = = = = = = =

        // APLICA LAS TÉCNICAS DE PRIMEROS AUXILIOS EN LA ACTIVIDAD DEPORTIVA (PRIM.AUX) [$PrimAux]
        $PrimAux = Asignatura::where('descripcion','APLICA LAS TÉCNICAS DE PRIMEROS AUXILIOS EN LA ACTIVIDAD DEPORTIVA')->first();

        // CÁLCULO DIFERENCIAL (CAL.DIF.) [$CalDif]
        $CalDif = Asignatura::where('descripcion','CÁLCULO DIFERENCIAL')->first();

        // CONOCE LA HISTORIA Y GEOGRAFÍA REGIONAL AL IGUAL QUE LOS PRINCIPALES SITIOS PARA LA PRÁCTICA DEL TURISMO ALTERNATIVO (HIS. GEO. REG) [$HisGeoReg]
        $HisGeoReg = Asignatura::where('descripcion','CONOCE LA HISTORIA Y GEOGRAFÍA REGIONAL AL IGUAL QUE LOS PRINCIPALES SITIOS PARA LA PRÁCTICA DEL TURISMO ALTERNATIVO')->first();

        // DISEÑA RUTAS SEGURAS PARA LA PRÁCTICA DEL CICLISMO EXTREMO (CICL. EXT) [$CiclExt]
        $CiclExt = Asignatura::where('descripcion','DISEÑA RUTAS SEGURAS PARA LA PRÁCTICA DEL CICLISMO EXTREMO')->first();

        // ELABORA DOCUMENTOS ELECTRÓNICOS MEDIANTE SOFTWARE DE APLICACIÓN DE OFICINA (EDES.OFI) [$EdesOfi]
        $EdesOfi = Asignatura::where('descripcion','ELABORA DOCUMENTOS ELECTRÓNICOS MEDIANTE SOFTWARE DE APLICACIÓN DE OFICINA')->first();

        // FÍSICA 1 (FIS.1) [$Fis1]
        $Fis1 = Asignatura::where('descripcion','FÍSICA 1')->first();

        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        $Geomt = Asignatura::where('descripcion','GEOMETRÍA Y TRIGONOMETRÍA')->first();

        // INGLÉS 2 (ING. 2) [$Ing2]
        $Ing2 = Asignatura::where('descripcion','INGLÉS 2')->first();

        // INGLÉS 4 (ING. 4) [$Ing4]
        $Ing4 = Asignatura::where('descripcion','INGLÉS 4')->first();

        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        $Leoye2 = Asignatura::where('descripcion','LECTURA, EXPRESIÓN ORAL Y ESCRITA 2')->first();

        // PROPONE DIFERENTES ESTRATEGIAS PARA EL MANEJO DE GRUPOS (PRO.MAN.GPOS) [$ProManGpos]
        $ProManGpos = Asignatura::where('descripcion','PROPONE DIFERENTES ESTRATEGIAS PARA EL MANEJO DE GRUPOS')->first();

        // PROPONE ESTRATEGIAS CREATIVAS PARA PRODUCTOS Y SERVICIOS (EST. CREAT. P Y S) [$EstCreatPYS]
        $EstCreatPYS = Asignatura::where('descripcion','PROPONE ESTRATEGIAS CREATIVAS PARA PRODUCTOS Y SERVICIOS')->first();

        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        $Quim2 = Asignatura::where('descripcion','QUÍMICA 2')->first();

        // UTILIZA DE MANERA ÓPTIMA EL TIEMPO LIBRE A TRAVÉS DE ACTIVIDADES RECREATIVAS (TIEM. ACT. REC) [$TiemActRec]
        $TiemActRec = Asignatura::where('descripcion','UTILIZA DE MANERA ÓPTIMA EL TIEMPO LIBRE A TRAVÉS DE ACTIVIDADES RECREATIVAS')->first();

        // = = = = = = = = = = =
        // PASO 3/5. OBTENER EL MAESTRO QUE IMPARTE LA ASIGNATURA EN EL HORARIO(GRUPO) ESTABLECIDO
        // = = = = = = = = = = =

        // __________________________________________
        //              HORARIO VESPERTINO
        // __________________________________________

        $INFORMATICA2TVGeomt      = AsignaturaHorario::where('horario_id',$INFORMATICA2TV->id)->where('asignatura_id',$Geomt->id)->first();
        $INFORMATICA2TVQuim2      = AsignaturaHorario::where('horario_id',$INFORMATICA2TV->id)->where('asignatura_id',$Quim2->id)->first();

        $INFORMATICA4TVCalDif     = AsignaturaHorario::where('horario_id',$INFORMATICA4TV->id)->where('asignatura_id',$CalDif->id)->first();
        $INFORMATICA4TVFis1       = AsignaturaHorario::where('horario_id',$INFORMATICA4TV->id)->where('asignatura_id',$Fis1->id)->first();
        $INFORMATICA4TVIng4       = AsignaturaHorario::where('horario_id',$INFORMATICA4TV->id)->where('asignatura_id',$Ing4->id)->first();

        $RECREACION2TVGeomt       = AsignaturaHorario::where('horario_id',$RECREACION2TV->id)->where('asignatura_id',$Geomt->id)->first();
        $RECREACION2TVLeoye2      = AsignaturaHorario::where('horario_id',$RECREACION2TV->id)->where('asignatura_id',$Leoye2->id)->first();

        $RECREACION4TVIng4        = AsignaturaHorario::where('horario_id',$RECREACION4TV->id)->where('asignatura_id',$Ing4->id)->first();

        $TURISMOALT2TVGeomt       = AsignaturaHorario::where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$Geomt->id)->first();
        $TURISMOALT2TVHisGeoReg   = AsignaturaHorario::where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$HisGeoReg->id)->first();
        $TURISMOALT2TVLeoye2      = AsignaturaHorario::where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$Leoye2->id)->first();
        $TURISMOALT2TVProManGpos  = AsignaturaHorario::where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$ProManGpos->id)->first();
        $TURISMOALT2TVQuim2       = AsignaturaHorario::where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$Quim2->id)->first();

        $TURISMOALT4TVIng4        = AsignaturaHorario::where('horario_id',$TURISMOALT4TV->id)->where('asignatura_id',$Ing4->id)->first();

        // __________________________________________
        //              HORARIO MATUTINO
        // __________________________________________

        $DEPORTES4TMPrimAux          = AsignaturaHorario::where('horario_id',$DEPORTES4TM->id)->where('asignatura_id',$PrimAux->id)->first();

        $INFORMATICA2ATMGeomt        = AsignaturaHorario::where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Geomt->id)->first();
        $INFORMATICA2ATMIng2         = AsignaturaHorario::where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Ing2->id)->first();
        $INFORMATICA2ATMLeoye2       = AsignaturaHorario::where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Leoye2->id)->first();
        $INFORMATICA2ATMQuim2        = AsignaturaHorario::where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Quim2->id)->first();


        $INFORMATICA2BTMEdesOfi      = AsignaturaHorario::where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$EdesOfi->id)->first();
        $INFORMATICA2BTMIng2         = AsignaturaHorario::where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$Ing2->id)->first();
        $INFORMATICA2BTMGeomt        = AsignaturaHorario::where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$Geomt->id)->first();
        $INFORMATICA2BTMQuim2        = AsignaturaHorario::where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$Quim2->id)->first();

        //NO EXISTE LA MATERIA PARA EL GRADO GRUPO
        //$MERCADOTECNIA2TMEstCreatPYS = AsignaturaHorario::where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$EstCreatPYS->id)->first();
        $MERCADOTECNIA2TMFis1        = AsignaturaHorario::where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Fis1->id)->first();
        $MERCADOTECNIA2TMGeomt       = AsignaturaHorario::where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Geomt->id)->first();
        $MERCADOTECNIA2TMLeoye2      = AsignaturaHorario::where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Leoye2->id)->first();
        $MERCADOTECNIA2TMQuim2       = AsignaturaHorario::where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Quim2->id)->first();


        $MERCADOTECNIA4TMFis1        = AsignaturaHorario::where('horario_id',$MERCADOTECNIA4TM->id)->where('asignatura_id',$Fis1->id)->first();
        $MERCADOTECNIA4TMEstCreatPYS = AsignaturaHorario::where('horario_id',$MERCADOTECNIA4TM->id)->where('asignatura_id',$EstCreatPYS->id)->first();



        $RECREACION2TMTiemActRec     = AsignaturaHorario::where('horario_id',$RECREACION2TM->id)->where('asignatura_id',$TiemActRec->id)->first();

        //$TURISMOALT2TMCiclExt        = AsignaturaHorario::where('horario_id',$TURISMOALT2TM->id)->where('asignatura_id',$CiclExt->id)->first();
        //$TURISMOALT2TMFis1           = AsignaturaHorario::where('horario_id',$TURISMOALT2TM->id)->where('asignatura_id',$Fis1->id)->first();
        $TURISMOALT2TMHisGeoReg      = AsignaturaHorario::where('horario_id',$TURISMOALT2TM->id)->where('asignatura_id',$HisGeoReg->id)->first();

        $TURISMOALT4TMCiclExt        = AsignaturaHorario::where('horario_id',$TURISMOALT4TM->id)->where('asignatura_id',$CiclExt->id)->first();
        $TURISMOALT4TMIng4           = AsignaturaHorario::where('horario_id',$TURISMOALT4TM->id)->where('asignatura_id',$Ing4->id)->first();
        $TURISMOALT4TMFis1           = AsignaturaHorario::where('horario_id',$TURISMOALT4TM->id)->where('asignatura_id',$Fis1->id)->first();


        // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
        // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
        //
        //              PASO 4/5. OBTENER LOS DATOS DEL GRUPO DONDE TOMARA LA MATERIA
        //
        // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
        // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

        // __________________________________________
        //              VESPERTINO
        // __________________________________________

        $GrupoINFORMATICA2TVGeomt         = CalificacionGrupo::where('persona_id',$INFORMATICA2TVGeomt->persona_id)->where('horario_id',$INFORMATICA2TV->id)->where('asignatura_id',$Geomt->id)->first();
        $GrupoINFORMATICA2TVQuim2         = CalificacionGrupo::where('persona_id',$INFORMATICA2TVQuim2->persona_id)->where('horario_id',$INFORMATICA2TV->id)->where('asignatura_id',$Quim2->id)->first();

        $GrupoINFORMATICA4TVCalDif        = CalificacionGrupo::where('persona_id',$INFORMATICA4TVCalDif->persona_id)->where('horario_id',$INFORMATICA4TV->id)->where('asignatura_id',$CalDif->id)->first();
        $GrupoINFORMATICA4TVFis1          = CalificacionGrupo::where('persona_id',$INFORMATICA4TVFis1->persona_id)->where('horario_id',$INFORMATICA4TV->id)->where('asignatura_id',$Fis1->id)->first();
        $GrupoINFORMATICA4TVIng4          = CalificacionGrupo::where('persona_id',$INFORMATICA4TVIng4->persona_id)->where('horario_id',$INFORMATICA4TV->id)->where('asignatura_id',$Ing4->id)->first();

        $GrupoRECREACION2TVGeomt          = CalificacionGrupo::where('persona_id',$RECREACION2TVGeomt->persona_id)->where('horario_id',$RECREACION2TV->id)->where('asignatura_id',$Geomt->id)->first();
        $GrupoRECREACION2TVLeoye2         = CalificacionGrupo::where('persona_id',$RECREACION2TVLeoye2->persona_id)->where('horario_id',$RECREACION2TV->id)->where('asignatura_id',$Leoye2->id)->first();

        $GrupoRECREACION4TVIng4           = CalificacionGrupo::where('persona_id',$RECREACION4TVIng4->persona_id)->where('horario_id',$RECREACION4TV->id)->where('asignatura_id',$Ing4->id)->first();

        $GrupoTURISMOALT2TVGeomt          = CalificacionGrupo::where('persona_id',$TURISMOALT2TVGeomt->persona_id)->where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$Geomt->id)->first();
        $GrupoTURISMOALT2TVHisGeoReg      = CalificacionGrupo::where('persona_id',$TURISMOALT2TVHisGeoReg->persona_id)->where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$HisGeoReg->id)->first();
        $GrupoTURISMOALT2TVLeoye2         = CalificacionGrupo::where('persona_id',$TURISMOALT2TVLeoye2->persona_id)->where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$Leoye2->id)->first();
        $GrupoTURISMOALT2TVProManGpos     = CalificacionGrupo::where('persona_id',$TURISMOALT2TVProManGpos->persona_id)->where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$ProManGpos->id)->first();
        $GrupoTURISMOALT2TVQuim2          = CalificacionGrupo::where('persona_id',$TURISMOALT2TVQuim2->persona_id)->where('horario_id',$TURISMOALT2TV->id)->where('asignatura_id',$Quim2->id)->first();

        $GrupoTURISMOALT4TVIng4           = CalificacionGrupo::where('persona_id',$TURISMOALT4TVIng4->persona_id)->where('horario_id',$TURISMOALT4TV->id)->where('asignatura_id',$Ing4->id)->first();

        // __________________________________________
        //               MATUTINO
        // __________________________________________

        $GrupoDEPORTES4TMPrimAux          = CalificacionGrupo::where('persona_id',$DEPORTES4TMPrimAux->persona_id)->where('horario_id',$DEPORTES4TM->id)->where('asignatura_id',$PrimAux->id)->first();

        $GrupoINFORMATICA2ATMIng2         = CalificacionGrupo::where('persona_id',$INFORMATICA2ATMIng2->persona_id)->where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Ing2->id)->first();
        $GrupoINFORMATICA2ATMGeomt        = CalificacionGrupo::where('persona_id',$INFORMATICA2ATMGeomt->persona_id)->where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Geomt->id)->first();
        $GrupoINFORMATICA2ATMLeoye2       = CalificacionGrupo::where('persona_id',$INFORMATICA2ATMLeoye2->persona_id)->where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Leoye2->id)->first();
        $GrupoINFORMATICA2ATMQuim2        = CalificacionGrupo::where('persona_id',$INFORMATICA2ATMQuim2->persona_id)->where('horario_id',$INFORMATICA2ATM->id)->where('asignatura_id',$Quim2->id)->first();

        $GrupoINFORMATICA2BTMEdesOfi      = CalificacionGrupo::where('persona_id',$INFORMATICA2BTMEdesOfi->persona_id)->where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$EdesOfi->id)->first();
        $GrupoINFORMATICA2BTMGeomt        = CalificacionGrupo::where('persona_id',$INFORMATICA2BTMGeomt->persona_id)->where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$Geomt->id)->first();
        $GrupoINFORMATICA2BTMIng2         = CalificacionGrupo::where('persona_id',$INFORMATICA2BTMIng2->persona_id)->where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$Ing2->id)->first();
        $GrupoINFORMATICA2BTMQuim2        = CalificacionGrupo::where('persona_id',$INFORMATICA2BTMQuim2->persona_id)->where('horario_id',$INFORMATICA2BTM->id)->where('asignatura_id',$Quim2->id)->first();

        //NO EXISTE LA MATERIA EN EL GRUPO
        ///$GrupoMERCADOTECNIA2TMEstCreatPYS = CalificacionGrupo::where('persona_id',$MERCADOTECNIA2TMEstCreatPYS->persona_id)->where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$EstCreatPYS->id)->first();

        $GrupoMERCADOTECNIA2TMGeomt       = CalificacionGrupo::where('persona_id',$MERCADOTECNIA2TMGeomt->persona_id)->where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Geomt->id)->first();
        $GrupoMERCADOTECNIA2TMLeoye2      = CalificacionGrupo::where('persona_id',$MERCADOTECNIA2TMLeoye2->persona_id)->where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Leoye2->id)->first();
        $GrupoMERCADOTECNIA2TMQuim2       = CalificacionGrupo::where('persona_id',$MERCADOTECNIA2TMQuim2->persona_id)->where('horario_id',$MERCADOTECNIA2TM->id)->where('asignatura_id',$Quim2->id)->first();


        $GrupoMERCADOTECNIA4TMFis1        = CalificacionGrupo::where('persona_id',$MERCADOTECNIA4TMFis1->persona_id)->where('horario_id',$MERCADOTECNIA4TM->id)->where('asignatura_id',$Fis1->id)->first();
        $GrupoMERCADOTECNIA4TMEstCreatPYS = CalificacionGrupo::where('persona_id',$MERCADOTECNIA4TMEstCreatPYS->persona_id)->where('horario_id',$MERCADOTECNIA4TM->id)->where('asignatura_id',$EstCreatPYS->id)->first();


        $GrupoTURISMOALT2TMHisGeoReg      = CalificacionGrupo::where('persona_id',$TURISMOALT2TMHisGeoReg->persona_id)->where('horario_id',$TURISMOALT2TM->id)->where('asignatura_id',$HisGeoReg->id)->first();


        $GrupoTURISMOALT4TMCiclExt        = CalificacionGrupo::where('persona_id',$TURISMOALT4TMCiclExt->persona_id)->where('horario_id',$TURISMOALT4TM->id)->where('asignatura_id',$CiclExt->id)->first();
        $GrupoTURISMOALT4TMFis1           = CalificacionGrupo::where('persona_id',$TURISMOALT4TMFis1->persona_id)->where('horario_id',$TURISMOALT4TM->id)->where('asignatura_id',$Fis1->id)->first();
        $GrupoTURISMOALT4TMIng4           = CalificacionGrupo::where('persona_id',$TURISMOALT4TMIng4->persona_id)->where('horario_id',$TURISMOALT4TM->id)->where('asignatura_id',$Ing4->id)->first();



        $GrupoRECREACION2TMTiemActRec     = CalificacionGrupo::where('persona_id',$RECREACION2TMTiemActRec->persona_id)->where('horario_id',$RECREACION2TM->id)->where('asignatura_id',$TiemActRec->id)->first();

        // = = = = = = = = = = =
        // PASO 5/5. OBTENER Y ASIGNAR AL ALUMNO EN EL GRUPO
        // = = = = = = = = = = =

        // RECREACION2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // ALVARADO MOO ELSY MARIA - AAME001205MQRLXLA2

        $query = Persona::query();

        $AAME001205MQRLXLA2 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','AAME001205MQRLXLA2')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoRECREACION2TVGeomt->id, $AAME001205MQRLXLA2->id]);

        // RECREACION2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // MAY HERNANDEZ ANDREA ARIACNE - MAHA031013MQRYRNA5

        $query = Persona::query();

        $MAHA031013MQRYRNA5 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MAHA031013MQRYRNA5')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoRECREACION2TVGeomt->id, $MAHA031013MQRYRNA5->id]);

        // TURISMOALT2TV
        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        // LEON ARANA JOSEPH LIZARDO - LEAJ020516HQRNRSA7

        $query = Persona::query();

        $LEAJ020516HQRNRSA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','LEAJ020516HQRNRSA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVLeoye2->id, $LEAJ020516HQRNRSA7->id]);

        // TURISMOALT2TV
        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        // TABARES LIZAMA JENNIFER GUADALUPE - TALJ020926MQRBZNA9

        $query = Persona::query();

        $TALJ020926MQRBZNA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','TALJ020926MQRBZNA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVLeoye2->id, $TALJ020926MQRBZNA9->id]);

        // TURISMOALT2TV
        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        // SOLIS CANUL LILIA MARGARITA - SOCL030904MQRLNLA9

        $query = Persona::query();

        $SOCL030904MQRLNLA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','SOCL030904MQRLNLA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVLeoye2->id, $SOCL030904MQRLNLA9->id]);

        // RECREACION2TV
        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        // KU MANUELES ALONDRA MARIELY - KUMA030827MQRXNLA3

        $query = Persona::query();

        $KUMA030827MQRXNLA3 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','KUMA030827MQRXNLA3')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoRECREACION2TVLeoye2->id, $KUMA030827MQRXNLA3->id]);

        // $MERCADOTECNIA2TM
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // CHIMAL NOH ISAIAS DE JESUS - CINI020131HQRMHSA1

        $query = Persona::query();

        $CINI020131HQRMHSA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CINI020131HQRMHSA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA2TMGeomt->id, $CINI020131HQRMHSA1->id]);

        // TURISMOALT2TV
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // ARRIAGA CANTO LUIS ANGEL - AICL030126HQRRNSA1

        $query = Persona::query();

        $AICL030126HQRRNSA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','AICL030126HQRRNSA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVQuim2->id, $AICL030126HQRRNSA1->id]);

        // TURISMOALT2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // MENA GONZALEZ MICHAEL ISMAEL - MEGM030507HQRNNCA7

        $query = Persona::query();

        $MEGM030507HQRNNCA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MEGM030507HQRNNCA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVGeomt->id, $MEGM030507HQRNNCA7->id]);

        // TURISMOALT2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // LOPEZ  MALDONADO LUIS JAVIER - LOML010311HQRPLSA1

        $query = Persona::query();

        $LOML010311HQRPLSA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','LOML010311HQRPLSA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVGeomt->id, $LOML010311HQRPLSA1->id]);

        // TURISMOALT2TV
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // LOPEZ  MALDONADO LUIS JAVIER - LOML010311HQRPLSA1

        $query = Persona::query();

        $LOML010311HQRPLSA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','LOML010311HQRPLSA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVQuim2->id, $LOML010311HQRPLSA1->id]);

        // TURISMOALT2TV
        // PROPONE DIFERENTES ESTRATEGIAS PARA EL MANEJO DE GRUPOS (PRO.MAN.GPOS) [$ProManGpos]
        // MORALES PEREZ ANA LAURA - MOPA010521MQRRRNA2

        $query = Persona::query();

        $MOPA010521MQRRRNA2 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MOPA010521MQRRRNA2')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVProManGpos->id, $MOPA010521MQRRRNA2->id]);

        // TURISMOALT2TV
        // CONOCE LA HISTORIA Y GEOGRAFÍA REGIONAL AL IGUAL QUE LOS PRINCIPALES SITIOS PARA LA PRÁCTICA DEL TURISMO ALTERNATIVO (HIS. GEO. REG) [$HisGeoReg]
        // MORALES PEREZ ANA LAURA - MOPA010521MQRRRNA2

        $query = Persona::query();

        $MOPA010521MQRRRNA2 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MOPA010521MQRRRNA2')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVHisGeoReg->id, $MOPA010521MQRRRNA2->id]);

        // $TURISMOALT4TV
        // INGLÉS 4 (ING. 4) [$Ing4]
        // GRIJALVA REYES CARLOS JERSAIM - GIRC020806HQRRYRA3

        $query = Persona::query();

        $GIRC020806HQRRYRA3 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','GIRC020806HQRRYRA3')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT4TVIng4->id, $GIRC020806HQRRYRA3->id]);

        // TURISMOALT2TV
        // CONOCE LA HISTORIA Y GEOGRAFÍA REGIONAL AL IGUAL QUE LOS PRINCIPALES SITIOS PARA LA PRÁCTICA DEL TURISMO ALTERNATIVO (HIS. GEO. REG) [$HisGeoReg]
        // ABAN KAUIL ASHANTY GUADALUPE - AAKA001029MQRBLSA8

        $query = Persona::query();

        $AAKA001029MQRBLSA8 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','AAKA001029MQRBLSA8')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVHisGeoReg->id, $AAKA001029MQRBLSA8->id]);

        // TURISMOALT2TV
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // CABRERA FLORES RAUL ANTONIO - CAFR020721HQRBLLA7

        $query = Persona::query();

        $CAFR020721HQRBLLA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CAFR020721HQRBLLA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVQuim2->id, $CAFR020721HQRBLLA7->id]);

        // $INFORMATICA4TV
        // INGLÉS 4 (ING. 4) [$Ing4]
        // CABRERA FLORES RAUL ANTONIO - CAFR020721HQRBLLA7

        $query = Persona::query();

        $CAFR020721HQRBLLA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CAFR020721HQRBLLA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVIng4->id, $CAFR020721HQRBLLA7->id]);

        // $INFORMATICA2TV
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // HERNANDEZ UC JOSE ANTONIO - HEUA020223HQRRCNA5

        $query = Persona::query();

        $HEUA020223HQRRCNA5 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','HEUA020223HQRRCNA5')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2TVQuim2->id, $HEUA020223HQRRCNA5->id]);

        // $RECREACION2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // ALVAREZ ONOFRE FERNANDA ISABEL - AAOF000410MQRLNRA7

        $query = Persona::query();

        $AAOF000410MQRLNRA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','AAOF000410MQRLNRA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoRECREACION2TVGeomt->id, $AAOF000410MQRLNRA7->id]);

        // $TURISMOALT2TV
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // RODRIGUEZ CANUL ARIADNE GUADALUPE - ROCA020823MQRDNRA4

        $query = Persona::query();

        $ROCA020823MQRDNRA4 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','ROCA020823MQRDNRA4')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVQuim2->id, $ROCA020823MQRDNRA4->id]);

        // $INFORMATICA2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // RAMOS OLAN IRMA YENIFER - RAOI020907MQRMLRA7

        $query = Persona::query();

        $RAOI020907MQRMLRA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','RAOI020907MQRMLRA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2TVGeomt->id, $RAOI020907MQRMLRA7->id]);

        // $INFORMATICA4TV
        // FÍSICA 1 (FIS.1) [$Fis1]
        // CHAN HOIL MIGUEL ALFREDO - CAHM011218HQRHLGA3

        $query = Persona::query();

        $CAHM011218HQRHLGA3 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CAHM011218HQRHLGA3')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVFis1->id, $CAHM011218HQRHLGA3->id]);

        // $INFORMATICA4TV
        // FÍSICA 1 (FIS.1) [$Fis1]
        // ECHEVERRIA LOPEZ CRISTIAN ARMANDO - EELC010724HQRCPRA7

        $query = Persona::query();

        $EELC010724HQRCPRA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','EELC010724HQRCPRA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVFis1->id, $EELC010724HQRCPRA7->id]);

        // $RECREACION4TV
        // INGLÉS 4 (ING. 4) [$Ing4]
        // RUBIO HERNANDEZ KATIA PAULINA - RUHK970906MQRBRT07

        $query = Persona::query();

        $RUHK970906MQRBRT07 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','RUHK970906MQRBRT07')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoRECREACION4TVIng4->id, $RUHK970906MQRBRT07->id]);

        // $INFORMATICA4TV
        // CÁLCULO DIFERENCIAL (CAL.DIF.) [$CalDif]
        // PROTONOTARIO MENDEZ GALA YAZEL - POMG000701MQRRNLA1

        $query = Persona::query();

        $POMG000701MQRRNLA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','POMG000701MQRRNLA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVCalDif->id, $POMG000701MQRRNLA1->id]);

        // $TURISMOALT2TV
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // JARVIO SUAREZ GAEL LEONARDO - JASG020525HQRRRLA0

        $query = Persona::query();

        $JASG020525HQRRRLA0 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','JASG020525HQRRRLA0')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TVGeomt->id, $JASG020525HQRRRLA0->id]);

        // $INFORMATICA4TV
        // CÁLCULO DIFERENCIAL (CAL.DIF.) [$CalDif]
        // GUTIERREZ CHIMAL JOHANA ALEJANDRA - GUCJ010604MQRTHHA1

        $query = Persona::query();

        $GUCJ010604MQRTHHA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','GUCJ010604MQRTHHA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVCalDif->id, $GUCJ010604MQRTHHA1->id]);

        // $INFORMATICA4TV
        // CÁLCULO DIFERENCIAL (CAL.DIF.) [$CalDif]
        // SANCHEZ AGUILAR CHRISTOPHER - SAAC010914HQRNGHA7

        $query = Persona::query();

        $SAAC010914HQRNGHA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','SAAC010914HQRNGHA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVCalDif->id, $SAAC010914HQRNGHA7->id]);

        // $INFORMATICA4TV
        // INGLÉS 4 (ING. 4) [$Ing4]
        // COUOH NAVARRETE JOSE ANGEL - CONA021218HQRHVNA4

        $query = Persona::query();

        $CONA021218HQRHVNA4 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CONA021218HQRHVNA4')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA4TVIng4->id, $CONA021218HQRHVNA4->id]);

        // = = =
        // = = =
        // = = =

        // $INFORMATICA2BTM
        // INGLÉS 2 (ING. 2) [$Ing2]
        // CÁMARA  MAY DARVIN JESUS - CAMD010824HQRMYRA3

        $query = Persona::query();

        $CAMD010824HQRMYRA3 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CAMD010824HQRMYRA3')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2BTMIng2->id, $CAMD010824HQRMYRA3->id]);

        // $INFORMATICA2ATM
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // HAU GIL MARCO ANTONIO - HAGM020715HVZXLRA6

        $query = Persona::query();

        $HAGM020715HVZXLRA6 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','HAGM020715HVZXLRA6')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2ATMGeomt->id, $HAGM020715HVZXLRA6->id]);

        // INFORMATICA2ATM
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // HERNÁNDEZ CAMPOS JOSÉ ALEJANDRO - HECA011023HQRRMLA8

        $query = Persona::query();

        $HECA011023HQRRMLA8 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','HECA011023HQRRMLA8')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2ATMQuim2->id, $HECA011023HQRRMLA8->id]);

        // INFORMATICA2ATM
        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        // HERNÁNDEZ CAMPOS JOSÉ ALEJANDRO - HECA011023HQRRMLA8

        $query = Persona::query();

        $HECA011023HQRRMLA8 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','HECA011023HQRRMLA8')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2ATMLeoye2->id, $HECA011023HQRRMLA8->id]);

        // $TURISMOALT2TM
        // CONOCE LA HISTORIA Y GEOGRAFÍA REGIONAL AL IGUAL QUE LOS PRINCIPALES SITIOS PARA LA PRÁCTICA DEL TURISMO ALTERNATIVO (HIS. GEO. REG) [$HisGeoReg]
        // PINTO MENDEZ RAMON FERNANDO - PIMR021130HQRNNMA9

        $query = Persona::query();

        $PIMR021130HQRNNMA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','PIMR021130HQRNNMA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT2TMHisGeoReg->id, $PIMR021130HQRNNMA9->id]);

        // INFORMATICA2BTM
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // GONGORA MACEDONIO RAQUEL ALELY - GOMR021011MQRNCQA1

        $query = Persona::query();

        $GOMR021011MQRNCQA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','GOMR021011MQRNCQA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2BTMGeomt->id, $GOMR021011MQRNCQA1->id]);

        // INFORMATICA2BTM
        // INGLÉS 2 (ING. 2) [$Ing2]
        // GONGORA MACEDONIO RAQUEL ALELY - GOMR021011MQRNCQA1

        $query = Persona::query();

        $GOMR021011MQRNCQA1 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','GOMR021011MQRNCQA1')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2BTMIng2->id, $GOMR021011MQRNCQA1->id]);

        // INFORMATICA2BTM
        // ELABORA DOCUMENTOS ELECTRÓNICOS MEDIANTE SOFTWARE DE APLICACIÓN DE OFICINA (EDES.OFI) [$EdesOfi]
        // CAMPOS LECHUGA EDMUNDO - CALE011026HQRMCDA9

        $query = Persona::query();

        $CALE011026HQRMCDA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CALE011026HQRMCDA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2BTMEdesOfi->id, $CALE011026HQRMCDA9->id]);


        // $MERCADOTECNIA4TM
        // FÍSICA 1 (FIS.1) [$Fis1]
        // MARQUEZ ACOSTA ALEXIS GABRIEL - MAAA020508HQRRCLA7

        $query = Persona::query();

        $MAAA020508HQRRCLA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MAAA020508HQRRCLA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA4TMFis1->id, $MAAA020508HQRRCLA7->id]);

        // $MERCADOTECNIA4TM
        // PROPONE ESTRATEGIAS CREATIVAS PARA PRODUCTOS Y SERVICIOS (EST. CREAT. P Y S) [$EstCreatPYS]
        // MARQUEZ ACOSTA ALEXIS GABRIEL - MAAA020508HQRRCLA7

        $query = Persona::query();

        $MAAA020508HQRRCLA7 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MAAA020508HQRRCLA7')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA4TMEstCreatPYS->id, $MAAA020508HQRRCLA7->id]);

        // $TURISMOALT4TM
        // FÍSICA 1 (FIS.1) [$Fis1]
        // CRUZ UICAB JOSE MANUEL - CUUM991204HQRRCN08

        $query = Persona::query();

        $CUUM991204HQRRCN08 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CUUM991204HQRRCN08')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT4TMFis1->id, $CUUM991204HQRRCN08->id]);

        // $MERCADOTECNIA2TM
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // LEAL SANCHEZ RAMON IGNACIO - LESR010705HQRLNMA9

        $query = Persona::query();

        $LESR010705HQRLNMA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','LESR010705HQRLNMA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA2TMGeomt->id, $LESR010705HQRLNMA9->id]);

        // $DEPORTES4TM
        // APLICA LAS TÉCNICAS DE PRIMEROS AUXILIOS EN LA ACTIVIDAD DEPORTIVA (PRIM.AUX) [$PrimAux]
        // LEAL SANCHEZ RAMON IGNACIO - LESR010705HQRLNMA9

        $query = Persona::query();

        $LESR010705HQRLNMA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','LESR010705HQRLNMA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoDEPORTES4TMPrimAux->id, $LESR010705HQRLNMA9->id]);

        // $MERCADOTECNIA2TM
        // GEOMETRÍA Y TRIGONOMETRÍA (GEOMT.) [$Geomt]
        // PADILLA CONTRERAS LUIS MARTIN - PACL010125HQRDNSA9

        $query = Persona::query();

        $PACL010125HQRDNSA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','PACL010125HQRDNSA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA2TMGeomt->id, $PACL010125HQRDNSA9->id]);

        // $MERCADOTECNIA2TM
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // PADILLA CONTRERAS LUIS MARTIN - PACL010125HQRDNSA9

        $query = Persona::query();

        $PACL010125HQRDNSA9 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','PACL010125HQRDNSA9')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA2TMQuim2->id, $PACL010125HQRDNSA9->id]);

        // $MERCADOTECNIA2TM
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // MENA ALVARADO MIGUEL ALDAIR - MEAM000804HQRNLGA2

        $query = Persona::query();

        $MEAM000804HQRNLGA2 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MEAM000804HQRNLGA2')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA2TMQuim2->id, $MEAM000804HQRNLGA2->id]);

        // $MERCADOTECNIA2TM
        // LECTURA, EXPRESIÓN ORAL Y ESCRITA 2 (LEOYE2) [$Leoye2]
        // MENA ALVARADO MIGUEL ALDAIR - MEAM000804HQRNLGA2

        $query = Persona::query();

        $MEAM000804HQRNLGA2 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MEAM000804HQRNLGA2')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoMERCADOTECNIA2TMLeoye2->id, $MEAM000804HQRNLGA2->id]);

        // $TURISMOALT4TM
        // INGLÉS 4 (ING. 4) [$Ing4]
        // CORDOVA DORANTES KIARA - CODK000707MQRRRRA2

        $query = Persona::query();

        $CODK000707MQRRRRA2 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CODK000707MQRRRRA2')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT4TMIng4->id, $CODK000707MQRRRRA2->id]);

        // $TURISMOALT4TM
        // DISEÑA RUTAS SEGURAS PARA LA PRÁCTICA DEL CICLISMO EXTREMO (CICL. EXT) [$CiclExt]
        // GONGORA MACEDONIO DANIA ESMERALDA - GOMD010407MQRNCNA5

        $query = Persona::query();

        $GOMD010407MQRNCNA5 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','GOMD010407MQRNCNA5')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT4TMCiclExt->id, $GOMD010407MQRNCNA5->id]);

        // $INFORMATICA2BTM
        // QUÍMICA 2 (QUIM. 2) [$Quim2]
        // CRUZ ORTIZ JORGE ALEJANDRO - CUOJ010917HQRRRRA8

        $query = Persona::query();

        $CUOJ010917HQRRRRA8 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','CUOJ010917HQRRRRA8')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoINFORMATICA2BTMQuim2->id, $CUOJ010917HQRRRRA8->id]);

        // $RECREACION2TM
        // UTILIZA DE MANERA ÓPTIMA EL TIEMPO LIBRE A TRAVÉS DE ACTIVIDADES RECREATIVAS (TIEM. ACT. REC) [$TiemActRec]
        // MARTINEZ HAU CARLOS MOISES - MAHC011010HQRRXRA4

        $query = Persona::query();

        $MAHC011010HQRRXRA4 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MAHC011010HQRRXRA4')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoRECREACION2TMTiemActRec->id, $MAHC011010HQRRXRA4->id]);

        // $TURISMOALT4TM
        // INGLÉS 4 (ING. 4) [$Ing4]
        // MARTINEZ HAU CARLOS MOISES - MAHC011010HQRRXRA4

        $query = Persona::query();

        $MAHC011010HQRRXRA4 = $query->selectRaw('expediente.id')
            ->join('sigeeva.alumnos AS alumno','alumno.persona_id','=','personas.id')
            ->join('sigeeva.expedientes AS expediente','expediente.alumno_id','=','alumno.id')
            ->where('personas.curp','MAHC011010HQRRXRA4')
            ->first();

        $qry = "INSERT INTO sigeeva.calificacion_grupo_expediente (calificacion_grupo_id, expediente_id, es_adicional) VALUES (?,?,'S')";

        DB::insert($qry, [$GrupoTURISMOALT4TMIng4->id, $MAHC011010HQRRXRA4->id]);

    }
}
