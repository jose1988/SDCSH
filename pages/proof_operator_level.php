<?php

session_start();
include("../recursos/funciones.php");
include("../recursos/codigoBarrasPdf.php");
require_once('../lib/nusoap.php');

if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
}

$_SESSION["paquetes"] = "";
$_SESSION["codigos"] = "";
$_SESSION["origenes"] = "";
$_SESSION["destinos"] = "";
$_SESSION["sedes"] = "";

$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
$SedeRol = $client->consultarSedeRol($UsuarioRol);

/*if (isset($SedeRol->return)) {
    if ($SedeRol->return->idrol->idrol != "1" && $SedeRol->return->idrol->idrol != "3") {
        iraURL('../pages/inbox.php');
    }
} else {
    iraURL('../pages/inbox.php');
}*/

$paquetes = $_SESSION["paquetes"];
$paquetesConfirmados = $_SESSION["paquetesConfirmados"];
$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;
$sede = $_SESSION["Sede"]->return->idsed;

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $i = 0;
    $contadorPaq = 0;
    $paquetesTotales = "";
	
	$idSede = array('idSede' => $sede);
    $resultadoConsultarSede = $client->consultarSedeXId($idSede);
	$codigoSede = $resultadoConsultarSede->return->codigosed;
	$fecha = date("Y");

    for ($j = 0; $j < count($paquetesConfirmados->return); $j++) {
        if (isset($paquetes[$j])) {
            $idPaquete = array('idPaquete' => $paquetes[$j]);
            $resultadoPaquete = $client->consultarPaqueteXId($idPaquete);
            $paquetesTotales[$i] = $resultadoPaquete->return;
			
            $idPaq[$i] = $resultadoPaquete->return->idpaq;		
			$codigoTotal[$i]=$codigoSede.$fecha.$idpaq[$i];
			guardarImagen($codigoTotal[$i]);			
			
            if (isset($resultadoConsultarPaquete->return->origenpaq->nombrebuz)) {
    			$nombreOrig[$i] = $resultadoConsultarPaquete->return->origenpaq->nombrebuz;
			} else {
    			$nombreOrig[$i] = "";
			}
            if (isset($resultadoConsultarPaquete->return->destinopaq->nombrebuz)) {
    			$nombreDest[$i] = $resultadoConsultarPaquete->return->destinopaq->nombrebuz;
			} else {
    			$nombreDest[$i] = "";
			}
			if (isset($resultadoConsultarPaquete->return->idsed->nombresed)) {
    			$sede[$i] = $resultadoConsultarPaquete->return->idsed->nombresed;
			} else {
    			$sede[$i] = "";
			}
            $i++;
            $contadorPaq++;
        }
        if ($contadorPaq == count($paquetes)) {
            break;
        }
    }

    if ($paquetesTotales != "") {
        $contadorPaquetes = count($paquetesTotales);
        llenarLog(6, "Comprobante Nivel 1", $usuarioBitacora, $sede);
		
        /*echo"<script>window.open('../pdf/proof_operator_level.php');</script>";*/
		iraURL('../pdf/proof_operator_level.php');
    } else {
        $contadorPaquetes = 0;
    }
    /*echo"<script language='javascript'>window.location='../pages/operator_level.php';</script>";*/
	
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/print_operator_level.php');
}
?>