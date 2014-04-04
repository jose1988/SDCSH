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

try{
	$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
	$client = new SOAPClient($wsdl_url);
	$client->decode_utf8 = false;
	$Con = array('fechaInicio' => $_SESSION["Fechaini"], 'fechaFinal' => $_SESSION["Fechafin"], 'consulta' => $_SESSION["Reporte"], 'idsede' => $_SESSION["Osede"]);
	$resultadoConsultarValijas = $client->consultarEstadisticas($Con );
	
	if (isset($resultadoConsultarValijas->return)) {
		$valijas = count($resultadoConsultarValijas->return);
	} else{
		$valijas = 0;
	}
	
	$_SESSION["valijas"] = $resultadoConsultarValijas;
		
	if($valijas > 0){	
		if($valijas > 1) {	
			for($i=0; $i<$valijas; $i++){
				$nombreSede = "";
				$idSed = $resultadoConsultarValijas->return[$i]->origenval;
				$idSede = array('idSede' => $idSed);
				$resultadoConsultarSede = $client->consultarSedeXId($idSede);				
				if(isset($resultadoConsultarSede->return->nombresed)){
					$nombreSede = $resultadoConsultarSede->return->nombresed;
				}
				else{
					$nombreSede = "";
				}
				$_SESSION["nombreSede"][$i] = $nombreSede;
			}
		}else{
			$idSed = $resultadoConsultarValijas->return->origenval;
			$idSede = array('idSede' => $idSed);
			$resultadoConsultarSede = $client->consultarSedeXId($idSede);
			if(isset($resultadoConsultarSede->return->nombresed)){
				$nombreSede = $resultadoConsultarSede->return->nombresed;
			}
			else{
				$nombreSede = "";
			}
			$_SESSION["nombreSede"] = $nombreSede;
		}
	}
	
	if(isset($_POST["imprimir"])){
		echo"<script>window.open('../pages/proof_of_bags_report.php');</script>";
	}
	
	include("../views/info_reports_valise.php"); 
	
} catch (Exception $e) {

	javaalert('Lo sentimos no hay conexion');
	iraURL('../pages/reports_valise.php');
}
?>