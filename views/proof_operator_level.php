<?php
if ($usuarioBitacora == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
}
require_once("../dompdf/dompdf_config.inc.php");
$htmlUno = "";
$htmlDos = "";
$htmlTres = "";
$htmlCuatro = "";
$htmlCinco = "";

if (isset($SedeRol->return->idrol->nombrerol)) {
    $nombreRol = "- ".$SedeRol->return->idrol->nombrerol;
} else {
    $nombreRol = "";
}

if ($contadorPaquetes > 0) {

///Si el contador excede el valor para ver 2 páginas
    if ($contadorPaquetes > 5) {

# Contenido HTML del documento que queremos generar en PDF.
        $htmlUno = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Comprobante de Listado de Paquetes en Nivel 1</title>
<link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
</head>
<body>
<br>
<table align="center" width="500" border="0" >
  <tr>
    <td>
	<img src="../images/header-top-left.png" width="330" height="50">
   	<h2 align="center">Sistema de Correspondencia</h2>
	<h3 align="center">Paquetes Confirmados Hoy '.$nombreRol.'</h3>
    	<table width="500" border="1" id="borde">
			<tr id="bd">
				<td id="bd" style="text-align:center"><strong>Paquete</strong></td>
                                <td id="bd" style="text-align:center"><strong>Origen</strong></td>
                                <td id="bd" style="text-align:center"><strong>Destino</strong></td>
                                <td id="bd" style="text-align:center"><strong>Dirección</strong></td>
				<td id="bd" style="text-align:center"><strong>Teléfono</strong></td>
				<td id="bd" style="text-align:center"><strong>Respuesta al Paquete</strong></td>
  			</tr>';

        for ($i = 0; $i < $contadorPaquetes; $i++) {
            $htmlDos = $htmlDos . '<tr id="bd">
				<td id="bd" align="center"><img src="../images/codigoBarras/'.$idpaq[$i].'.png" width="50" height="10"></td>
                                <td id="bd">' . $origen[$i] . '</td>
                                <td id="bd">' . $destino[$i] . '</td>
                                <td id="bd">' . $direccion[$i] . '</td>
				<td id="bd">' . $telefono[$i] . '</td>
				<td id="bd" align="center">' . $idPaqRes[$i] . '</td>
  			</tr>';
        }

        $htmlTres = '</table>
		<table width="500" border="0">
		<tr>
                    <td colspan="4">&nbsp;</td>
		</tr>
  		<tr>
                    <td colspan="2" align="center"><strong>________________</strong></td>
                    <td colspan="2" align="center"><strong>________________</strong></td>
		  </tr>
  		<tr>
                    <td colspan="2" align="center"><strong>Usuario '.$nombreRol.'</strong></td>
                    <td colspan="2" align="center"><strong>Recepción</strong></td>
		</tr>
	</table>
	</td>
  </tr>
  </table>  
  <br><table style="page-break-after:always"></table><br><br>
  <br><br>
  <br><br>
  <table align="center" width="500" border="0" >
  <tr>
    <td>
	<img src="../images/header-top-left.png" width="330" height="50">
   	<h2 align="center">Sistema de Correspondencia</h2>
	<h3 align="center">Paquetes Confirmados Hoy '.$nombreRol.'</h3>
    	<table width="500" border="1" id="borde">
			<tr id="bd">
				<td id="bd" style="text-align:center"><strong>Paquete</strong></td>
                                <td id="bd" style="text-align:center"><strong>Origen</strong></td>
                                <td id="bd" style="text-align:center"><strong>Destino</strong></td>
                                <td id="bd" style="text-align:center"><strong>Dirección</strong></td>
				<td id="bd" style="text-align:center"><strong>Teléfono</strong></td>
				<td id="bd" style="text-align:center"><strong>Respuesta al Paquete</strong></td>
  			</tr>';

        for ($i = 0; $i < $contadorPaquetes; $i++) {
            $htmlCuatro = $htmlCuatro . '<tr id="bd">
				<td id="bd" align="center">' . $idPaq[$i] . '</td>
                                <td id="bd">' . $origen[$i] . '</td>
                                <td id="bd">' . $destino[$i] . '</td>
                                <td id="bd">' . $direccion[$i] . '</td>
				<td id="bd">' . $telefono[$i] . '</td>
				<td id="bd" align="center">' . $idPaqRes[$i] . '</td>
  			</tr>';
        }

        $htmlCinco = '</table>
		<table width="500" border="0">
		<tr>
                    <td colspan="4">&nbsp;</td>
		</tr>
  		<tr>
                    <td colspan="2" align="center"><strong>________________</strong></td>
                    <td colspan="2" align="center"><strong>________________</strong></td>
		  </tr>
  		<tr>
                    <td colspan="2" align="center"><strong>Usuario '.$nombreRol.'</strong></td>
                    <td colspan="2" align="center"><strong>Recepción</strong></td>
		</tr>
	</table>
	</td>
  </tr>
  </table>  
</body>
</html>
';
    }//Fin del IF
//Si el contador es menor a cinco mando a imprimir una sola hoja
    else {

        $htmlUno = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Comprobante de Listado de Paquetes en Nivel 1</title>
<link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
</head>
<body>
<br>
<table align="center" width="500" border="0" >
  <tr>
    <td>
	<img src="../images/header-top-left.png" width="330" height="50">
   	<h2 align="center">Sistema de Correspondencia</h2>
	<h3 align="center">Paquetes Confirmados Hoy '.$nombreRol.'</h3>
    	<table width="500" border="1" id="borde">
			<tr id="bd">
				<td id="bd" style="text-align:center"><strong>Paquete</strong></td>
                                <td id="bd" style="text-align:center"><strong>Origen</strong></td>
                                <td id="bd" style="text-align:center"><strong>Destino</strong></td>
                                <td id="bd" style="text-align:center"><strong>Dirección</strong></td>
				<td id="bd" style="text-align:center"><strong>Teléfono</strong></td>
				<td id="bd" style="text-align:center"><strong>Respuesta al Paquete</strong></td>
  			</tr>';

        for ($i = 0; $i < $contadorPaquetes; $i++) {
            $htmlDos = $htmlDos . '<tr id="bd">
				<td id="bd" align="center"><img src="../images/codigoBarras/'.$idpaq[$i].'.png" width="50" height="10"></td>
                                <td id="bd">' . $origen[$i] . '</td>
                                <td id="bd">' . $destino[$i] . '</td>
                                <td id="bd">' . $direccion[$i] . '</td>
				<td id="bd">' . $telefono[$i] . '</td>
				<td id="bd" align="center">' . $idPaqRes[$i] . '</td>
  			</tr>';
        }

        $htmlTres = '</table>
		<table width="500" border="0">
		<tr>
                    <td colspan="4">&nbsp;</td>
		</tr>
  		<tr>
                    <td colspan="2" align="center"><strong>________________</strong></td>
                    <td colspan="2" align="center"><strong>________________</strong></td>
		  </tr>
  		<tr>
                    <td colspan="2" align="center"><strong>Usuario '.$nombreRol.'</strong></td>
                    <td colspan="2" align="center"><strong>Recepción</strong></td>
		</tr>
	</table>
	</td>
  </tr>
  <tr>
  	<td><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
  	<td>-------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
  	<td><p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr> 
  <tr>
  	<td>
            <img src="../images/header-top-left.png" width="330" height="50">
            <h2 align="center">Sistema de Correspondencia</h2>
            <h3 align="center">Paquetes Confirmados Hoy '.$nombreRol.'</h3>
            <table width="500" border="1" id="borde">
			<tr id="bd">
				<td id="bd" style="text-align:center"><strong>Paquete</strong></td>
                                <td id="bd" style="text-align:center"><strong>Origen</strong></td>
                                <td id="bd" style="text-align:center"><strong>Destino</strong></td>
                                <td id="bd" style="text-align:center"><strong>Dirección</strong></td>
				<td id="bd" style="text-align:center"><strong>Teléfono</strong></td>
				<td id="bd" style="text-align:center"><strong>Respuesta al Paquete</strong></td>
  			</tr>';

        for ($i = 0; $i < $contadorPaquetes; $i++) {
            $htmlCuatro = $htmlCuatro . '<tr id="bd">
				<td id="bd" align="center">' . $idPaq[$i] . '</td>
                                <td id="bd">' . $origen[$i] . '</td>
                                <td id="bd">' . $destino[$i] . '</td>
                                <td id="bd">' . $direccion[$i] . '</td>
				<td id="bd">' . $telefono[$i] . '</td>
				<td id="bd" align="center">' . $idPaqRes[$i] . '</td>
  			</tr>';
        }

        $htmlCinco = '</table>
		<table width="500" border="0">
		<tr>
                    <td colspan="4">&nbsp;</td>
		</tr>
  		<tr>
                    <td colspan="2" align="center"><strong>________________</strong></td>
                    <td colspan="2" align="center"><strong>________________</strong></td>
		  </tr>
  		<tr>
                    <td colspan="2" align="center"><strong>Usuario '.$nombreRol.'</strong></td>
                    <td colspan="2" align="center"><strong>Recepción</strong></td>
		</tr>
	</table>
	</td>
  </tr>
  </table> 
</body>
</html>
';
    }//Fin del ELSE
//Concatenación de todo
    $html = $htmlUno . $htmlDos . $htmlTres . $htmlCuatro . $htmlCinco;
//Obtenemos el código html de la página web que nos interesa
    $dompdf = new DOMPDF();
//Creamos una instancia a la clase
    $dompdf->load_html($html);
//Esta línea es para hacer la página del PDF más grande
    $dompdf->set_paper('carta', 'portrait');
    $dompdf->render();
    $nom = 'Comprobante Confirmados_' . $contadorPaquetes . ' Paquetes.pdf';
    $dompdf->stream($nom);
}//Fin del IF general
?>