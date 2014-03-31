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

$idPaquete = $_GET["id"];
$usuario = $_SESSION["Usuario"]->return->idusu;

if ($idPaquete == "") {
    iraURL('../pages/inbox.php');
} else {
    try {
        $paquete = array('idPaquete' => $idPaquete);
        $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->decode_utf8 = false;
        $resultadoPaquete = $client->consultarSeguimientoXPaquete($paquete);

        if (!isset($resultadoPaquete->return)) {
            $segumientoPaquete = 0;
        } else {
            $segumientoPaquete = count($resultadoPaquete->return);
        }
        include("../views/see_package.php");
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexion');
        iraURL('../pages/inbox.php');
    }
}
?>