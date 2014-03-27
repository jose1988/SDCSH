<?php

if ($usuarioBitacora == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
}

if (isset($SedeRol->return->idrol->nombrerol)) {
    $nombreRol = "- " . $SedeRol->return->idrol->nombrerol;
} else {
    $nombreRol = "";
}

if ($contadorPaquetes > 0) {
    ob_start();
    include("../template/proof_operator_level.php");

    //Almacenar el resultado de la salida en una variable
    $page = ob_get_contents();

    //Limpiar buffer de salida hasta este punto
    ob_end_clean();

    require_once("../dompdf/dompdf_config.inc.php");

    //Obtenemos el código html de la página web que nos interesa
    $dompdf = new DOMPDF();
    //Creamos una instancia a la clase
    $dompdf->load_html($html);
    //Esta línea es para hacer la página del PDF más grande
    $dompdf->set_paper('carta', 'portrait');
    $dompdf->render();
    $nom = 'Comprobante Confirmados_' . $contadorPaquetes . ' Paquetes.pdf';
    $dompdf->stream($nom);
}//Fin del IF general
?>