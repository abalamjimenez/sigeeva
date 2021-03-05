<?php

use App\Models\Asignatura;
use Illuminate\Database\Seeder;

class AsignaturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'REDES',                 'descripcion' => 'ADMINISTRA REDES DE ÁREA LOCAL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'ÁLGEBRA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'APLICA ESTRATEGIAS PARA EL DESARROLLO DE JUEGOS TRADICIONALES Y DEPORTES AUTÓCTONOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ACT.FIS.NIÑ Y JOV',     'descripcion' => 'APLICA LA METODOLOGÍA PARA ACTIVIDADES FÍSICAS EN LOS NIÑOS Y JÓVENES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ADMON DEPOR',           'descripcion' => 'APLICA LAS BASES DE LA ADMINISTRACIÓN DE ESPACIOS Y ACTIVIDADES DEPORTIVAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'TCAS. NADO',            'descripcion' => 'APLICA LAS TÉCNICAS DE LOS DIFERENTES ESTILOS DE NADO PARA OPTIMIZAR SU DESARROLLO PSICOMOTOR']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'PRIM.AUX',              'descripcion' => 'APLICA LAS TÉCNICAS DE PRIMEROS AUXILIOS EN LA ACTIVIDAD DEPORTIVA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ACT. ACUAT',            'descripcion' => 'APLICA LOS BENEFICIOS DE LA ACTIVIDAD ACUÁTICA PARA LA SALUD']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'FUN.LEG.MIC',           'descripcion' => 'APLICA LOS FUNDAMENTOS LEGALES Y ÉTICOS EN UNA MICROEMPRESA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ADMON. REC',            'descripcion' => 'APLICA LOS PRINCIPIOS DE ADMINISTRACIÓN EN LA RECREACIÓN PARA DISEÑAR UN PROGRAMA RECREATIVO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'APLICA TÉCNICAS DE COMERCIALIZACIÓN INTERNACIONAL DE PRODUCTOS Y SERVICIOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'BIOLOGÍA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ALIM.yBEB',             'descripcion' => 'BRINDA UN SERVICIO ÓPTIMO DE ALIMENTOS Y BEBIDAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'CAL.DIF.',              'descripcion' => 'CÁLCULO DIFERENCIAL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'CÁLCULO INTEGRAL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'CIENCIA, TECNOLOGÍA, SOCIEDAD Y VALORES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'CON. TUR. ALT',         'descripcion' => 'CLASIFICA LOS DIFERENTES CONCEPTOS DEL TURISMO ALTERNATIVO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'CONDUCE ACTIVIDADES PARA PERSONAS CON CAPACIDADES FÍSICAS DIFERENRES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'HIS. GEO. REG',         'descripcion' => 'CONOCE LA HISTORIA Y GEOGRAFÍA REGIONAL AL IGUAL QUE LOS PRINCIPALES SITIOS PARA LA PRÁCTICA DEL TURISMO ALTERNATIVO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'CREA SISTEMAS DE INFORMACIÓN MEDIANTE UN LENGUAJE DE PROGRAMACIÓN VISUAL Y EL EMPLEO DE UNA BASE DE DATOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'CREA UN PLAN DE CALIDAD DE LOS SERVICIOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'EST. PUBLIC VENT',      'descripcion' => 'CREA UNA ESTRATEGIA PUBLICITARIA DE PROMOCIÓN DE VENTAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'CREA.MICRO',            'descripcion' => 'CREA UNA MICROEMPRESA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'DES.PENS.CREA',         'descripcion' => 'DESARROLLA EL PENSAMIENTO CREATIVO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'PLAN. RIES. SIT. EMER', 'descripcion' => 'DESARROLLA PLANES DE EMERGENCIA EN SITUACIONES DE RIESGO DURANTE ACTIVIDADES RECREATIVAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'CICL. EXT',             'descripcion' => 'DISEÑA RUTAS SEGURAS PARA LA PRÁCTICA DEL CICLISMO EXTREMO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'DIS.SIST.INF.PLAT.',    'descripcion' => 'DISEÑA SISTEMAS DE INFORMACIÓN BÁSICOS EN UNA PLATAFORMA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'DISEÑA UN PLAN DE RELACIONES PÚBLICAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'DISEÑA UN PLAN PUBLICITARIO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'DISEÑA UN PROYECTO ECOTURÍSTICO SUSTENTABLE']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'BAS.DAT',               'descripcion' => 'DISEÑA Y MANIPULA LA ESTRUCTURA Y EL CONTENIDO DE UNA BASE DE DATOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'DIVULGA ASPECTOS POLÍTICOS Y SOCIALES IMPORTANTES DE LA CULTURA MAYA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'MAN. GPOS',             'descripcion' => 'DOMINA LAS DIFERENTES TÉCNICAS DE LIDERAZGO EN EL MANEJO DE GRUPOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ECOL',                  'descripcion' => 'ECOLOGÍA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'EJECUTA JUEGOS Y DINÁMICAS ACUÁTICAS RECREATIVAS PARA EL APROVECHAMIENTO DEL TIEMPO LIBRE']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'ELABORA APLICACIONES INNOVADORAS PARA DISPOSITIVOS ELECTRÓNICOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'EDES.LIB',              'descripcion' => 'ELABORA DOCUMENTOS ELECTRÓNICOS MEDIANTE EL MANEJO DE SOFTWARE LIBRE DE DISEÑO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'EDES.OFI',              'descripcion' => 'ELABORA DOCUMENTOS ELECTRÓNICOS MEDIANTE SOFTWARE DE APLICACIÓN DE OFICINA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'ELABORA PÁGINAS WEB CON ANIMACIONES EN UN AMBIENTE MULTIMEDIA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'KAYAK',                 'descripcion' => 'EMPLEA LAS DIFERENTES TÉCNICAS PARA EL USO SEGURO DEL KAYAK']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'EMPLEA LA TÉCNICA Y SEGURIDAD REQUERIDA PARA LA PRÁCTICA DE RAPPEL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'EMPLEA TÉCNICAS SEGURAS DE NATACIÓN']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'PREP. FIS',             'descripcion' => 'EMPRENDE UN PROGRAMA DE PREPARACIÓN FÍSICA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ENS.EQUP.COMP',         'descripcion' => 'ENSAMBLA EQUIPOS DE CÓMPUTO Y SUS COMPONENTES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'ÉTICA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'FIS.1',                 'descripcion' => 'FÍSICA 1']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'FÍSICA 2']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'GENERA ANIMACIONES INTERACTIVAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'GEOMETRÍA ANALÍTICA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'GEOMT.',                'descripcion' => 'GEOMETRÍA Y TRIGONOMETRÍA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'DES. ORG',              'descripcion' => 'IMPLEMENTA ESTRATEGIAS DE DESARROLLO ORGANIZACIONAL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'IMPLEMENTA LA PRÁCTICA Y ENSEÑANZA DE LA EXPRESIÓN ARTÍSTICA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'IMPLEMENTA LA PRÁCTICA Y ENSEÑANZA DE LA EXPRESIÓN CORPORAL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'IMPLEMENTA TÉCNICAS EN LA PRÁCTICA DE DEPORTES INDIVIDUALES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'IMPLEMENTA TÉCNICAS PARA EL DESARROLLO DE DEPORTES DE CONJUNTO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'IMPLEMENTA UN PROGRAMA DE PREPARACIÓN FÍSICA PAR GRUPOS DE DIFERENTES EDADES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ING. 1',                'descripcion' => 'INGLÉS 1']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ING. 2',                'descripcion' => 'INGLÉS 2']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ING. 3',                'descripcion' => 'INGLÉS 3']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ING. 4',                'descripcion' => 'INGLÉS 4']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ING. 5',                'descripcion' => 'INGLÉS 5']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ECON.',                 'descripcion' => 'INTRODUCCIÓN A LA ECONOMÍA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'LECTURA, EXPRESIÓN ORAL Y ESCRITA 1']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'LEOYE2',                'descripcion' => 'LECTURA, EXPRESIÓN ORAL Y ESCRITA 2']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'LÓGICA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'SIS.OPEQ',              'descripcion' => 'MANEJA EL SISTEMA OPERATIVO Y PRESERVA EL EQUIPO DE CÓMPUTO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'MET. INVES.',           'descripcion' => 'MÉTODOS DE INVESTIGACIÓN']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'OPERA LA PAQUETERÍA DE DISEÑO GRÁFICO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'EXC. Y CAMP',           'descripcion' => 'ORGANIZA ACTIVIDADES AL AIRE LIBRE IMPLEMENTANDO ACCIONES DE EXCURSIONISMO Y CAMPISMO PARA DIFERENTES GRUPOS DE EDADES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ORG.EVE.DEP',           'descripcion' => 'ORGANIZA EVENTOS DEPORTIVOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'EVEN. RECREA',          'descripcion' => 'ORGANIZA UN EVENTO RECREATIVO MASIVO QUE INCLUYA ACTIVIDADES LÚDICAS, CULTURALES Y SOCIALES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'PRACTICA DIVERSOS DEPORTES DE CONJUNTO PARA EL APROVECHAMIENTO DEL TIEMPO LIBRE']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'PRACTICA Y ENSEÑA LOS JUEGOS TRADICIONALES ASÍ COMO LOS DEPORTES AUTÓCTONOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'PREPARA PLATILLOS TÍPICOS DE LA REGIÓN']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'PROB.yEST.',            'descripcion' => 'PROBABILIDAD Y ESTADÍSTICA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'BIEN. FISC..MYS',       'descripcion' => 'PROPONE ACCIONES PARA PROMOVER EL BIENESTAR FÍSICO, MENTAL Y SOCIAL']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'ACT. CAMP',             'descripcion' => 'PROPONE ACTIVIDADES DE CAMPISMO EN EL MARCO DEL CUIDADO DEL MEDIO AMBIENTE']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'PRO.MAN.GPOS',          'descripcion' => 'PROPONE DIFERENTES ESTRATEGIAS PARA EL MANEJO DE GRUPOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'EST. CREAT. P Y S',     'descripcion' => 'PROPONE ESTRATEGIAS CREATIVAS PARA PRODUCTOS Y SERVICIOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'PROPONE ESTRATEGIAS DEPORTIVAS PAR ADULTOS MAYORES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'PROY. ECOT',            'descripcion' => 'PROPONE PROYECTOS ECOTURÍSTICOS INNOVADORES CON FACTIBILIDAD DE APLICARSE EN EL ESTADO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'QUÍMICA 1']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'QUIM. 2',               'descripcion' => 'QUÍMICA 2']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'REC. EXT',              'descripcion' => 'REALIZA PRÁCTICAS DE RECREACIÓN EXTREMA CON DIVERSOS GRUPOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'INV. MKDO.',            'descripcion' => 'REALIZA UNA INVESTIGACIÓN DE MERCADO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'FUN.MKT',               'descripcion' => 'RECONOCE LA IMPORTANCIA DE LOS FUNDAMENTOS DE MERCADOTÉCNIA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'REGISTRA OPERACIONES CONTABLES DE EMPRESAS COMERCIALES Y DE SERVICIOS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'TECNOLOGÍAS DE LA INFORMACIÓN Y LA COMUNICACIÓN']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'BOL.CONTEM',            'descripcion' => 'TEMAS DE BIOLOGÍA CONTEMPORÁNEA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'CIEN. SOC',             'descripcion' => 'TEMAS DE CIENCIAS SOCIALES']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'FILOS.',                'descripcion' => 'TEMAS DE FILOSOFÍA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'INI. DEP. PREDEP',      'descripcion' => 'USA LA INICIACIÓN DEPORTIVA COMO MEDIO DE PROMOCIÓN PREDEPORTIVA']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => '',                      'descripcion' => 'USA TÉCNICAS DE PRIMEROS AUXILIOS EN ACTIVIDADES DE TURISMO ALTERNATIVO']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'TIEM. ACT. REC',        'descripcion' => 'UTILIZA DE MANERA ÓPTIMA EL TIEMPO LIBRE A TRAVÉS DE ACTIVIDADES RECREATIVAS']);
        factory(Asignatura::class,1)->create(['vigente' => 'S','abreviacion' => 'LENG.PROGRAM',          'descripcion' => 'UTILIZA UN LENGUAJE DE PROGRAMACIÓN ESTRUCTURADO']);
    }
}
