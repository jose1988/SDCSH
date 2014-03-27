<?php

session_start();
try {
include("../recursos/funciones.php");
require_once('../lib/nusoap.php');


if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
} 

//echo'<pre>';
// print_r( $_SESSION["Sede"]);
//echo '<pre>';
  $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $i=0;
  
  $Sedes = $client->ConsultarSedes();
   $UsuarioRol= array('idusu' => $_SESSION["Usuario"]->return->idusu,'sede' =>$_SESSION["Sede"]->return->nombresed);
  $SedeRol=$client->consultarSedeRol($UsuarioRol); 
  $reg=0;
	if(isset($Sedes->return)){
	  $reg=count($Sedes->return);
	  
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
	iraURL('../index.php');	
	}	

include("../views/user_role.php");



?>
 



