<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
<?php
session_start();

 include("../recursos/funciones.php");
require_once('../lib/nusoap.php');
if(!isset($_SESSION["Usuario"])){
	
	iraURL("../pages/index.php");
	}
try{
$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $doc= array('doc' => $_GET["documento"]);
  $rowNombreDocumento = $client->consultarDocumentoXNombre($doc);
}catch (Exception $e) {
	javaalert('Error:  este documento no esta registrado');
	iraURL('../pages/index.php');
	}


if(isset($_POST["crear_uno"])){
	 	if(isset($_POST["nombre"]) && $_POST["nombre"]!=""){	
			
		
					
			if(isset($rowNombreDocumento->return->iddoc)){				
			
						  $Documento= 
						  array(
						  'iddoc'=>$rowNombreDocumento->return->iddoc,
						  'nombredoc' => $_POST["nombre"],
						  'descripciondoc' => $_POST["descripcion"],
						  );
						  $registroU=array('registroDocumento'=>$Documento);
							
							try {
							 
							$client->editarDocumento($registroU);
							javaalert('editado el documento con exito');
								iraURL('../pages/adminDocumento.php');	
							
							} catch (Exception $e) {
								javaalert('Error al editar el documento');
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
		
	  	
   include("../views/editarDocumento.php");
  
	 
?>
