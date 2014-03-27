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
    $usu = array('idusu' => $_SESSION["Usuario"]->return->idusu);
    $sede = array('idsed' => $_SESSION["Sede"]->return->idsed);

    $parametros = array('registroUsuario' => $usu,
        'registroSede' => $sede);
    $PaquetesConfirmados = $client->paquetesVencidosXDestino($parametros);
//echo '<pre>';
//print_R($PaquetesConfirmados);
    include("../views/package_overdue_destination.php");
} catch (Exception $e) {
    javaalert('Lo sentimos no hay conexión');
    iraURL('../pages/inbox.php');
}
?>
