<?php
//Función que direcciona a una página especifica
function iraURL($url){
	$ini='<script language="javascript">
				window.location = "';
	$fin='"; </script>';	
	echo $ini.$url.$fin;
}

//Alertas
function javaalert($msj){
	$ini='<script language="javascript">	alert("';
	$fin='"); </script>';
	echo $ini.$msj.$fin;
}

//Verificando que tenga la sesión abierta
function existeSesion(){
	if(isset($_SESSION["Usuario"]))
		return true;
	else
		return false;
}

//Eliminando variable de sesión 
function eliminarSesion(){
    if(isset($_SESSION["Usuario"])){
		unset($_SESSION["Usuario"]);
		session_destroy();
	}
	
}

//Bitacora del sitio web
function llenarLog($accion,$observacion,$usuario,$sede){
		switch($accion){
		case 1:
			$accion="INSERCIÓN";
			break;
		case 2:
			$accion="CONFIRMACIÓN";
			break;
		case 3:
			$accion="BORRADO";
			break;
		case 4:
			$accion="INICIO DE SESIÓN";
			break;
		case 5:
			$accion="FIN DE SESIÓN";
			break;
		case 6:
			$accion="COMPROBANTE";
			break;
		case 7:
			$accion="REPORTE";
			break;	
		case 8:
			$accion="VACIO DE BITACORA";
			break;	
		case 9:
			$accion="EDICIÓN";
			break;	
		}

		$parametros = array('idSede' => $sede,
				'idUsu' => $usuario,
				'accion' => $accion,
				'observacion' => $observacion);
		$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  		$client = new SOAPClient($wsdl_url);
  		$client->decode_utf8 = false;
		$registroBitacora = $client->insertarBitacora($parametros);
}

//Verificando si el usuario esta creado
function usuarioCreado(){
		$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  		$client = new SOAPClient($wsdl_url);
  		$client->decode_utf8 = false;
		$Usuario= array('idUsuario' =>$_SESSION["Usuario"]->return->idusu);
    	$Usuariocreado = $client->consultarUsuario($Usuario);
		
	if(isset($Usuariocreado->return))
		return true;
	else
		return false;
}
?>