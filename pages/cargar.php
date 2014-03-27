<?php 
   include("../recursos/funciones.php");
  print_r($_FILES);  
if ($_FILES['nom_del_archivo']['error']) {
          switch ($_FILES['nom_del_archivo']['error']){
                   case 1: // UPLOAD_ERR_INI_SIZE
                   echo"El archivo sobrepasa el limite autorizado por el servidor(archivo php.ini) !";
                   break;
                   case 2: // UPLOAD_ERR_FORM_SIZE
                   echo "El archivo sobrepasa el limite autorizado en el formulario HTML !";
                   break;
                   case 3: // UPLOAD_ERR_PARTIAL
                   echo "El envio del archivo ha sido suspendido durante la transferencia!";
                   break;
                   case 4: // UPLOAD_ERR_NO_FILE
                   echo "El archivo que ha enviado tiene un tamaño nulo !";
                   break;
          }
}
else{


$ruta_destino = '../archivos/';
move_uploaded_file($_FILES['nom_del_archivo']['tmp_name'], $ruta_destino.$_FILES
['nom_del_archivo']['name']);

iraURL("../pages/entrada.php");

}

?> 