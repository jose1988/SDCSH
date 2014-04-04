<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
<?php
session_start();

include("../recursos/funciones.php");
require_once('../lib/nusoap.php');
if (!isset($_SESSION["Usuario"])) {

    iraURL("../pages/index.php");
}
try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
	$org = $client->ConsultarOrganizaciones();
    
	
	if (!isset($org->return)) {
        javaalert("lo sentimos no se pueden crear sedes, no existen organizaciones registradas, Consulte con el administrador");
        iraURL('../pages/inbox.php');
    }

    if (isset($_POST["crear"])) {
        if (isset($_POST["nombre"]) && $_POST["nombre"] != "" && isset($_POST["telefono"]) && $_POST["telefono"] != ""  && isset($_POST["sede"]) && $_POST["sede"] != "" ) {
			
			$result=0;
			try{
			$datos = array('sede' => $_POST["nombre"]);
			$Sedes = $client->consultarSedeExistente($datos);
			$result=$Sedes->return;
			}catch (Exception $e) {
				
			}
           if($result==0){
               
                $telefono2 = "";
                
                if (isset($_POST["telefono"])) {
                    $telefono = $_POST["telefono"];
                }
                if (isset($_POST["telefono2"])) {
                    $telefono2 = $_POST["telefono2"];
                }
                if (isset($_POST["direccion"])) {
                    $direccion = $_POST["direccion"];
                }
               
                $Sedenueva =
                        array(
                            'nombresed' => $_POST["nombre"],
                            'direccionsed' => $direccion,
                            'telefonosed' => $telefono,
                            'telefono2sed' => $telefono2,
                            'idorg' => $_POST["organizacion"]);
                $parametros = array('registroSede' => $Sedenueva,'idorg' => $_POST["organizacion"]);
				 
                $guardo=$client->insertarSede($parametros);
                
				
                if ($guardo->return == 0) {
                    javaalert("No se han Guardado los datos de la sede, Consulte con el Admininistrador");
					
                } else {
					
                    javaalert("Se han Guardado los datos de la sede");
                    llenarLog(1, "Inserción de Sede", $_SESSION["Usuario"]->return->idusu, $_SESSION["Sede"]->return->idsed);
                }
                iraURL('../pages/inbox.php');
				
		   }else{
		   		javaalert('Este nombre de sede ya ha sido usado');
   				 iraURL('../pages/inbox.php');
		   }
				
        } else {
            javaalert("Debe agregar todos los campos obligatorios, por favor verifique");
        }
		}
    include("../views/create_provider.php");
} catch (Exception $e) {
    javaalert('Error al crear la sede');
    iraURL('../pages/inbox.php');
}
?>
