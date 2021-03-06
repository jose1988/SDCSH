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
    if ($SedeRol->return->idusu->tipousu != "1" && $SedeRol->return->idusu->tipousu != "2") {
        iraURL('../pages/inbox.php');
    }
} else {
    iraURL('../pages/inbox.php');
}

$ideSede = $_SESSION["Sede"]->return->idsed;
$usuario = $_SESSION["Usuario"]->return->idusu;

$resultadoSedes = $client->listarSedes();
if (!isset($resultadoSedes->return)) {
    $sedes = 0;
} else {
    $sedes = count($resultadoSedes->return);
}

$_SESSION["Reporte"] = "";
$_SESSION["Osede"] = "";
$_SESSION["Opcion"] = "";
$_SESSION["Fechaini"] = "";
$_SESSION["Fechafin"] = "";

if (isset($_POST["consultar"])) {
    if (isset($_POST["reporte"]) && $_POST["reporte"] != "" && isset($_POST["osede"]) && $_POST["osede"] != "" && isset($_POST["opcion"]) && $_POST["opcion"] != "") {

        $_SESSION["Reporte"] = $_POST["reporte"];
        $_SESSION["Osede"] = $_POST["osede"];
        $_SESSION["Opcion"] = $_POST["opcion"];
        $_SESSION["Fechaini"] = $_POST["datepicker"];
        $_SESSION["Fechafin"] = $_POST["datepickerf"];

        iraURL("../pages/info_reports_package.php");
    } else {
        javaalert("Debe agregar todos los campos, por favor verifique");
    }
}
include("../views/reports_package.php");
?>