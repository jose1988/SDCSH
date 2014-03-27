<meta http-equiv="Content-Type" content="text/html charset=utf-8" />
<?php
session_start();

include("../recursos/funciones.php");
require_once('../lib/nusoap.php');
if (!isset($_SESSION["Usuario"])) {
    iraURL("../index.php");
} elseif (!usuarioCreado()) {
    iraURL("../pages/create_user.php");
} 

try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $UsuarioRol = array('idusu' => $_SESSION["Usuario"]->return->idusu, 'sede' => $_SESSION["Sede"]->return->nombresed);
    $SedeRol = $client->consultarSedeRol($UsuarioRol);
    if (isset($SedeRol->return)) {
        if ($SedeRol->return->idrol->idrol != "1" && $SedeRol->return->idrol->idrol != "3") {
            iraURL('../pages/inbox.php');
        }
    } else {
        iraURL('../pages/inbox.php');
    }
    
	$usu = array('idusu' => $_SESSION["Usuario"]->return->idusu);
	$sede = array('idsed' => $_SESSION["Sede"]->return->idsed);
    $parametros = array('idUsuario' => $usu,'sede'=>$sede);
	
    $parametros = array('idUsuario' => $usu);
    $PaquetesConfirmados = $client->consultarPaquetesXUsuarioProcesadasAlDia($parametros);
//echo '<pre>';
//print_R($PaquetesConfirmados);
    include("../views/operator_level.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexión');
    iraURL('../pages/inbox.php');
}
?>
