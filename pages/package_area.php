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
    if ($SedeRol->return->idrol->idrol != "2") {
        iraURL("../pages/inbox.php");
    }
} else {
    iraURL('../pages/inbox.php');
}

$usu = $_SESSION["Usuario"]->return->idusu;
$sede = $_SESSION["Sede"]->return->idsed;

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $datos = array('idusu' => $usu, 'idsed' => $sede);
    $resultadoLista = $client->consultarPaquetesporArea($datos);

    if (!isset($resultadoLista->return)) {
        $bitacora = 0;
    } else {
        $bitacora = count($resultadoLista->return);
    }
    include("../views/packege_area.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/administration.php');
}
?>