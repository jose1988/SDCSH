<?php
session_start();
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
                            <div class="modal-header">
                                <h3> Correspondencia    
                                    <span>SH</span> <?php echo "- José" ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">				
                                            <span class="icon-cog" style="color:rgb(255,255,255)"> </span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Editar Usuario</a></li>
                                            <li class="divider"></li>
                                            <li><a href="../recursos/cerrarsesion.php" onClick="">Salir</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Ayuda</a></li>
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
                        <a href="send_correspondence.php" ><button type="button" class="btn btn-info " value="Redactar"> Redactar Correspondencia</button> </a>
                        <ul class="nav nav-pills nav-stacked">
                            <li> <a href="inbox.php" >  Recibidos </a></li>
                            <li> <a href="recibidosPendientes.php" >  Recibidos Pendientes </a></li>
                            <li> <a href="enviados.php" >  Enviados </a></li>
                            <li> <a href="enviadosPendientes.php" >  Enviados Pendientes </a></li>
                            <li> <a href="reports_user.php" >  Reportes </a></li>
                        </ul>
                        <?php if ($_SESSION["Usuario"] == "operador") { ?>
                            <a href="operator_level.php" ><button type="button" class="btn btn-info btn-primary " value="Recibir paquete">  Recibir paquete del usuario  </button> </a>
                        <?php
                        }
                        if ($_SESSION["Usuario"] == "operadorsede") {
                            ?>
                            <a href="headquarters_operator.php" > <button type="button"class="btn btn-info btn-primary"  value="Recibir paquete">  Recibir paquete del usuario   </button> </a>
                        <?php
                        }
                        if ($_SESSION["Usuario"] == "empaquetador") {
                            ?>
                            <a href="create_valise.php" ><button type="button" class="btn btn-info btn-primary" value="Realizar Valija">   Realizar Valija para enviar  </button> </a>
<?php }
?>
                    </div>

                    <div class="span10">
                        <div class="tab-content" id="bandeja">
                            <strong>
                                <h2> Enviados Pendientes </h2>
                            </strong>
                            <table class='footable table table-striped table-bordered' data-page-size='10'>
                                <thead bgcolor='#ff0000'>
                                    <tr>
                                        <th style='width:7%; text-align:center' >Destino</th>
                                        <th style='width:7%; text-align:center' data-sort-ignore="true">Asunto </th>
                                        <th style='width:7%; text-align:center' >Tipo</th>
                                        <th style='width:7%; text-align:center' >Con Respuesta</th>
                                        <th style='width:7%; text-align:center'>Fecha</th>
                                        <th style='width:7%; text-align:center' data-sort-ignore="true">Localización</th>
                                        <th style='width:7%; text-align:center' data-sort-ignore="true">Ver más</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style='text-align:center'>Mayra Mora</td>
                                        <td style='text-align:center'>Artículos</td>
                                        <td style='text-align:center'>Doc</td>
                                        <td style='text-align:center'>[X]</td>
                                        <td style='text-align:center'>03/02/2014</td>
                                        <td style='text-align:center'>Sede Caracas</td>
                                        <td style="text-align:center"><a href="see_package.php?id=1"><button class="btn"> <span class="add-on"><i class="icon-eye-open"></i> </span> Ver  </button> </td>
                                    </tr>
                                    <tr>
                                        <td style='text-align:center'>Jose Moncada</td>
                                        <td style='text-align:center'>Entregas</td>
                                        <td style='text-align:center'>Doc. Digital</td>
                                        <td style='text-align:center'>[X]</td>
                                        <td style='text-align:center'>03/02/2014</td>
                                        <td style='text-align:center'>Receptor 1 sede</td>
                                        <td style="text-align:center"><a href="see_package.php?id=2"><button class="btn"> <span class="add-on"><i class="icon-eye-open"></i> </span> Ver  </button> </td>
                                    </tr>
                                    <tr>
                                        <td style='text-align:center'>Mayra Benavides</td>
                                        <td style='text-align:center'>Permiso</td>
                                        <td style='text-align:center'>Obj</td>
                                        <td style='text-align:center'>[]</td>
                                        <td style='text-align:center'>03/02/2014</td>
                                        <td style='text-align:center'>Receptor 1 origen</td>
                                        <td style="text-align:center"><a href="see_package.php?id=3"><button class="btn"> <span class="add-on"><i class="icon-eye-open"></i> </span> Ver  </button> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul id="pagination" class="footable-nav">
                                <span>Pag:</span>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /container -->
            <div id="footer" class="container">    	
            </div>
        </div>

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