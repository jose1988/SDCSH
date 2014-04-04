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

$_SESSION["paquete"] = "";
$_SESSION["codigo"] = "";
$_SESSION["fecha"] = "";

$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
$SedeRol = $client->consultarSedeRol($UsuarioRol);

$nomUsuario = $_SESSION["Usuario"]->return->userusu;
$ideSede = $_SESSION["Sede"]->return->idsed;
$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;

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

        $idUsu = array('idUsuario' => $idUsuario);
        $resultadoConsultarUltimoPaquete = $client->ultimoPaqueteXOrigen($idUsu);

        $idSede = array('idSede' => $ideSede);
        $resultadoConsultarSede = $client->consultarSedeXId($idSede);

        $codigoSede = $resultadoConsultarSede->return->codigosed;
        $fechaCod = date("Y");
        $idpaq = $resultadoConsultarUltimoPaquete->return->idpaq;

        $codigoTotal = $codigoSede . $fechaCod . $idpaq;
        guardarImagen($codigoTotal);		
		
		if (isset($resultadoConsultarUltimoPaquete->return->fechapaq)) {
			$fecha = FechaHora($resultadoConsultarUltimoPaquete->return->fechapaq);
		} else {
    		$fecha = "";
		}

        $_SESSION["paquete"] = $resultadoConsultarUltimoPaquete;
        $_SESSION["codigo"] = $codigoTotal;
		$_SESSION["fecha"] = $fecha;
		
		if(isset($resultadoConsultarUltimoPaquete->return)){
        	llenarLog(6, "Comprobante de Correspondencia", $usuarioBitacora, $ideSede);
        	echo"<script>window.open('../pdf/proof_of_correspondence.php','fullscreen');</script>";
        	//iraURL('../pdf/proof_of_correspondence.php');
		}
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexion');
        iraURL('../pages/send_correspondence.php');
    }
    //iraURL('../pages/inbox.php');
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/send_correspondence.php');
}
?>