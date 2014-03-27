<?php
if ($usuarioBitacora == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
}
require_once("../dompdf/dompdf_config.inc.php");

$idval = $resultadoConsultarUltimaValija->return->idval;

$nombre = $resultadoConsultarUltimaValija->return->idusu->nombreusu;

if (isset($resultadoConsultarUltimaValija->return->origenpaq->idusu->apellidousu)) {
    $apellido = $resultadoConsultarUltimaValija->return->origenpaq->idusu->apellidousu;
} else {
    $apellido = "";
}

if (isset($resultadoConsultarUltimaValija->return->destinoval->nombresed)) {
    $nombredes = $resultadoConsultarUltimaValija->return->destinoval->nombresed;
} else {
    $nombredes = "";
}

if (isset($resultadoConsultarUltimaValija->return->destinoval->direccionsed)) {
    $direcciondes = $resultadoConsultarUltimaValija->return->destinoval->direccionsed;
} else {
    $direcciondes = "";
}

if (isset($resultadoConsultarUltimaValija->return->destinoval->telefonosed)) {
    $telefonodes = $resultadoConsultarUltimaValija->return->destinoval->telefonosed;
} else {
    $telefonodes = "";
}

if (isset($resultadoConsultarSede->return->nombresed)) {
    $sede = $resultadoConsultarSede->return->nombresed;
} else {
    $sede = "";
}

if (isset($resultadoConsultarUltimaValija->return)) {

# Contenido HTML del documento que queremos generar en PDF.
    $html = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Comprobante de Valija</title>
<link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
</head>
<body>
<br>
<table align="center" width="500" border="0" >
  <tr>
    <td>
            <img src="../images/header-top-left.png" width="330" height="50">
            <h2 align="center">Sistema de Correspondencia</h2>
            <h3 align="center">Comprobante de Valija</h3>
            <table width="500" border="0">
  		<tr>
                    <td><strong>Sede: </strong>' . $sede . '</td>
                    <td align="center"><strong>Valija No: </strong>' . $idval . '</td>
  		</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Realizado por: </strong>' . $nombre . ' ' . $apellido . '</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Sede Destino: </strong>' . $nombredes . '</td>
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
                    <td align="center"><strong>Usuario Valija</strong></td>
                    <td align="center"><strong>Recepción Zoom</strong></td>
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
            <h3 align="center">Comprobante de Valija</h3>
            <table width="500" border="0">
  		<tr>
                    <td><strong>Sede: </strong>' . $sede . '</td>
                    <td align="center"><strong>Valija No: </strong>' . $idval . '</td>
  		</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Realizado por: </strong>' . $nombre . ' ' . $apellido . '</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
  		</tr>
  		<tr>
                    <td><strong>Sede Destino: </strong>' . $nombredes . '</td>
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
                    <td align="center"><strong>Usuario Valija</strong></td>
                    <td align="center"><strong>Recepción Zoom</strong></td>
		</tr>
	</table>
    </td>
  </tr>
</table> 
</body>
</html>
';

//Obtenemos el código html de la página web que nos interesa
    $dompdf = new DOMPDF();
//Creamos una instancia a la clase
    $dompdf->load_html($html);
//Esta línea es para hacer la página del PDF más grande
    $dompdf->set_paper('carta', 'portrait');
    $dompdf->render();
    $nom = 'Comprobante de Valija Numero ' . $idval . '.pdf';
    $dompdf->stream($nom);
}//Fin del IF general
?>