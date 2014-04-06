
<?php

session_start();
include("/recursos/funciones.php");
require_once("/lib/nusoap.php");

if (isset($_SESSION["Usuario"]) || isset($_SESSION["User"])) {
    eliminarSesion();
}

if (isset($_POST["Biniciar"])) {
    try {
        $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->decode_utf8 = false;
        $Usuario = array('user' => $_POST["usuario"]);
        $UsuarioLogIn = $client->consultarUsuarioXUser($Usuario);

        if (isset($UsuarioLogIn->return)) {

            $_SESSION["Usuario"] = $UsuarioLogIn;
            $idUsu = array('idusu' => $UsuarioLogIn->return->idusu);
            $registroUsu = array('registroUsuario' => $idUsu);
            $Sedes = $client->consultarSedeDeUsuario($registroUsu);
            if (isset($Sedes->return) && count($Sedes->return) == 1) {
                $_SESSION["Sede"] = $Sedes;
                iraURL("./pages/inbox.php");
            } else if (isset($Sedes->return)) {
                $_SESSION["Sedes"] = $Sedes;
                iraURL("pages/headquarters.php");
            }
        } else {
            $_SESSION["User"] = $_POST["usuario"];
            iraURL("pages/create_user.php");
        }
    } catch (Exception $e) {
        javaalert('Lo sentimos no hay conexión');
    }
}
include("/views/index.php");
?>