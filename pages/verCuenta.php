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
  $id= array('idUsuario' => $_GET['id']);
  $Usuario = $client->consultarUsuario($id);
  $Permiso = $client->consultarPermisologia($id);
  $reg=0;
	if(isset($Usuario->return) && isset($Permiso->return)){
	
	  $reg=count($Usuario->return);
	  $regp=count($Permiso->return);
	}
  } catch (Exception $e) {
	javaalert('Lo sentimos no hay conexión');
	iraURL('../pages/index.php');	
	}
 // '<pre>';
 //print_r( $BandejaUsu );
  //echo '<pre>';
include("../views/verCuenta.php");



?>
 


