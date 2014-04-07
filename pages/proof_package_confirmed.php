<?php

session_start();
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
}

$paquetes = $_SESSION["paquetes"];
$paquetesConfirmados = $_SESSION["paquetesConfirmados"];
$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;
$sede = $_SESSION["Sede"]->return->idsed;
$codigos = $_SESSION["codigos"];

$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
$SedeRol = $client->consultarSedeRol($UsuarioRol);

if (isset($SedeRol->return)) {
    if ($SedeRol->return->idrol->idrol != "1" && $SedeRol->return->idrol->idrol != "3") {
        iraURL('../pages/inbox.php');
    }
} else {
    iraURL('../pages/inbox.php');
}

$_SESSION["paquetesTotales"] = "";
$_SESSION["rol"] = "";

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $i = 0;
    $contadorPaq = 0;
    $paquetesTotales = "";

    for ($j = 0; $j < count($paquetesConfirmados->return); $j++) {
        if (isset($paquetes[$j])) {
            $idPaquete = array('idPaquete' => $paquetes[$j]);
            $resultadoPaquete = $client->consultarPaqueteXId($idPaquete);
            $paquetesTotales[$i] = $resultadoPaquete->return;
            $_SESSION["paquetesTotales"][$i] = $paquetesTotales[$i];
            $i++;
            $contadorPaq++;
        }
        if ($contadorPaq == count($paquetes)) {
            break;
        }
    }
    if ($paquetesTotales != "") {
        $contadorPaquetes = count($paquetesTotales);
        $_SESSION["rol"] = $SedeRol->return->idrol->nombrerol;
        llenarLog(6, "Comprobante de Paquetes Confirmados", $usuarioBitacora, $sede);
        echo"<script>window.open('../pdf/proof_package_confirmed.php');</script>";
        //iraURL('../pdf/proof_package_confirmed.php');
    } else {
        $contadorPaquetes = 0;
    }
    iraURL('../pages/print_packages_confirmed.php');
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/print_packages_confirmed.php');
}
?>