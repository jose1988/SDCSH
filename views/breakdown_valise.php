<?php


if(isset($_POST["guardar"])){
		try{
		
			$registrosAValijaC=$_POST["idc"];
			
			$registrosC=count($_POST["idc"]);
			$registrosAValijaR=$_POST["idr"];
			$registrosR=count($_POST["idr"]);
			$contadorEliminados=0;
			$wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $usu= array('idusu' => $_SESSION["Usuario"]->return->idusu);
  $sede= array('idsed' => $_SESSION["Sede"]->return->idsed);
			if(isset($registrosAValijaR)){
			
			  $datosValija = array('idval' => $_SESSION["valdes"], 'status'=> "2",'idusu' => $_SESSION["Usuario"]->return->idusu,'sede' => $_SESSION["Sede"]->return->nombresed);
			
			for($j=0; $j<$_SESSION["RE"]; $j++){
			
					if(isset($registrosAValijaR[$j])){
					
				$datosfa = array('idpaq'=> $registrosAValijaR[$j], 'datosPaquete' => "paquete ausente, no encontro en la valija respectiva");
				$client->reportarPaqueteAusente($datosfa);
			
				}		
				
			  }	
			   
			}else{
				$datosValija = array('idval' => $_SESSION["valdes"],'status'=> "1",'idusu' => $_SESSION["Usuario"]->return->idusu,'sede' => $_SESSION["Sede"]->return->nombresed);
			}
			
			
			if(isset($registrosAValijaC)){	
				
			for($j=0; $j<$_SESSION["RE"]; $j++){
			   if(isset($registrosAValijaC[$j])){
				$datosAct = array('idpaq'=> $registrosAValijaC[$j],'Localizacion' => "Sede Destino");
				
				$client->actualizacionLocalizacionRecibidoValija($datosAct);
				$idPaquete= array('idpaq'=> $registrosAValijaC[$j]);
				$parametros=array('registroPaquete' => $idPaquete,'registroUsuario'=>$usu,'registroSede'=>$sede);
				$seg = $client->registroSeguimiento($parametros);

			  }	
			 }
			}
				
  $idValija = $client->entregarValija($datosValija);
  
  unset($_SESSION["valdes"]);
  javaalert("Confimada la valija");
  
		 } catch (Exception $e) {
			javaalert('Lo sentimos no hay conexión');
			iraURL('../index.php');
		}
		//javaalert("Los registros han sido habilitados");
		//iraURL('inbox.php');
	}else if(isset($_POST["guardar"])){
		javaalert("Debe seleccionar al menos un registro");
	}

?>	 	 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Seguros Horizonte | HorizonLine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- javascript -->
        <script type='text/javascript' src="../js/jquery-1.9.1.js"></script>
        <script type='text/javascript' src="../js/bootstrap.js"></script>
        <script type='text/javascript' src="../js/bootstrap-transition.js"></script>
        <script type='text/javascript' src="../js/bootstrap-tooltip.js"></script>
        <script type='text/javascript' src="../js/modernizr.min.js"></script>
<!--<script type='text/javascript' src="../js/togglesidebar.js"></script>-->	
        <script type='text/javascript' src="../js/custom.js"></script>
        <script type='text/javascript' src="../js/jquery.fancybox.pack.js"></script>


      <!-- styles -->
        <link rel="shortcut icon" href="../images/faviconsh.ico">
       
       
        <link rel="shortcut icon" href="../images/faviconsh.ico">
       
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-combined.min.css" rel="stylesheet">
        <link href="../css/bootstrap-responsive.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/jquery.fancybox.css" rel="stylesheet">
        <!-- [if IE 7]>
          <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
        <![endif]--> 

        <!--Load fontAwesome css-->
        <link rel="stylesheet" type="text/css" media="all" href="../font-awesome/css/font-awesome.min.css">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- [if IE 7]>
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <link href="../css/footable-0.1.css" rel="stylesheet" type="text/css" />
        <link href="../css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
        <link href="../css/footable.paginate.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="appBg">
        <div id="header">
            <div class="container header-top-top hidden-phone">
                <img alt="" src="../images/header-top-top-left.png" class="pull-left">
                <img alt="" src="../images/header-top-top-right.png" class="pull-right">
            </div>
            <div class="header-top">
                <div class="container">
                    <img alt="" src="../images/header-top-left.png" class="pull-left">
                    <div class="pull-right">
                    </div>
                </div>
                <div class="filter-area">
                    <div class="container">
                        <span lang="es">&nbsp;</span></div>
                </div>
            </div>
        </div>

       <div id="middle">
            <div class="container app-container">
                <div>
                    <ul class="nav nav-pills">
                        <li class="pull-left">
                            <div class="modal-header" style="width:1135px;">
                                <h3> Correspondencia    
                                    <span>SH</span> <?php echo "- Hola, ".$_SESSION["Usuario"]->return->nombreusu;?>
                                       <div class="btn-group  pull-right">
                                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"> <span class="icon-cog" style="color:rgb(255,255,255)"> Configuracion </span> </button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li><a href="../pages/view_user.php">Cuenta</a></li>
                                            <li class="divider"></li>
                                            <?php if($_SESSION["Usuario"]->return->tipousu=="1"|| $_SESSION["Usuario"]->return->tipousu=="2"){ ?>
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
                                            <?php 
                                      
                                                       if($SedeRol->return->idrol->idrol=="1"|| $SedeRol->return->idrol->idrol=="3"){ ?>
                                            <li><a href="operator_level.php" > Recibir Paquete</a></li>
                                            <li class="divider"></li>
                                            <?php }
                                                        if($SedeRol->return->idrol->idrol=="2"|| $SedeRol->return->idrol->idrol=="5"){ ?>
                                            <li><a href="headquarters_operator.php" > Recibir Paquete</a></li>
                                            <li class="divider"></li>
                                            <?php }
                                                        if($SedeRol->return->idrol->idrol=="4" || $SedeRol->return->idrol->idrol=="5"){ ?>
                                            <li><a href="create_valise.php" > Crear Valija</a></li>
                                            <li class="divider"></li>
                                            <li><a href="breakdown_valise.php" > Recibir Valija</a></li>
                                            <li class="divider"></li>
                                            <li><a href="reports_valise.php" > Estadisticas Valija</a></li>
                                            <li class="divider"></li>
                                            <?php  }
                                                     
                                      
                                                      
                                                       ?>
                                            <li><a href="reports_user.php" > Estadisticas Usuario</a></li>
                                           
                                          </ul>
                                        </div>
                                        <span class="divider pull-right" style="color:rgb(255,255,255)"> | </span>
                                        <div class="btn-group  pull-right">
                                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"> <span class="icon-exclamation-sign" style="color:rgb(255,255,255)"> Alertas </span> </button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li><a href="../pages/package_overdue_origin.php">Paquetes Enviados</a></li>
                                            <li class="divider"></li>
                                            <li><a href="../pages/package_overdue_destination.php">Paquetes Recibidos</a></li>
                                           
                                            <?php if($SedeRol->return->idrol->idrol=="4"|| $SedeRol->return->idrol->idrol=="5"){
												 if($SedeRol->return->idrol->idrol=="5"){ ?>
                                                  <li class="divider"></li>
                                            <?php } ?>
                                           
                                            <li><a href="../pages/suitcase_overdue_origin.php">Valijas Enviadas</a></li>
                                            <li class="divider"></li>
                                            <li><a href="../pages/suitcase_overdue_destination.php"> Valijas Recibidas </a></li>
                                            <?php } ?>
                                          </ul>
                                        </div>                               
                                  
                                </h3>
                            </div>
                        </li>
                    </ul>
                </div><!--Caso pantalla uno-->
            <div class="row-fluid">
                <div class="span2">
                    <ul class="nav nav-pills nav-stacked">
                        <li> <a href="inbox.php">Atrás</a> <li>
                        <li> <a href="valise_report.php">Reportar Valija</a> <li>
                    </ul>
                </div>

                <div class="span10">
                    <div class="tab-content" id="lista">
                        <h2> <strong> Desglosar Valija </strong> </h2>
                        <form class="form-Dvalija" method="post" id="fval">
                            Código de Valija:  <input type="text" placeholder="Ej. 4246" title="Ingrese el código de Valija" autocomplete="off" style="width:140px ;height:28px" onkeypress="return isNumberKey(event)" pattern="[0-9]{1,38}" id="idval" name="idval" class="input-medium search-query">
                            <button type="button"  onClick="Valija();" class="btn" >Buscar</button>
                        </form>
                        
                        <div id="valija">
                  
						</div>
                       
                        <?php /* ?><div class='alert alert-block' align='center'>
                          <h2 style='color:rgb(255,255,255)' align='center'>Atención</h2>
                          <h4 align='center'>No hay usuarios </h4><?php */ ?>
                       
                    </div>

                    <!-- /container -->
                    <div id="footer" class="container">    	
                    </div>
                </div>
            </div>
        </div>


<div id="alert">

</div>
        <script>
            window.onload = function(){killerSession();}
            
           function killerSession(){
            setTimeout("window.open('../recursos/cerrarsesion.php','_top');",300000);
           }
        </script>
        
        <script>
	
	function Valija(){
			var idval= document.forms.fval.idval.value;
			 var parametros = {
                "idval" : idval
       		 };
			$.ajax({
           	type: "POST",
           	url: "../ajax/breakdown_valise.php",
           	data: parametros,
           	dataType: "text",
			success:  function (response) {
            	$("#valija").html(response);
			}
		
	    }); 
		
		
	}



	</script>
    
    	 
<script>
	
	function Reportar(idpaq){
		
			
			 var parametros = {
                "idpaq" : idpaq
       		 };
			$.ajax({
           	type: "POST",
           	url: "../ajax/packeges_report.php",
           	data: parametros,
           	dataType: "text",
			success:  function (response) {
            	$("#alert").html(response);
			}
		
	    }); 
		
		
	}
	
	function Confirmar(idpaq){
			
			 var parametros = {
                "idpaq" : idpaq
       		 };
			$.ajax({
           	type: "POST",
           	url: "../ajax/packeges_report_confirm.php",
           	data: parametros,
           	dataType: "text",
			success:  function (response) {
            	$("#alert").html(response);
			}
		
	    }); 
	
	}
	

	</script>
        <script src="../js/footable.js" type="text/javascript"></script>
        <script src="../js/footable.paginate.js" type="text/javascript"></script>
        <script src="../js/footable.sortable.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $('table').footable();
            });
        </script>
    </body>
</html>