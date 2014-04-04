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

$resultadoConsultarValijas = $_SESSION["valijas"];
$reporte = $_SESSION["Reporte"];
$sede = $_SESSION["Osede"];

$contadorValijas = count($resultadoConsultarValijas->return);

if ($reporte == '1') {
    $nombreReporte = "Valijas Enviadas";
} elseif ($reporte == '2') {
    $nombreReporte = "Valijas Recibidas";
} elseif ($reporte == '3') {
    $nombreReporte = "Valijas con Errores";
} elseif ($reporte == '4') {
    $nombreReporte = "Valijas Anuladas";
}
$contadorSedes = 0;
$opcionSede = "";
if ($sede == '0') {
    try {
		echo "Entro";
        $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->decode_utf8 = false;
        $resultadoSedes = $client->listarSedes();
        if (isset($resultadoSedes->return)) {
            $contadorSedes = count($resultadoSedes->return);
        } else {
            $contadorSedes = 0;
        }
		
		include("../graphics/reports_valise_horizontally.php");
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexion');
        iraURL('../pages/reports_valise.php');
    }
} else {
    try {
        $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->decode_utf8 = false;
        $idSede = array('idSede' => $sede);
        $resultadoConsultarSede = $client->consultarSedeXId($idSede);
        if (isset($resultadoConsultarSede->return)) {
            $opcionSede = $resultadoConsultarSede->return->nombresed;
        } else {
            $cpcionSede = "";
        }
		
		include("../graphics/reports_valise_vertical.php");
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexion');
        iraURL('../pages/reports_valise.php');
    }
}
?>