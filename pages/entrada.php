<?php

session_start();
try {
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

if(!isset($_SESSION["Usuario"])){
	
	iraURL("../pages/index.php");
	}


  $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $i=0;
  $Usuario= array('user' => $_SESSION["Usuario"]->return->idusu);
  $BandejaUsu = $client->consultarBandejas;
  $Ban= array('ban' =>$BandejaUsu->return[$i]->idban);
  $Bandeja=$client->consultarPaquetesXBandeja($Usuario,$ban);
  $reg=0;
	if(isset($BandejaUsu->return)){
	  $reg=count($BandejaUsu->return);
	  }
  } catch (Exception $e) {
	javaalert('Lo sentimos no hay conexión');
	iraURL('../pages/index.php');	
	}
 //echo'<pre>';
// print_r( $_SESSION["Usuario"]);
// echo '<pre>';
include("../views/entrada.php");



?>
 

