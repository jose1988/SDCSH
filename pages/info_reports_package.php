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

$_SESSION["paquetes"] = "";

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $resultadoConsultarPaquetes = $client->listarPaquetes();

    if (isset($resultadoConsultarPaquetes->return)) {
        $paquetes = count($resultadoConsultarPaquetes->return);
    } else {
        $paquetes = 0;
    }

    $_SESSION["paquetes"] = $resultadoConsultarPaquetes;

    if ($paquetes > 0) {
        //$reporte = $_SESSION["Reporte"];
        $reporte = '1';
        if ($reporte == '1') {
            $nombreReporte = "Paquetes Enviados";
        } elseif ($reporte == '2') {
            $nombreReporte = "Paquetes Recibidos";
        } elseif ($reporte == '3') {
            $nombreReporte = "Paquetes por Entregar";
        }
    }

    if (isset($_POST["imprimir"])) {
        echo"<script>window.open('../pages/proof_reporting_package.php');</script>";
    }

    if (isset($_POST["graficar"])) {
        echo"<script>window.open('../pages/graphics_reports_package.php');</script>";
    }

    include("../views/info_reports_package.php");
} catch (Exception $e) {

    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/reports_package.php');
}
?>