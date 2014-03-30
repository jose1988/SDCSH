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

$_SESSION["paqueteDos"] = "";
$_SESSION["codigoDos"] = "";

$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
$SedeRol = $client->consultarSedeRol($UsuarioRol);

$nomUsuario = $_SESSION["Usuario"]->return->userusu;
$ideSede = $_SESSION["Sede"]->return->idsed;
$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;
$idPaq = $_GET["id"];

if ($idPaq == "") {
    iraURL('../pages/inbox.php');
} 
else {
	try {
    	$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    	$client = new SOAPClient($wsdl_url);
    	$client->decode_utf8 = false;

    	$usuario = array('user' => $nomUsuario);
    	$resultadoConsultarUsuario = $client->consultarUsuarioXUser($usuario);

	    if (!isset($resultadoConsultarUsuario->return)) {
    	    $usua = 0;
    	} else {
        	$usua = $resultadoConsultarUsuario->return;
    	}

    	$idUsuario = $resultadoConsultarUsuario->return->idusu;

    	try {
        	$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        	$client = new SOAPClient($wsdl_url);
        	$client->decode_utf8 = false;

        	$idPaquete = array('idPaquete' => $idPaq);
        	$resultadoConsultarPaquete = $client->consultarPaqueteXId($idPaquete);

        	$idSede = array('idSede' => $ideSede);
        	$resultadoConsultarSede = $client->consultarSedeXId($idSede);	

			$codigoSede = $resultadoConsultarSede->return->codigosed;		
			$fecha = date("Y");
			$idpaq = $resultadoConsultarPaquete->return->idpaq;
		
			$codigoTotal=$codigoSede.$fecha.$idpaq;
			guardarImagen($codigoTotal);
				
			$_SESSION["paqueteDos"] = $resultadoConsultarPaquete;
			$_SESSION["codigoDos"] = $codigoTotal;

        	llenarLog(6, "Comprobante de Correspondencia", $usuarioBitacora, $ideSede);		
			echo"<script>window.open('../pdf/proof_of_correspondence_package.php');</script>";
			//iraURL('../pdf/proof_of_correspondence_package.php');
        
    	} catch (Exception $e) {
        	javaalert('Lo sentimos no hay conexion');
        	iraURL('../pages/inbox.php');
    	}	
		//iraURL('../pages/inbox.php');
		
	} catch (Exception $e) {
    	javaalert('Lo sentimos no hay conexion');
    	iraURL('../pages/inbox.php');
	}
}
?>