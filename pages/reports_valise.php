<?php
session_start();
include("../recursos/funciones.php");
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

if (isset($SedeRol->return)) {
    if ($SedeRol->return->idrol->idrol != "4" && $SedeRol->return->idrol->idrol != "5") {
        iraURL('../pages/inbox.php');
    }
} else {
    iraURL('../pages/inbox.php');
}

$ideSede = $_SESSION["Sede"]->return->idsed;
$usuario = $_SESSION["Usuario"]->return->idusu;
$valijasProcesadas = 0;
$valijasNoProcesadas = 0;

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;

    $parametros = array('registroSede' => $ideSede,
        'registroUsuario' => $usuario);
    $resultadoConsultarValijas = $client->listarValijasXFechaYUsuarioSede($parametros);

    if (!isset($resultadoConsultarValijas->return)) {
        $valijas = 0;
    } else {
        $valijas = count($resultadoConsultarValijas->return);
    }

    $resultadoValijasNoProcesadas = $client->listarValijasNoProcesadas($parametros);
    if (!isset($resultadoValijasNoProcesadas->return)) {
        $valijasNoProcesadas = 0;
    } else {
        $valijasNoProcesadas = count($resultadoValijasNoProcesadas->return);
    }

    $resultadoValijasProcesadas = $client->listarValijasProcesadas($parametros);
    if (!isset($resultadoValijasProcesadas->return)) {
        $valijasProcesadas = 0;
    } else {
        $valijasProcesadas = count($resultadoValijasProcesadas->return);
    }
    include("../views/reports_valise.php");
    
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/create_valise.php');
}
?>