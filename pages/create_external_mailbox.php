<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
<?php
session_start();

include("../recursos/funciones.php");
require_once('../lib/nusoap.php');

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    
    /* 	if(isset($Usuario)){
      javaalert("Lo sentimos no se puede guardar los datos del usuario porque el nombre de usuario ya existe,Consulte con el Administrador");
      iraURL('../index.php');   //ojo necesito el index
      } */    //importante:implementar cuando se tenga el index 


    if (isset($_POST["crear"])) {
        if (isset($_POST["nombre"]) && $_POST["nombre"] != "" && isset($_POST["correo"]) && $_POST["correo"] != "" && isset($_POST["cedularif"]) && $_POST["cedularif"] != "" && isset($_POST["telefono"]) && $_POST["telefono"] != "" && isset($_POST["direccion"]) && $_POST["direccion"] != "") {

            if (preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$}', $_POST["correo"])) {
                $correo = $_POST["correo"];
                
                if (isset($_POST["telefono"])) {
                    $telefono = $_POST["telefono1"];
                }
				
                if (isset($_POST["direccion"])) {
                    $direccion = $_POST["direccion"];
                }
               
                $Buzon =
                        array(
                            'nombrebuz' => $_POST["nombre"],
                            'identificacionbuz' => $_POST["cedularif"],
                            'correobuz' => $correo,
                            'direccionbuz' => $direccion,
                            'telefonobuz' => $telefono,
                            'tipobuz' => "1",
							'borradousu' => "0");
                $parametros = array('registroBuzon' => $Buzon );
                $guardo=$client->insertarBuzonExterno($parametros);
               
				
                if ($guardo->return == 0) {
                    javaalert("No se han Guardado los datos del Buzon externo, Consulte con el Admininistrador");
					
                } else {
					
                    javaalert("Se han Guardado los datos del Buzón externo");
                    llenarLog(1, "creacion de buzon externo", $_SESSION["Usuario"]->return->idusu, $_POST["sede"]);
					iraURL("../pages/inbox.php");
                }
                iraURL('../pages/inbox.php');
            } else {
                javaalert("El formato del correo es incorrecto, por favor verifique");
            }
        } else {
            javaalert("Debe agregar todos los campos obligatorios, por favor verifique");
        }
    }
    include("../views/create_external_mailbox.php");
} catch (Exception $e) {
    javaalert('Error al crear el usuario');
    iraURL('../index.php');
}
?>
