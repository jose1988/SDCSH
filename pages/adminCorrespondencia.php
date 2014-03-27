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
  $Usuario= array('user' => $_SESSION["Usuario"]->return->idusu);
  $BandejaUsu = $client->consultarBandejaXUser($Usuario);
  $reg=0;
	if(isset($BandejaUsu->return)){
	  $reg=count($BandejaUsu->return);
	  }
  } catch (Exception $e) {
	javaalert('Lo sentimos no hay conexión');
	iraURL('../pages/index.php');	
	}
	
	

if ((isset($_FILES['nom_del_archivo']['archivo'])&&($_FILES['nom_del_archivo']['error']) == 
UPLOAD_ERR_OK)) {
$ruta_destino = '/archivos';
move_uploaded_file($_FILES['nom_del_archivo']['tmp_name'], $ruta_destino.$_FILES
['nom_del_archivo']['name']);
}


	
 //echo'<pre>';
// print_r( $_SESSION["Usuario"]);
// echo '<pre>';
include("../views/adminCorrespondencia.php");



?>
 
 

