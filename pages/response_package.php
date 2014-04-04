<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
<?php
session_start();

include("../recursos/funciones.php");
require_once('../lib/nusoap.php');
if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
}  elseif (!isset($_GET['idpaqr'])) {
    iraURL("../pages/inbox.php");
}
//try {
$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
$client = new SOAPClient($wsdl_url);
$client->decode_utf8 = false;
$UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
$SedeRol = $client->consultarSedeRol($UsuarioRol);
$idPaquete = array('idPaquete' => $_GET['idpaqr']);
$Paquete = $client->ConsultarPaqueteXId($idPaquete);
  //echo '<pre>';print_r($Paquete);

if (!isset($Paquete->return)) {
    iraURL('../pages/inbox.php');
}elseif($Paquete->return->statuspaq!="1" && $Paquete->return->destinopaq->idusu->idusu != $_SESSION["Usuario"]->return->idusu){
iraURL('../pages/inbox.php');
}
$contacto = array('idusu' => $Paquete->return->origenpaq->idusu);
$dueno = array('idusu' => $Paquete->return->destinopaq->idusu->idusu);
$sede = array('idsed' => $Paquete->return->idsed->idsed);


$rowDocumentos = $client->listarDocumentos();
$rowPrioridad = $client->listarPrioridad();

if (!isset($rowDocumentos->return)) {
    javaalert("Lo sentimos no se puede enviar correspondencia porque no hay Tipos de documentos registrados,Consulte con el Administrador");
    iraURL('../pages/inbox.php');
}
if (!isset($rowPrioridad->return)) {
    javaalert("Lo sentimos no se puede enviar correspondencia porque no hay Prioridades registradas,Consulte con el Administrador");
    iraURL('../pages/inbox.php');
}
if (isset($_POST["enviar"])) {//echo $_POST["datepicker"].'<br>';		
//echo '<br>'.date('Y-m-d', strtotime(str_replace('/', '-', $_POST["datepicker"]))).'Lados___'.date('Y-m-d', strtotime(str_replace('/', '-', $_POST["datepickerf"])));
//echo $_POST["contacto"].'_'.$_POST["asunto"].'_'.$_POST["doc"].'_'.$_POST["prioridad"].'_'.$_POST["datepicker"].'_'.$_POST["datepickerf"].'_'.$_POST["elmsg"];
    if (isset($_POST["asunto"]) && $_POST["asunto"] != "" && isset($_POST["doc"]) && $_POST["doc"] != "" && isset($_POST["prioridad"]) && $_POST["prioridad"] != "" && isset($_POST["elmsg"]) && $_POST["elmsg"] != "") {
        $origenpaq = array('idusu' => $Paquete->return->destinopaq->idusu->idusu);
        $Parametros = array('userUsu' => $Paquete->return->origenpaq->userusu,
            'idUsuario' => $origenpaq);
        $usuarioBuzon = $client->consultarBuzonXNombreUsuario($Parametros);
 // echo '<pre>';print_r($Parametros);
        if (isset($usuarioBuzon->return)) {
            $destinopaq = array('idbuz' => $usuarioBuzon->return->idbuz);
            $prioridad = array('idpri' => $_POST["prioridad"]);
            $documento = array('iddoc' => $_POST["doc"]);
            $sede = array('idsed' => $_SESSION["Sede"]->return->idsed);
            $idPadre = array('idpaq' => $_GET['idpaqr']);
            $paquete = array('origenpaq' => $origenpaq,
                'destinopaq' => $destinopaq,
                'asuntopaq' => $_POST["asunto"],
                'textopaq' => $_POST["elmsg"],
                'fechapaq' => date("Y-m-d"),
                'fechaenviopaq' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST["datepickerf"]))),
                'fechaapaq' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST["datepicker"]))),
                'statuspaq' => "0",
				'respaq' => "0",
                'localizacionpaq' => $Paquete->return->destinopaq->idusu->userusu,
                'idpri' => $prioridad,
                'iddoc' => $documento,
                'idsed' => $sede,
                'idpaqres' => $idPadre);
            $registro = array('registroPaquete' => $paquete);

            $envio = $client->crearPaquete($registro);  //pilas ismael
            $paramUltimo = array('idUsuario' => $Paquete->return->destinopaq->idusu->idusu);
            $idPaquete = $client->ultimoPaqueteXOrigen($paramUltimo);
            $paq = array('idpaq' => $idPaquete->return->idpaq);
            $bandejaorigen = $client->insertarBandejaOrigen($paq);
            $bandejaDestino = $client->insertarBandejaDestino($paq);
            $paramPadre = array('idpaq' => $_GET['idpaqr'], 'status' => "2");
            $statusPadre = $client->editarEstatusPaquete($paramPadre);
            if ($_FILES['imagen']['name'] != "") {
                $imagenName = $_FILES['imagen']['name'];
                $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; //posibles caracteres a usar
                $numerodeletras = 5; //numero de letras para generar el texto
                $cadena = ""; //variable para almacenar la cadena generada
                for ($i = 0; $i < $numerodeletras; $i++) {
                    $cadena .= substr($caracteres, rand(0, strlen($caracteres)), 1); /* Extraemos 1 caracter de los caracteres 
                      entre el rango 0 a Numero de letras que tiene la cadena */
                }

                $direccion = "../images"; //para cargar
                $direccion2 = "images"; //para guardar
                $tipo = explode('/', $_FILES['imagen']['type']);
                $uploadfile = $direccion . "/adjunto/" . $cadena . "." . $tipo[1];
                $Ruta = $direccion2 . "/adjunto/" . $cadena . "." . $tipo[1];
                $imagen = $_FILES['imagen']['tmp_name'];
                move_uploaded_file($imagen, $uploadfile);
                $idPaquete = $client->maxPaquete();
                $paq = array('idpaq' => $idPaquete->return);
                $adj = array('nombreadj' => $imagenName,
                    'urladj' => $Ruta,
                    'idpaq' => $paq);
                $par = array('registroAdj' => $adj);
                $Rta = $client->insertarAdjunto($par);
            }
            if (!isset($envio->return) || !isset($bandejaorigen->return) || !isset($bandejaDestino->return) || !isset($statusPadre->return)) {
                javaalert("La correspondencia no ha podido ser enviada correctamente , por favor consulte con el administrador");
            } else {
                if ($envio->return == "1" && $bandejaorigen->return == "1" && $bandejaDestino->return == "1" && $statusPadre->return == "1") {
                    javaalert("La correspondencia ha sido enviada");
                    llenarLog(1, "Envio de Respuesta de Correspondencia", $_SESSION["Usuario"]->return->idusu, $_SESSION["Sede"]->return->idsed);
                }
            }
            iraURL('../pages/inbox.php');
        }
    } else {
        javaalert("Debe agregar todos los campos obligatorios, por favor verifique");
    }
}
include("../views/response_package.php");
/* } catch (Exception $e) {
  javaalert('Lo sentimos no hay conexión');
  iraURL('../pages/inbox.php');
  } */
?>
