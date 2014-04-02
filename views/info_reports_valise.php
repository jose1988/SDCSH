<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Seguros Horizonte | HorizonLine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- javascript -->
        <script type='text/javascript' src="../js/jquery-2.0.2.js"></script>
        <script type='text/javascript' src="../js/bootstrap.js"></script>
        <script type='text/javascript' src="../js/bootstrap-transition.js"></script>
        <script type='text/javascript' src="../js/bootstrap-tooltip.js"></script>
        <script type='text/javascript' src="../js/modernizr.min.js"></script>
<!--<script type='text/javascript' src="../js/togglesidebar.js"></script>-->	
        <script type='text/javascript' src="../js/custom.js"></script>
        <script type='text/javascript' src="../js/jquery.fancybox.pack.js"></script>
        <!-- javascript para el funcionamiento del calendario -->
        <link rel="stylesheet" type="text/css" href="../js/ui-lightness/jquery-ui-1.10.3.custom.css" media="all" />
        <script type="text/javascript" src="../js/jquery-ui-1.10.3.custom.js" ></script> 
        <script type="text/javascript" src="../js/calendarioValidado.js" ></script>

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

                    <div class="span10" align="center">
                        <div class="tab-content" id="lista" align="center">
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
                                <strong> <h2 align="center">Reporte de Valijas</h2> </strong>
                                <table class='footable table table-striped table-bordered' data-page-size='5'>
                                    <thead bgcolor='#FF0000'>
                                        <tr>
                                            <th style="text-align:center">Fecha y Hora de Envio</th>
                                            <th style="text-align:center" data-sort-ignore="true">No de Valija</th>
                                            <th style="text-align:center" data-sort-ignore="true">No de Guía</th>
                                            <th style="text-align:center" data-sort-ignore="true">Origen</th>
                                            <th style="text-align:center" data-sort-ignore="true">Realizado por</th>
                                            <th style="text-align:center" data-sort-ignore="true">Tipo</th>
                                            <th style="text-align:center" data-sort-ignore="true">Destino</th>
                                            <th style="text-align:center" data-sort-ignore="true">Recibido</th>                                            
                                            <th style="text-align:center" data-sort-ignore="true">Fecha y Hora de Recibido</th>
                                            <th style="text-align:center" data-sort-ignore="true">Ver Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($valijas > 1) {
                                            for ($i = 0; $i < $valijas; $i++) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    $idSed = $resultadoConsultarValijas->return[$i]->origenval;
                                                    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
                                                    $client = new SOAPClient($wsdl_url);
                                                    $client->decode_utf8 = false;

                                                    $idSede = array('idSede' => $idSed);
                                                    $resultadoConsultarSede = $client->consultarSedeXId($idSede);

                                                    if (!isset($resultadoConsultarSede->return)) {
                                                        $sede = 0;
                                                    } else {
                                                        $sede = count($resultadoConsultarSede->return);
                                                    }
                                                    ?>

                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <?php
                                                $idSed = $resultadoConsultarValijas->return->origenval;
                                                $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
                                                $client = new SOAPClient($wsdl_url);
                                                $client->decode_utf8 = false;

                                                $idSede = array('idSede' => $idSed);
                                                $resultadoConsultarSede = $client->consultarSedeXId($idSede);

                                                if (!isset($resultadoConsultarSede->return)) {
                                                    $sede = 0;
                                                } else {
                                                    $sede = count($resultadoConsultarSede->return);
                                                }
                                                ?>

                                            </tr>
                                        <?php } ?>                                    
                                    </tbody>
                                </table>
                                <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>
                                <form method="post">                                
                                    <div class="span6" align="center">
                                        <button type="submit" class="btn" id="graficar" name="graficar"> Graficar </button>
                                    </div>
                                </form>
                                <div class="span5" align="center">
                                    <a href='../pages/proof_of_correspondence_package.php?id=<?php echo $idPaquete ?>' target="new"><button type="submit" class="btn" id="imprimir" name="imprimir"> Imprimir</button></a>
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
    </body>
</html>