<?php

session_start();
try {
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');
$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false; 

 $UsuarioRol= array('idusu' => $_SESSION["Usuario"]->return->idusu,'sede' =>$_SESSION["Sede"]->return->nombresed);
  $SedeRol=$client->consultarSedeRol($UsuarioRol); 
if(!isset($_SESSION["Usuario"])){
	
	iraURL("../pages/index.php");
	}
	
			if(isset($SedeRol->return)){
				if($SedeRol->return->idrol->idrol==0){
					 iraURL("../pages/inbox.php");
				   }
				}else{
					 iraURL("../pages/index.php");
				}

  } catch (Exception $e) {
	javaalert('Lo sentimos no hay conexión');
	iraURL('../pages/index.php');	
	}

include("../views/administration.php");



?>
 

