<?php

if ($usuarioBitacora == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
}
$idval = $resultadoConsultarUltimaValija->return->idval;

$nombre = $resultadoConsultarUltimaValija->return->idusu->nombreusu;

if (isset($resultadoConsultarUltimaValija->return->origenpaq->idusu->apellidousu)) {
    $apellido = $resultadoConsultarUltimaValija->return->origenpaq->idusu->apellidousu;
} else {
    $apellido = "";
}

if (isset($resultadoConsultarUltimaValija->return->destinoval->nombresed)) {
    $nombredes = $resultadoConsultarUltimaValija->return->destinoval->nombresed;
} else {
    $nombredes = "";
}

if (isset($resultadoConsultarUltimaValija->return->destinoval->direccionsed)) {
    $direcciondes = $resultadoConsultarUltimaValija->return->destinoval->direccionsed;
} else {
    $direcciondes = "";
}

if (isset($resultadoConsultarUltimaValija->return->destinoval->telefonosed)) {
    $telefonodes = $resultadoConsultarUltimaValija->return->destinoval->telefonosed;
} else {
    $telefonodes = "";
}

if (isset($resultadoConsultarSede->return->nombresed)) {
    $sede = $resultadoConsultarSede->return->nombresed;
} else {
    $sede = "";
}

if (isset($resultadoConsultarUltimaValija->return)) {
    ob_start();
    include("../template/proof_pouch.php");

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
    $nom = 'Comprobante de Valija Numero ' . $idval . '.pdf';
    $dompdf->stream($nom);
}//Fin del IF general
?>