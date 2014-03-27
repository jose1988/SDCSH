<?php

session_start();
try {
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

if(!isset($_SESSION["Usuario"])){
	
	iraURL('../index.php');
	}

//echo'<pre>';
// print_r( $_SESSION["Sede"]);
//echo '<pre>';
  $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $i=0;
  $reg=0;
  $Sede= array('sede' => $_SESSION["Sede"]->return->nombresed);
  
  $Sedes = $client->ConsultarSedeParaValija($Sede);
   $UsuarioRol= array('idusu' => $_SESSION["Usuario"]->return->idusu,'sede' =>$_SESSION["Sede"]->return->nombresed);
  $SedeRol=$client->consultarSedeRol($UsuarioRol); 
  if($SedeRol->return->idrol->idrol=="4" || $SedeRol->return->idrol->idrol=="5"){
	  if(isset($Sedes->return)){
	  $reg=count($Sedes->return);
	  
	  }
	  $verificacion=1; 
  }else{
	  iraURL('../pages/inbox.php');	
  }
  
	
  } catch (Exception $e) {
	javaalert('Lo sentimos no hay conexión');
	iraURL('../index.php');	
	}
 
include("../views/create_valise.php");



?>
 

