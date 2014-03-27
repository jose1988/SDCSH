<?php

if ($usuarioBitacora == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
}
$idpaq = $resultadoConsultarUltimoPaquete->return->idpaq;

if (isset($resultadoConsultarUltimoPaquete->return->idpaqres->idpaq)) {
    $idpaqres = $resultadoConsultarUltimoPaquete->return->idpaqres->idpaq;
} else {
    $idpaqres = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->origenpaq->idusu->nombreusu)) {
    $nombre = $resultadoConsultarUltimoPaquete->return->origenpaq->idusu->nombreusu;
} else {
    $nombre = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->origenpaq->idusu->apellidousu)) {
    $apellido = $resultadoConsultarUltimoPaquete->return->origenpaq->idusu->apellidousu;
} else {
    $apellido = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->destinopaq->idusu->nombreusu)) {
    $nombredes = $resultadoConsultarUltimoPaquete->return->destinopaq->idusu->nombreusu;
} else {
    $nombredes = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->destinopaq->idusu->direccionusu)) {
    $direcciondes = $resultadoConsultarUltimoPaquete->return->destinopaq->idusu->direccionusu;
} else {
    $direcciondes = "";
}

if (isset($resultadoConsultarUltimoPaquete->return->destinopaq->idusu->telefonousu)) {
    $telefonodes = $resultadoConsultarUltimoPaquete->return->destinopaq->idusu->telefonousu;
} else {
    $telefonodes = "";
}

if (isset($resultadoConsultarSede->return->nombresed)) {
    $sede = $resultadoConsultarSede->return->nombresed;
} else {
    $sede = "";
}

if (isset($resultadoConsultarUltimoPaquete->return)) {
    ob_start();
    include("../template/proof_of_external_correspondence.php");

    //Almacenar el resultado de la salida en una variable
    $page = ob_get_contents();

    //Limpiar buffer de salida hasta este punto
    ob_end_clean();

    require_once("../dompdf/dompdf_config.inc.php");

    //Obtenemos el código html de la página web que nos interesa
    $dompdf = new DOMPDF();
    //Creamos una instancia a la clase
    $dompdf->load_html($page);
    //Esta línea es para hacer la página del PDF más grande
    $dompdf->set_paper('carta', 'portrait');
    $dompdf->render();
    $nom = 'Comprobante de Correspondencia Externa Numero ' . $idpaq . '.pdf';
    $dompdf->stream($nom);
}//Fin del IF general
?>