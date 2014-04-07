<?php

sleep(1);
if (isset($_POST['nombre']) && $_POST['nombre'] != "") {
    require_once('../lib/nusoap.php');
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $Nombre = array('doc' => $_POST['nombre']);
    $rowDocumento = $client->consultarDocumentoXNombre($Nombre);

    if (isset($rowDocumento->return->iddoc)) {
        echo '<div id="Error"> Ya existe este documento </div>';
    } else {
        echo '<div> </div>';
    }
} else {
    echo '<div></div>';
}
?>