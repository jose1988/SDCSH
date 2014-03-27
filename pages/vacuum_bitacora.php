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
if(isset($SedeRol->return)){
				if($SedeRol->return->idrol->idrol==0){
					 iraURL("../pages/inbox.php");
				   }
				}else{
					 iraURL("../pages/index.php");
				}

$usuarioBitacora = $_SESSION["Usuario"]->return->idusu;
$sede = $_SESSION["Sede"]->return->idsed;

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $resultadoListaBitacora = $client->listarBitacora();

    if (!isset($resultadoListaBitacora->return)) {
        $bitacora = 0;
    } else {
        $bitacora = count($resultadoListaBitacora->return);
    }

    if (isset($_POST["vaciar"])) {

        $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->decode_utf8 = false;
        $resultadoVacioBitacora = $client->vaciarBitacora();

        if (isset($resultadoVacioBitacora->return) == 1) {
            javaalert('Bitacora Vaciada');
            llenarLog(8, "Vacio de Bitacora", $usuarioBitacora, $sede);
            iraURL('../pages/administration.php');
        } else {
            javaalert('Bitacora No Vaciada');
            iraURL('../pages/administration.php');
        }
    }
    include("../views/vacuum_bitacora.php");
    
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexion');
    iraURL('../pages/administration.php');
}
?>