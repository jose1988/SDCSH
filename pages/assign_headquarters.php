<?php

session_start();
try {
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
    $i = 0;
    $Sedes = $client->ConsultarSedes();
    $reg = 0;
    if (isset($Sedes->return)) {
        $reg = count($Sedes->return);
    }
    $UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
    $SedeRol = $client->consultarSedeRol($UsuarioRol);
    if (isset($SedeRol->return)) {
        if ($SedeRol->return->idusu->tipousu != "1" && $SedeRol->return->idusu->tipousu != "2") {
            iraURL('../pages/inbox.php');
        }
    } else {
        iraURL('../pages/inbox.php');
    }
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/index.php');
}
include("../views/assign_headquarters.php");
?>