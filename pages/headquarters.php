<?php

session_start();
//try{
include("../recursos/funciones.php");
require_once("../lib/nusoap.php");
$Sedes = $_SESSION["Sedes"];
// echo '<pre>'; print_r($Sedes); 
try {
    if (isset($_POST["Biniciar"])) {
        if (isset($_POST["sede"]) && $_POST["sede"] != "") {
            for ($i = 0; $i < count($Sedes->return); $i++) {
                if ($Sedes->return[$i]->idsed == $_POST["sede"]) {
                    $_SESSION["Sede"] = $Sedes->return[$i];
                    break;
                }
            }

            $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
            $client = new SOAPClient($wsdl_url);
            $client->decode_utf8 = false;
            $id = array('idSede' => $_SESSION["Sede"]->idsed);
            $_SESSION["Sede"] = $client->consultarSedeXId($id);
// echo '<pre>'; print_r($_SESSION["Sede"]); 
            iraURL('../pages/inbox.php');
        } else {
            javaalert('Debe escojer la sede');
        }
    }
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexión');
    iraURL('../pages/index2.php');
}


include("../views/headquarters.php");
?>
