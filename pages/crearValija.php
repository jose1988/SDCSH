<?php

//session_start();
//try {
//include("../recursos/funciones.php");
//require_once('../lib/nusoap.php');
//if(!isset($_SESSION["Usuario"])){
//	
//	iraURL("../pages/index.php");
//	}
//
//
//  $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
//  $client = new SOAPClient($wsdl_url);
//  $client->decode_utf8 = false; 
//  $Usuario= array('user' => $_SESSION["Usuario"]->return->idusu);
//  $BandejaUsu = $client->consultarBandejaXUser($Usuario);
//  $reg=0;
//	if(isset($BandejaUsu->return)){
//	  $reg=count($BandejaUsu->return);<select name="Destinos"></select>
//	  }
//  } catch (Exception $e) {
//	javaalert('Lo sentimos no hay conexión');
//	iraURL('../pages/index.php');	
//	}
 //echo'<pre>';
// print_r( $_SESSION["Usuario"]);
// echo '<pre>';
include("../views/crearValija.php");



?>
 

