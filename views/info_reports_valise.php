<?php
if ($usuario == "") {
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
                <?php
                Menu($SedeRol);
                ?>
                <div class="row-fluid">
                    <div class="span2">
                        <ul class="nav nav-pills nav-stacked">
                            <li> <a href="../pages/administration.php">Atrás</a> <li>
                        </ul>
                    </div>
                    
                    <div class="span10">
                        <div class="tab-content" id="lista">
                            <?php
                            //Verificando que este vacio o sea null
                            if (!isset($resultadoConsultarValijas->return)) {
                                echo '<div class="alert alert-block" align="center">';
                                echo '<h2 style="color:rgb(255,255,255)" align="center">Atención</h2>';
                                echo '<h4 align="center">No Existen Registros de Valijas</h4>';
                                echo '</div>';
                            }
                            //Si existen registros muestro la tabla
                            else {
                                ?>                        
                                <strong> <h2 align="center">Valijas</h2> </strong>
                                <table class='footable table table-striped table-bordered' data-page-size='10'>
                                    <thead bgcolor='#FF0000'>
                                        <tr>
                                            <th style="text-align:center">Fecha y Hora de Envio</th>
                                            <th style="text-align:center" data-sort-ignore="true">No de Valija</th>
                                            <th style="text-align:center" data-sort-ignore="true">No de Guía</th>
                                            <th style="text-align:center" data-sort-ignore="true">Origen</th>
                                            <th style="text-align:center" data-sort-ignore="true">Realizado por</th>
                                            <th style="text-align:center" data-sort-ignore="true">Tipo</th>
                                            <th style="text-align:center" data-sort-ignore="true">Destino</th>
                                            <th style="text-align:center" data-sort-ignore="true">Fecha y Hora de Recibido</th>
                                            <th style="text-align:center" data-sort-ignore="true">Ver Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($valijas > 1) {
                                            for ($i = 0; $i < $valijas; $i++) {
                                                ?>
                                                <tr>
                                                    <?php 
													if(isset($resultadoConsultarValijas->return[$i]->fechaval)){
														$fechaEnvio = FechaHora($resultadoConsultarValijas->return[$i]->fechaval);
													}else{
														$fechaEnvio = "";
													}
													?>
                                                    <td style="text-align:center"><?php echo $fechaEnvio ?></td>
                                                    <td style="text-align:center"><?php echo $resultadoConsultarValijas->return[$i]->idval ?></td>
                                                    <?php 
													if(isset($resultadoConsultarValijas->return[$i]->codproveedorval)) {?>
                                                    	<td align="center"><?php echo $resultadoConsultarValijas->return[$i]->codproveedorval ?></td>
                                                    <?php }
													else {?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php }?>
                                                    <td><?php echo $nombreSede[$i] ?></td>
                                                    <?php
														if(isset($resultadoConsultarValijas->return[$i]->iduse->idusu->nombreusu)) {
													?>
                                                    	<td><?php echo $resultadoConsultarValijas->return[$i]->iduse->idusu->nombreusu ?></td>
                                                    <?php }
													else {
													?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php }
													if(isset($resultadoConsultarValijas->return[$i]->tipoval)) {
													?>
                                                    	<td><?php echo $resultadoConsultarValijas->return[$i]->tipoval ?></td>
                                                    <?php } 
													else { ?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php } 
													if(isset($resultadoConsultarValijas->return[$i]->destinoval->nombresed)) {
													?>
                                                    	<td><?php echo $resultadoConsultarValijas->return[$i]->destinoval->nombresed ?></td>
                                                    <?php }
													else {?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php }
													if(isset($resultadoConsultarValijas->return[$i]->fecharval)){
														$fechaRecibido = FechaHora($resultadoConsultarValijas->return[$i]->fecharval);
													}else{
														$fechaRecibido = "";
													}
													?>                                                    
                                                    <td style="text-align:center"><?php echo $fechaRecibido ?></td>
                                                    <td style="text-align:center">
                                                    	<a href='#'><button type="submit" class="btn btn-primary" id="imprimirT" name="imprimirT">Ver Detalles</button></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                    <?php 
													if(isset($resultadoConsultarValijas->return->fechaval)){
														$fechaEnvio = FechaHora($resultadoConsultarValijas->return->fechaval);
													}else{
														$fechaEnvio = "";
													}
													?>
                                                    <td style="text-align:center"><?php echo $fechaEnvio ?></td>
                                                    <td style="text-align:center"><?php echo $resultadoConsultarValijas->return->idval ?></td>
                                                    <?php 
													if(isset($resultadoConsultarValijas->return->codproveedorval)) {?>
                                                    	<td align="center"><?php echo $resultadoConsultarValijas->return->codproveedorval ?></td>
                                                    <?php }
													else {?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php }?>
                                                    <td><?php echo $nombreSede ?></td>
                                                    <?php 
														if(isset($resultadoConsultarValijas->return->iduse->idusu->nombreusu)) {
													?>
                                                    	<td><?php echo $resultadoConsultarValijas->return->iduse->idusu->nombreusu ?></td>
                                                    <?php }
													else {
													?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php }
													if(isset($resultadoConsultarValijas->return->tipoval)) {
													?>
                                                    	<td><?php echo $resultadoConsultarValijas->return->tipoval ?></td>
                                                    <?php } 
													else { ?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php } 
													if(isset($resultadoConsultarValijas->return->destinoval->nombresed)) {
													?>
                                                    	<td><?php echo $resultadoConsultarValijas->return->destinoval->nombresed ?></td>
                                                    <?php }
													else {?>
                                                    	<td><?php echo "" ?></td>
                                                    <?php }
													if(isset($resultadoConsultarValijas->return->fecharval)){
														$fechaRecibido = FechaHora($resultadoConsultarValijas->return->fecharval);
													}else{
														$fechaRecibido = "";
													}
													?>                                                    
                                                    <td style="text-align:center"><?php echo $fechaRecibido ?></td>

                                                    <td style="text-align:center">
                                                    	<a href='#'><button type="submit" class="btn btn-primary" id="detalles" name="detalles">Ver Detalles</button></a>
                                                    </td>
                                                </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                                <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>                                
                                <br>
                                <br>
                                <div class="span11">
                                	<div class="span3"></div>
                                	<div class="span6" align="center">
                                	<table align="center" width="300" class='footable table table-striped table-bordered'>
                						<tr>
                    						<td style="text-align:center"><strong>Total de Valijas</strong></td>
                    						<td style="text-align:center" width="100"><?php echo $valijas ?></td>
                						</tr>
            						</table>
                                </div>
                                <div class="span3"></div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <form method="post">
                                    <div class="span6" align="center">
                                        <button type="submit" class="btn" id="graficar" name="graficar"> Graficar </button>
                                    </div>
                                    <div class="span6" align="center">
                                        <button type="submit" class="btn" id="imprimir" name="imprimir"> Imprimir </button>
                                    </div>
                                </form>
                                </div>
							<?php
                            }
                            ?>             
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