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

        $idpaq = $resultadoConsultarUltimoPaquete->return->idpaq;
        guardarImagen($idpaq);

        llenarLog(6, "Comprobante de Correspondencia", $usuarioBitacora, $ideSede);
        /* echo"<script language='javascript'>window.location='../pages/inbox.php';</script>"; */
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexion');
        iraURL('../pages/send_correspondence.php');
    }
    include("../pdf/proof_of_correspondence.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/send_correspondence.php');
}
?>