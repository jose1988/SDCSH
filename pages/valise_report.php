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

if(isset($SedeRol->return)){
	if($SedeRol->return->idrol->idrol!="4" && $SedeRol->return->idrol->idrol!="5"){
  		iraURL('../pages/inbox.php');
  	}
}else{
	iraURL('../pages/inbox.php');
}

$nomUsuario = $_SESSION["Usuario"]->return->userusu;
$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;
$sede = $_SESSION["Sede"]->return->idsed;

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


    if (isset($_POST["reportarPaqExc"])) {

        if (isset($_POST["cPaquete"]) && $_POST["cPaquete"] != "" && isset($_POST["datosPaquete"]) && $_POST["datosPaquete"] != "") {

            try {
                $parametros = array('registroPaquete' => $_POST["cPaquete"],
                    'registroUsuario' => $idUsuario,
                    'registroSede' => $sede,
                    'datosPaquete' => $_POST["datosPaquete"]);
                $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
                $client = new SOAPClient($wsdl_url);
                $client->decode_utf8 = false;
                $reportarPaqExc = $client->reportarPaqueteExcedente($parametros);

                if ($reportarPaqExc->return == 1) {
                    javaalert('Paquete Reportado y Reenviado');
                    llenarLog(7, "Paquete Excedente", $usuarioBitacora, $sede);
                    iraURL('../pages/create_valise.php');
                } else {
                    javaalert('Paquete No Reportado y No Reenviado');
                    iraURL('../pages/create_valise.php');
                }
            } catch (Exception $e) {
                javaalert('Lo sentimos no hay conexión');
                iraURL('../pages/create_valise.php');
            }
        } else {
            javaalert("Debe agregar todos los campos, por favor verifique");
        }
    }

    if (isset($_POST["reportarValija"])) {

        if (isset($_POST["cValija"]) && $_POST["cValija"] != "" && isset($_POST["datosValija"]) && $_POST["datosValija"] != "") {

            try {
                $parametros = array('registroValija' => $_POST["cValija"],
                    'registroUsuario' => $idUsuario,
                    'registroSede' => $sede,
                    'datosValija' => $_POST["datosValija"]);
                $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
                $client = new SOAPClient($wsdl_url);
                $client->decode_utf8 = false;
                $reportarValija = $client->reportarValija($parametros);

                if ($reportarValija->return == 1) {
                    javaalert('Valija Reportada y Reenviada');
                    llenarLog(7, "Valija Erronea", $usuarioBitacora, $sede);
                    iraURL('../pages/create_valise.php');
                } else {
                    javaalert('Valija No Reportada y No Reenviada');
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

    include("../views/valise_report.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/create_valise.php');
}
?>