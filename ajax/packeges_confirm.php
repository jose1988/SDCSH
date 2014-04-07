
<?php

session_start();
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

$aux = $_POST['idpaq'];
$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$paq = array('idpaq' => $aux);
$Valija = $client->actualizarBandeja($paq);

if ($Valija->return) {
    javaalert("Paquete confirmado con exito");
    iraURL("../pages/inbox.php");
}
?>