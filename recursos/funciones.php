<?php
//Función que direcciona a una página especifica
function iraURL($url){
	$ini='<script language="javascript">
				window.location = "';
	$fin='"; </script>';	
	echo $ini.$url.$fin;
}

//Alertas
function javaalert($msj){
	$ini='<script language="javascript">	alert("';
	$fin='"); </script>';
	echo $ini.$msj.$fin;
}

//Verificando que tenga la sesión abierta
function existeSesion(){
	if(isset($_SESSION["Usuario"]))
		return true;
	else
		return false;
}

//Eliminando variable de sesión 
function eliminarSesion(){
    if(isset($_SESSION["Usuario"])){
		unset($_SESSION["Usuario"]);
		session_destroy();
	}
	
}

//Bitacora del sitio web
function llenarLog($accion,$observacion,$usuario,$sede){
		switch($accion){
		case 1:
			$accion="INSERCIÓN";
			break;
		case 2:
			$accion="CONFIRMACIÓN";
			break;
		case 3:
			$accion="BORRADO";
			break;
		case 4:
			$accion="INICIO DE SESIÓN";
			break;
		case 5:
			$accion="FIN DE SESIÓN";
			break;
		case 6:
			$accion="COMPROBANTE";
			break;
		case 7:
			$accion="REPORTE";
			break;	
		case 8:
			$accion="VACIO DE BITACORA";
			break;	
		case 9:
			$accion="EDICIÓN";
			break;	
		}

		$parametros = array('idSede' => $sede,
				'idUsu' => $usuario,
				'accion' => $accion,
				'observacion' => $observacion);
		$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  		$client = new SOAPClient($wsdl_url);
  		$client->decode_utf8 = false;
		$registroBitacora = $client->insertarBitacora($parametros);
}

//Verificando si el usuario esta creado
function usuarioCreado(){
		$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  		$client = new SOAPClient($wsdl_url);
  		$client->decode_utf8 = false;
		$Usuario= array('idUsuario' =>$_SESSION["Usuario"]->return->idusu);
    	$Usuariocreado = $client->consultarUsuario($Usuario);
		
	if(isset($Usuariocreado->return))
		return true;
	else
		return false;
}
function Menu($SedeRol){
?>
<div>
                    <ul class="nav nav-pills">
                        <li class="pull-left">
                            <div class="modal-header" style="width:1135px;">
                                <h3> Correspondencia    
                                    <span>SH</span> <?php echo "- Hola, " . $_SESSION["Usuario"]->return->nombreusu; ?>
                                    <div class="btn-group  pull-right">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"> <span class="icon-cog" style="color:rgb(255,255,255)"> Configuracion </span> </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="../pages/view_user.php">Cuenta</a></li>
                                            <li class="divider"></li>
                                            <?php if ($_SESSION["Usuario"]->return->tipousu == "1" || $_SESSION["Usuario"]->return->tipousu == "2") { ?>
                                                <li><a href="../pages/administration.php">Administracion</a></li>
                                                <li class="divider"></li>
                                            <?php } ?>
                                            <li><a href="../recursos/cerrarsesion.php" onClick="">Salir</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Ayuda</a></li>
                                        </ul>
                                    </div>   

                                    <span class="divider pull-right" style="color:rgb(255,255,255)"> | </span>
                                    <div class="btn-group  pull-right">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"> <span class="icon-th-large" style="color:rgb(255,255,255)"> Operaciones </span> </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php if ($SedeRol->return->idrol->idrol != "4"   && $SedeRol->return->idrol->idrol != "6" ) { ?>
                                                <li><a href="confirm_package.php" > Recibir Paquete</a></li>
											 <li class="divider"></li>
											<?php }
                                            if ($SedeRol->return->idrol->idrol == "4" || $SedeRol->return->idrol->idrol == "5") {
                                                ?>
                                                <li><a href="create_valise.php" > Crear Valija</a></li>
                                                <li class="divider"></li>
                                                <li><a href="breakdown_valise.php" > Recibir Valija</a></li>
                                                <li class="divider"></li>
                                                <li><a href="reports_valise.php" > Estadisticas Valija</a></li>
                                                <li class="divider"></li>
                                            <?php }
                                            ?>
                                            <li><a href="reports_user.php" > Estadisticas Usuario</a></li>

                                        </ul>
                                    </div>
                                    <span class="divider pull-right" style="color:rgb(255,255,255)"> | </span>
                                    <div class="btn-group  pull-right">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"> <span class="icon-exclamation-sign" style="color:rgb(255,255,255)"> Alertas </span> </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="../pages/correspondence_overdue.php">Paquetes Enviados y Recibidos</a></li>
                                            <?php 
                                            if ($SedeRol->return->idrol->idrol != "6") {
                                                ?>
											<li class="divider"></li>
                                            <li><a href="../pages/tracing_overdue.php">Paquetes por Confirmar</a></li>      
											
<?php } if ($SedeRol->return->idrol->idrol == "4" || $SedeRol->return->idrol->idrol == "5") { ?>
                                                <li class="divider"></li>	                                           
                                                <li><a href="../pages/suitcase_overdue.php">Valijas</a></li>
                                             
<?php } ?>
                                        </ul>
                                    </div>                               

                                </h3>
                            </div>
                        </li>
                    </ul>
                </div>

<?php


}

?>