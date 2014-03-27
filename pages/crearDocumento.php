<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
<?php
session_start();

 include("../recursos/funciones.php");
require_once('../lib/nusoap.php');
if(!isset($_SESSION["Usuario"])){
	
	iraURL("../pages/index.php");
	}

$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 

if(isset($_POST["crear_uno"]) || isset($_POST["crear_otro"])){
	 	if(isset($_POST["nombre"]) && $_POST["nombre"]!=""  && isset($_POST["descripcion"]) && $_POST["descripcion"]!=""){	
			
		 try {
	
				$doc= array('doc' => $_POST["nombre"]);
				$rowNombreDocumento = $client->consultarDocumentoXNombre($doc);
	    	}catch (Exception $e) {
					javaalert('Lo sentimos no hay conexión');
					iraURL('../views/index.php');
					}
					
			if(!isset($rowNombreDocumento->return->iddoc)){				
			
						  $Documento= 
						  array(
						  'nombredoc' => $_POST["nombre"],
						  'descripciondoc' => $_POST["descripcion"],
						  );
						  $registroU=array('registroDocumento'=>$Documento);
							
							try {
							 
							$client->insertarDocumento($registroU);
							if(isset($_POST["crear_uno"])){
								iraURL('../pages/adminUsuario.php');		
								}else{
								iraURL('../pages/crearUsuario.php');	
							}	
							} catch (Exception $e) {
								javaalert('Error al crear el documento');
								iraURL('../pages/index.php');
								}
									
						
				
		}else{
				javaalert('El Documento ya existe , por favor verifique');
				} 				
		}
		
		else{
			javaalert("Debe agregar todos los campos obligatorios, por favor verifique");
		
		
		}
}
		
	  	
   include("../views/crearDocumento.php");
  
	 
?>
