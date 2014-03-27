<?php
if ($idPaquete == "" || $usuario == "") {
    echo '<script language="javascript"> window.location = "../pages/inbox.php"; </script>';
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
                                            <?php if ($SedeRol->return->idrol->idrol == "1" || $SedeRol->return->idrol->idrol == "3") { ?>
                                                <li><a href="operator_level.php" > Recibir Paquete</a></li>
                                                <li class="divider"></li>
                                                <?php
                                            }
                                            if ($SedeRol->return->idrol->idrol == "2" || $SedeRol->return->idrol->idrol == "5") {
                                                ?>
                                                <li><a href="headquarters_operator.php" > Recibir Paquete</a></li>
                                                <li class="divider"></li>
                                                <?php
                                            }
                                            if ($SedeRol->return->idrol->idrol == "4" || $SedeRol->return->idrol->idrol == "5") {
                                                ?>
                                                <li><a href="create_valise.php" > Crear Valija</a></li>
                                                <li class="divider"></li>
                                                <li><a href="breakdown_valise.php" > Recibir Valija</a></li>
                                                <li class="divider"></li>
                                                <li><a href="reports_valise.php" > Estadisticas Valija</a></li>
                                                <li class="divider"></li>
                                            <?php } ?>
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
                                            <li class="divider"></li>
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
                </div>

                <!--Caso pantalla uno-->
                <div class="row-fluid">
                    <div class="span2">
                        <ul class="nav nav-pills nav-stacked">
                            <li>   
                                <a href="../pages/inbox.php">
                                    <?php echo "Atrás" ?>         
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="span10" align="center">
                        <div class="tab-content" id="lista" align="center">
                            <?php
                            //Verificando que este vacio o sea null
                            if (!isset($resultadoPaquete->return)) {
                                echo '<div class="alert alert-block" align="center">';
                                echo '<h2 style="color:rgb(255,255,255)" align="center">Atención</h2>';
                                echo '<h4 align="center">No Existen Registros del Paquete</h4>';
                                echo '</div>';
                            }
                            //Si existen registros muestro la tabla
                            else {
                                ?>               
                                <h2> Datos del Paquete </h2> 
                                <table class='footable table table-striped table-bordered'>
                                    <tr>			 
                                        <td style="text-align:center"><b>Destino</b></td>
                                        <?php if ($resultadoPaquete->return->destinopaq->tipobuz == '0') { ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->destinopaq->idusu->nombreusu . ' ' . $resultadoPaquete->return->destinopaq->idusu->apellidousu ?></td>
                                            <?php
                                        }
                                        if ($resultadoPaquete->return->destinopaq->tipobuz == '1') { ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->destinopaq->idusu->nombrebuz ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Asunto</b></td>
                                        <?php if (!isset($resultadoPaquete->return->asuntopaq)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->asuntopaq ?></td>
                                        <?php } ?>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Texto</b></td>
                                        <?php if (!isset($resultadoPaquete->return->textopaq)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->textopaq ?></td>
                                        <?php } ?>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Fecha Paquete</b></td>
                                        <?php if (!isset($resultadoPaquete->return->fechapaq)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo date("d/m/Y", strtotime(substr($resultadoPaquete->return->fechapaq, 0, 10))) ?></td>
                                        <?php } ?>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Fecha Envio Paquete</b></td>
                                        <?php if (!isset($resultadoPaquete->return->fechaenviopaq)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo date("d/m/Y", strtotime(substr($resultadoPaquete->return->fechaenviopaq, 0, 10))) ?></td>
                                        <?php } ?>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Fecha Alerta Paquete</b></td>
                                        <?php if (!isset($resultadoPaquete->return->fechaapaq)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo date("d/m/Y", strtotime(substr($resultadoPaquete->return->fechaapaq, 0, 10))) ?></td>
                                        <?php } ?>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Status</b></td>
                                        <?php if (!isset($resultadoPaquete->return->statuspaq)) { ?>
                                            <td style="text-align:center"><?php echo "" ?></td>
                                            <?php
                                        } else {
                                            if ($resultadoPaquete->return->statuspaq == "0") {
                                                $statusPaquete = "En Proceso";
                                            } elseif ($resultadoPaquete->return->statuspaq == "1") {
                                                $statusPaquete = "Entregado";
                                            } elseif ($resultadoPaquete->return->statuspaq == "2") {
                                                $statusPaquete = "No Permitido";
                                            } elseif ($resultadoPaquete->return->statuspaq == "3") {
                                                $statusPaquete = "Reenviado";
                                            } elseif ($resultadoPaquete->return->statuspaq == "4") {
                                                $statusPaquete = "Ausente";
                                            }
                                            ?>
                                            <td style="text-align:center"><?php echo $statusPaquete ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Localización</b></td>
                                        <?php if (!isset($resultadoPaquete->return->localizacionpaq)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->localizacionpaq ?></td>
                                        <?php } ?>
                                    </tr>                                    
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Prioridad</b></td>
                                        <?php if (!isset($resultadoPaquete->return->idpri)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->idpri->nombrepri ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Mensaje</b></td>
                                        <?php if (!isset($resultadoPaquete->return->idmen)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->idmen->nombremen ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Documento</b></td>
                                        <?php if (!isset($resultadoPaquete->return->iddoc)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->iddoc->nombredoc ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Asunto Valija</b></td>
                                        <?php if (!isset($resultadoPaquete->return->idval)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->idval->asuntoval ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Con Respuesta</b></td>
                                        <?php if ($resultadoPaquete->return->respaq == '0') { ?>
                                            <td style="text-align:center"><?php echo "No" ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo "Si" ?></td>
                                        <?php } ?>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Sede</b></td>
                                        <?php if (!isset($resultadoPaquete->return->idsed)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->idsed->nombresed ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Respuesta al Paquete</b></td>
                                        <?php if (!isset($resultadoPaquete->return->idpaqres)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><?php echo $resultadoPaquete->return->idpaqres->idpaq ?></td>
                                        <?php } ?>
                                    </tr>                                    
                                    <tr>
                                        <td style="text-align:center" width="50%"><b>Imagen del Paquete</b></td>
                                        <?php if (!isset($resultadoAdjunto->return)) { ?>
                                            <td style="text-align:center"><?php echo ""; ?></td>
                                        <?php } else {
                                            ?>
                                            <td style="text-align:center"><img src="<?php echo $resultadoAdjunto->return->urladj ?>" height="190" width="270"></td>
                                            <?php } ?>	
                                    </tr>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.onload = function() {
                killerSession();
            }
            function killerSession() {
                setTimeout("window.open('../recursos/cerrarsesion.php','_top');", 300000);
            }
        </script>    
    </body>
</html>