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
        iraURL('../pages/inbox.php');
    }
} else {
    iraURL('../pages/inbox.php');
}

$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;
$sede = $_SESSION["Sede"]->return->idsed;

$resultadoProveedor = $client->consultarProveedor();
if (!isset($resultadoProveedor->return)) {
    $proveedor = 0;
} else {
    $proveedor = count($resultadoProveedor->return);
}

if (isset($_POST["confirmar"])) {

    if (isset($_POST["cValija"]) && $_POST["cValija"] != "" && isset($_POST["cProveedor"]) && $_POST["cProveedor"] != "" && isset($_POST["proveedor"]) && $_POST["proveedor"] != "") {

        try {
            $parametros = array('idValija' => $_POST["cValija"],
                'proveedor' => $_POST["proveedor"],
                'codProveedor' => $_POST["cProveedor"]);
            $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
            $client = new SOAPClient($wsdl_url);
            $client->decode_utf8 = false;
            $confirmarValija = $client->confirmarValija($parametros);

            if (isset($confirmarValija->return) == 1) {
                javaalert('Valija Confirmada');
                llenarLog(2, "Confirmación Valija", $usuarioBitacora, $sede);
                iraURL('../pages/create_valise.php');
            } else {
                javaalert('Valija No Confirmada');
                iraURL('../pages/create_valise.php');
            }
        } catch (Exception $e) {
            javaalert('Lo sentimos no hay conexion');
            iraURL('../pages/create_valise.php');
        }
    } else {
        javaalert("Debe agregar todos los campos, por favor verifique");
    }
}
include("../views/confirm_valise.php");
?>