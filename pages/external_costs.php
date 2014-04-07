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

    if (isset($SedeRol->return)) {
        if ($SedeRol->return->idrol->idrol != "2" && $SedeRol->return->idrol->idrol != "5") {
            iraURL('../pages/inbox.php');
        }
    } else {
        iraURL('../pages/inbox.php');
    }
    $sede = array('idsed' => $_SESSION["Sede"]->return->idsed);
    $parametros = array('sede' => $sede);
    $PaquetesExternos = $client->consultarPaquetesExternosXEnviar($parametros);
    include("../views/external_costs.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/inbox.php');
}
?>