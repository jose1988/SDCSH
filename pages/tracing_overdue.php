<?php

session_start();

include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
}
try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
    $SedeRol = $client->consultarSedeRol($UsuarioRol);
    $usu = array('iduse' => $SedeRol->return->iduse);
    $parametros = array('usuarioSede' => $usu);
    $PaquetesDestino = $client->paquetesVencidosXSeguimiento($parametros);
    
    include("../views/tracing_overdue.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/inbox.php');
}
?>