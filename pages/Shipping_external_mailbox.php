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
    $BandejaUsu = $client->consultarBandejas();
    $Usuario = array('user' => $_SESSION["Usuario"]->return->idusu, 'ban' => $BandejaUsu->return[$i]->nombreiba);

    $Ban = array('ban' => $BandejaUsu->return[$i]->nombreiba);
    $Bandeja = $client->consultarPaquetesXBandeja($Usuario);
    $UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
    $SedeRol = $client->consultarSedeRol($UsuarioRol);
    $reg = 0;
    if (isset($BandejaUsu->return)) {
        $reg = count($BandejaUsu->return);
    }
    if (isset($SedeRol->return)) {
        if ($SedeRol->return->idrol->idrol == 0) {
            iraURL("../pages/inbox.php");
        }
    } else {
        iraURL('../pages/inbox.php');
    }
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexión');
    iraURL('../pages/inbox.php');
}
include("../views/shipping_external_mailbox.php");
?>