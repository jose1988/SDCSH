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
    if ($SedeRol->return->idrol->idrol != "4" && $SedeRol->return->idrol->idrol != "5") {
        if ($_SESSION["Usuario"]->return->tipousu != "1" && $_SESSION["Usuario"]->return->tipousu != "2") {
            iraURL('../pages/inbox.php');
        }
    }
} else {
    iraURL('../pages/inbox.php');
}

$ideSede = $_SESSION["Sede"]->return->idsed;
$usuario = $_SESSION["Usuario"]->return->idusu;

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $Con = array('idusu' => $usuario,
        'idsede' => $ideSede);
    $resultadoConsultarValijas = $client->consultarStatusValija($Con);

    if (isset($resultadoConsultarValijas->return)) {
        $valijas = count($resultadoConsultarValijas->return);
    } else {
        $valijas = 0;
    }

    if ($valijas > 0) {
        if ($valijas > 1) {
            for ($i = 0; $i < $valijas; $i++) {
                $idSed = $resultadoConsultarValijas->return[$i]->origenval;
                $idSede = array('idSede' => $idSed);
                $resultadoConsultarSede = $client->consultarSedeXId($idSede);
                if (isset($resultadoConsultarSede->return->nombresed)) {
                    $nombreSede[$i] = $resultadoConsultarSede->return->nombresed;
                } else {
                    $nombreSede[$i] = "";
                }
            }
        } else {
            $idSed = $resultadoConsultarValijas->return->origenval;
            $idSede = array('idSede' => $idSed);
            $resultadoConsultarSede = $client->consultarSedeXId($idSede);
            if (isset($resultadoConsultarSede->return->nombresed)) {
                $nombreSede = $resultadoConsultarSede->return->nombresed;
            } else {
                $nombreSede = "";
            }
        }
    }
    include("../views/lost_bag.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/create_valise.php');
}
?>