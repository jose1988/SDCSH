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
    if ($SedeRol->return->idrol->idrol != "1" && $SedeRol->return->idrol->idrol != "3") {
        iraURL('../pages/inbox.php');
    }
} else {
    iraURL('../pages/inbox.php');
}

$nomUsuario = $_SESSION["Usuario"]->return->userusu;
$_SESSION["paquetesConfirmados"] = "";
$_SESSION["paquetes"] = "";

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;

    $usuario = array('user' => $nomUsuario);
    $resultadoConsultarUsuario = $client->consultarUsuarioXUser($usuario);

    if (!isset($resultadoConsultarUsuario->return)) {
        $usua = 0;
    } else {
        $usua = $resultadoConsultarUsuario->return;
    }

    $idUsuario = $resultadoConsultarUsuario->return->idusu;

    try {
        $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->decode_utf8 = false;

     
	  $usu = array('idusu' => $_SESSION["Usuario"]->return->idusu);
       $sede = array('idsed' => $_SESSION["Sede"]->return->idsed);
   $parametros = array('idUsuario' => $usu,'sede'=>$sede);
   $resultadoPaquetesConfirmados = $client->consultarPaquetesXUsuarioProcesadasAlDia($parametros);

        if (!isset($resultadoPaquetesConfirmados->return)) {
            $paquetes = 0;
        } else {
            $paquetes = count($resultadoPaquetesConfirmados->return);
        }
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexion');
        iraURL('../pages/operator_level.php');
    }

    if (isset($_POST["imprimir"])) {

        if (isset($_POST["ide"])) {

            $imprimirPaquetes = $_POST["ide"];
            $_SESSION["paquetesConfirmados"] = $resultadoPaquetesConfirmados;
            $_SESSION["paquetes"] = $imprimirPaquetes;
            echo"<script>window.open('../pages/proof_operator_level.php');</script>";
        } else {
            javaalert("Debe seleccionar al menos un paquete, por favor verifique");
        }
    }
    include("../views/print_operator_level.php");
    
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/operator_level.php');
}
?>