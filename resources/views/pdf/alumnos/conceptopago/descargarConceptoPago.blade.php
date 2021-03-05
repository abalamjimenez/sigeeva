<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formato de apoyo a la educación</title>
    <style>
        body{
            font-family: sans-serif;
            font-size:.8em;
        }
        header {
            margin-bottom:1em;
        }
        header h1 {
            font-size:1em;
            text-align: center;
            margin:0px;
            padding:0px;
        }
        header h2 {
            font-size:.8em;
            text-align: center;
            margin:0px;
            padding:0px;
        }
        table{
            font-size:.9em;
        }
        table .border1 {
            border:1px solid;
        }
        table > tr > td {
            padding:10em;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -60px;
            right: 0px;
            height: 80px;
        }
        .titulo {
            font-size:1em;
            margin-top:1em;
            margin-bottom: 1em;
            text-align: center;
        }
    </style>
<body>

<header>
    <table width="100%">
        <tr>
            <td width="25%" align="center">
                <img src="{{ asset('img/logo_reporte_eva.png') }}">
            </td>
            <td width="50%">
                <h1>CENTRO DE ESTUDIOS DE BACHILLERATO TÉCNICO</h1>
                <h2>"EVA SÁMANO DE LÓPEZ MATEOS"</h2>
            </td>
            <td align="center">
                <img src="{{ asset('img/logo_reporte_seq.png') }}">
            </td>
        </tr>
    </table>

    <div class="titulo">
        FICHA DE DEPÓSITO<br>
        {{ $datosFormato['periodo_escolar'] }}
    </div>

    <table align="center" cellpadding="1.5em" cellspacing="10em">
        <tr>
            <th align="left">NOMBRE DEL ALUMNO:</th>
            <td colspan="5">
                {{ $datosFormato['nombre_completo'] }}
            </td>
        </tr>
        <tr>
            <th align="left">NÚMERO DE CONTROL:</th>
            <td>{{ $datosFormato['numero_control'] }}</td>
            <th align="left">CARRERA:</th>
            <td>{{ $datosFormato['carrera'] }}</td>
            <th align="left">TURNO:</th>
            <td>{{ $datosFormato['turno'] }}</td>
        </tr>
        <tr>
            <th align="left">REFERENCIA BANCARIA</th>
            <td colspan="5">
                {{ $datosFormato['referencia_bancaria'] }}
            </td>
        </tr>
        <tr>
            <th align="left">CONVENIO:</th>
            <td colspan="5">
                {{ $datosFormato['concepto_pago_convenio'] }}
            </td>
        </tr>
        <tr>
            <th align="left">IMPORTE A DEPOSITAR:</th>
            <td colspan="5">
                {{ $datosFormato['concepto_pago_costo'] }}
            </td>
        </tr>
    </table>

    <div style="font-size:1em; text-align: center; font-weight: bold; margin-top:2em; margin-bottom: 2em">
        {{ $datosFormato['concepto_pago_etiqueta'] }}

        @if(!empty($datosFormato['concepto_pago_mensaje']))
            <blockquote>
                {{ $datosFormato['concepto_pago_mensaje'] }}
            </blockquote >
        @endif
    </div>

    <div style="padding-left: 15%">
        NOTA: Presentar la siguiente documentación en la Dirección del Plantel.

        <ul>
            <li>Original de tu ficha de depósito o comprobante bancario</li>
            <li>2 Copias de tu ficha de depósito con la referencia bancaria en la misma (puedes usar esta cedula).</li>
        </ul>
    </div>



</header>

<footer>
    <p>Fecha de impresión: {{ date('d-m-Y') }}</p>
</footer>

</body>
</html>
