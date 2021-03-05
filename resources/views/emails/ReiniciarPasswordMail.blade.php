<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGEEVA - Reiniciar clave de acceso</title>
</head>
<body>

<?php
$nombre = '';
if (!empty($details['nombre']))
    $nombre = $details['nombre'];

$username = '';
if (!empty($details['username']))
    $username = $details['username'];

$claveAcceso = '';
if (!empty($details['claveAcceso']))
    $claveAcceso = $details['claveAcceso'];
?>

    <h1>
        Centro de Estudios de Bachillerato Técnico<br>
        Eva Sámano de López Mateos
    </h1>

    <h2>Buen día {{ $nombre }}</h2>

    <p>
        El Sistema de Gestión Educativa (SIGEEVA), es una herramienta digital creada para el uso de administrativos,
        docentes y en especial para toda nuestra comunidad estudiantil, así como también para los padres de familia.
    </p>

    <p>
        A continuación te presentamos tus datos de acceso:<br><br>

        Usuario:    <b>{{ $username }}</b> <br>
        Contraseña: <b>{{ $claveAcceso }}</b>
    </p>

    <p>
        Recuerda que es importante que no compartas tu usuario y contraseña, ya que alguien más podría tener acceso a
        tus datos personales.
    </p>

    <p>
        Para cualquier situación técnica dentro del sistema, como un mensaje de error o algún comentario respecto al
        mismo:
    </p>

    <ol>
        <li>
            Envía un correo a: sigeeva@evasamano.edu.mx, incluye dentro del mensaje la curp, nombre, carrera, semestre,
            turno del alumno, así como la descripción de lo que esta pasando
        </li>
        <li>
            De igual manera puedes enviar un mensaje mediante whatsapp al número: 9838366717 con el Lic. Antonio Balam
        </li>
    </ol>

    <p>
        AVISO DE PRIVACIDAD: En cumplimiento a la Ley General de Protección de Datos Personales en Posesión de Sujetos
        Obligados y la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados para el Estado de Quintana
        Roo, el Centro de Estudios de Bachillerato Técnico “Eva Sámano de López Mateos”, en su calidad de Sujeto
        Obligado, informa que es el responsable del tratamiento de los Datos Personales que nos proporcione en el Portal
        SIGEEVA, los cuales serán protegidos de conformidad con lo dispuesto en los citados ordenamientos y demás que
        resulten aplicables.
    </p>

</body>
</html>
