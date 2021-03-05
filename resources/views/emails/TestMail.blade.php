<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGEEVA - Datos de acceso</title>
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

    <h2>Bienvenid@ {{ $nombre }}</h2>

    <p>
        El Sistema de Gestión Educativa (SIGEEVA), es una herramienta digital creada para el uso de administrativos,
        docentes y en especial para toda nuestra comunidad estudiantil, así como también para los padres de familia.
    </p>

    <p>
        Tus datos de acceso son:<br><br>

        Usuario:    <b>{{ $username }}</b> <br>
        Contraseña: <b>{{ $claveAcceso }}</b>
    </p>

    <h3>Los pasos que necesitas realizar son los siguientes:</h3>

    <ol>
        <li>
            Entra al apartado del SIGEEVA dentro de nuestro portal institucional, a través de la siguiente dirección:
            <a href="http://evasamano.edu.mx/web/pages/sigeeva.php">
            http://evasamano.edu.mx/web/pages/sigeeva.php
            </a>
        </li>
        <li>
            Dentro del apartado SIGEEVA dentro de nuestro portal, está la sección del alumno, en ella encontrarás un
            archivo en formato pdf, el cual te servirá como guía para las opciones que tendrás dentro del sistema,
            esta guía estará en continuo crecimiento conforme se vayan agregando más secciones a nuestro sistema SIGEEVA.
        </li>
        <li>
            Para visualizar el sistema SIGEEVA, es necesario presionar el botón IR AL SIGEEVA WEB que se encuentra
            dentro de nuestro portal.
        </li>
        <li>
            Una vez visualizado el sistema SIGEEVA, solamente tienes que seguir los pasos que se detallan en la guía
            que hemos creado para ti.
        </li>
    </ol>

    <p>
        Recuerda que es importante que no compartas tu usuario y contraseña, ya que alguien más podría tener acceso a
        tus datos personales.
    </p>

    <p>
        Para cualquier situación técnica dentro del sistema, como un mensaje de error o algún comentario respecto al
        mismo, envía un correo a: sigeeva@evasamano.edu.mx, incluye dentro del mensaje los datos del alumno.
    </p>

    <p>Gracias por su solicitud</p>

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
