<?php

session_start();
try {
    include("../recursos/funciones.php");
    require_once('../lib/nusoap.php');
    if (!isset($_SESSION["Usuario"])) {
        iraURL("../pages/index.php");
    }
    
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $status = array('status' => "1");
    $ListaUsu = $client->ListarUsuarios($status);
    $reg = 0;
    if (isset($ListaUsu->return)) {
        $reg = count($ListaUsu->return);
    }
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/index.php');
}
include("../views/adminUsuario.php");
?>