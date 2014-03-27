<?php
if ($usuarioBitacora == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
}
require_once("../dompdf/dompdf_config.inc.php"); 
$htmlUno = "";
$htmlDos = "";
$htmlTres = "";

$idpaq = $resultadoConsultarUltimoPaquete->return->idpaq;

if (isset($resultadoConsultarUltimoPaquete->return->idpaqres->idpaq)) {
    $idpaqres = $resultadoConsultarUltimoPaquete->return->idpaqres->idpaq;
} else {
    $idpaqres = "";
}

$nombre = $resultadoConsultarUltimoPaquete->return->origenpaq->idusu->nombreusu;

if (isset($resultadoConsultarUltimoPaquete->return->origenpaq->idusu->apellidousu)) {
    $apellido = $resultadoConsultarUltimoPaquete->return->origenpaq->idusu->apellidousu;
} else {
    $apellido = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->destinopaq->idusubuz->nombreusu)) {
    $nombredes = $resultadoConsultarUltimoPaquete->return->destinopaq->idusubuz->nombreusu;
} else {
    $nombredes = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->destinopaq->idusubuz->direccionusu)) {
    $direcciondes = $resultadoConsultarUltimoPaquete->return->destinopaq->idusubuz->direccionusu;
} else {
    $direcciondes = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->destinopaq->idusubuz->telefonousu)) {
    $telefonodes = $resultadoConsultarUltimoPaquete->return->destinopaq->idusubuz->telefonousu;
} else {
    $telefonodes = "";
}

if (isset($resultadoConsultarSede->return->nombresed)) {
    $sede = $resultadoConsultarSede->return->nombresed;
} else {
    $sede = "";
}

$ruta="../images/codigoBarras/".$idpaq.".png";

if (isset($resultadoConsultarUltimoPaquete->return)) {

# Contenido HTML del documento que queremos generar en PDF.
    $htmlUno = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Comprobante de Correspondencia</title>
<link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
</head>
<body>
<br>
<table align="center" width="500" border="0">
  <tr>
    <td>
	<img src="../images/header-top-left.png" width="330" height="50">
   	<h2 align="center">Sistema de Correspondencia</h2>
	<h3 align="center">Comprobante de Paquete</h3>
    	<table width="500" border="0">
  		<tr>
                    <td><strong>Sede: </strong>' . $sede . '</td>
                    <td align="center"><strong>Paquete No: </strong>' . $idpaq . '</td>
  		</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Realizado por: </strong>' . $nombre . ' ' . $apellido . '</td>';
    if ($idpaqres != "") {
        $htmlDos = '<td><strong>Respuesta al Paquete: </strong>' . $idpaqres . '</td>';
    } else {
        $htmlDos = '<td>&nbsp;</td>';
    }

    $htmlDos = $htmlDos . '</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Nombre: </strong>' . $nombredes . '</td>
                    <td><strong>Dirección: </strong>' . ' ' . ' ' . ' ' . $direcciondes . '</td>
  		</tr>
  		<tr>
                    <td><strong>Teléfono: </strong>' . $telefonodes . '</td>
                    <td><strong>Lugar de Envio: </strong>' . $sede . '</td>
  		</tr>
  		<tr>
                    <td colspan="2">&nbsp;</td>
		</tr>
		<tr>
                    <td colspan="2">&nbsp;</td>
		</tr>		
  		<tr>
                    <td align="center"><strong>________________</strong></td>
                    <td align="center"><strong>________________</strong></td>
		</tr>
  		<tr>
                    <td align="center"><strong>Usuario Paquete</strong></td>
                    <td align="center"><strong>Recepción</strong></td>
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
	<h3 align="center">Comprobante de Paquete</h3>
    	<table width="500" border="0">
  		<tr>
                    <td><strong>Sede: </strong>' . $sede . '</td>
                    <td align="center"><strong>Paquete No: </strong>' . $idpaq . '</td>
  		</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Realizado por: </strong>' . $nombre . ' ' . $apellido . '</td>';
    if ($idpaqres != "") {
        $htmlTres = '<td><strong>Respuesta del Paquete: </strong>' . $idpaqres . '</td>';
    } else {
        $htmlTres = '<td>&nbsp;</td>';
    }

    $htmlTres = $htmlTres . '</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Nombre: </strong>' . $nombredes . '</td>
                    <td><strong>Dirección: </strong>' . ' ' . ' ' . ' ' . $direcciondes . '</td>
  		</tr>
  		<tr>
                    <td><strong>Teléfono: </strong>' . $telefonodes . '</td>
                    <td><strong>Lugar de Envio: </strong>' . $sede . '</td>
  		</tr>
  		<tr>
                    <td colspan="2">&nbsp;</td>
		</tr>
		<tr>
                    <td colspan="2">&nbsp;</td>
		</tr>
  		<tr>
                    <td align="center"><strong>________________</strong></td>
                    <td align="center"><strong>________________</strong></td>
		</tr>
  		<tr>
                    <td align="center"><strong>Usuario Paquete</strong></td>
                    <td align="center"><strong>Recepción</strong></td>
		</tr>
	</table>
    </td>
  </tr>
</table> 
</body>
</html>
';

//Concatenación de todo
    $html = $htmlUno . $htmlDos . $htmlTres;
//Obtenemos el código html de la página web que nos interesa
    $dompdf = new DOMPDF();
//Creamos una instancia a la clase
    $dompdf->load_html($html);
//Esta línea es para hacer la página del PDF más grande
    $dompdf->set_paper('carta', 'portrait');
    $dompdf->render();
    $nom = 'Comprobante de Correspondencia Numero ' . $idpaq . '.pdf';
    $dompdf->stream($nom);
}//Fin del IF general
?>