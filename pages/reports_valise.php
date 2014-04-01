<?php

session_start();
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
}

if ($_SESSION["Usuario"]->return->tipousu != "1" && $_SESSION["Usuario"]->return->tipousu != "2") {
    iraURL('../pages/inbox.php');
}

$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
$SedeRol = $client->consultarSedeRol($UsuarioRol);
if (isset($SedeRol->return)) {
    if ($SedeRol->return->idrol->idrol == 0) {
        iraURL("../pages/inbox.php");
    }
} else {
    iraURL("../pages/index.php");
}

$ideSede = $_SESSION["Sede"]->return->idsed;
$usuario = $_SESSION["Usuario"]->return->idusu;

$resultadoSedes = $client->listarSedes();
if (!isset($resultadoSedes->return)) {
    $sedes = 0;
} else {
    $sedes = count($resultadoSedes->return);
}

if (isset($_POST["cosultar"])) {

    if (isset($_POST["reporte"]) && $_POST["reporte"] != "" && isset($_POST["sede"]) && $_POST["sede"] != "" && isset($_POST["opcion"]) && $_POST["opcion"] != "") {
        
    } else {
        javaalert("Debe agregar todos los campos, por favor verifique");
    }
}

include("../views/reports_valise.php");
?>