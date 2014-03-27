<?php
session_start();
//try{
include("../recursos/funciones.php");
require_once("../lib/nusoap.php");

if(isset($_SESSION["Usuario"])){
	eliminarSesion();
	}

if (isset($_POST["Biniciar"])) {
   try{
  $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $Usuario= array('user' => $_POST["usuario"]);
  $UsuarioLogIn = $client->consultarUsuarioXUser($Usuario);
  $_SESSION["Usuario"]=$UsuarioLogIn;
  $idUsu= array('idusu' =>$UsuarioLogIn->return->idusu);
  $registroUsu= array('registroUsuario' =>$idUsu);
  $Sedes=$client->consultarSedeDeUsuario($registroUsu);
  
  
  if(isset($UsuarioLogIn->return) && isset($Sedes->return)){
  if(count($Sedes->return)==1){
  $_SESSION["Sede"]=$Sedes;
// echo '<pre>'; print_r($_SESSION["Sede"]); 
  iraURL("inbox.php");
  }else{
  $_SESSION["Sedes"]=$Sedes;
  iraURL("headquarters.php");

  }
  }else{
  javaalert("Usuario o contraseña incorrectos , por favor verifique");
  }
	

  } catch (Exception $e) {
	javaalert('Lo sentimos no hay conexión');
}
}
	

include("../views/indexSh.php");
 
?>
