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
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>

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
                    <th style="text-align:center">Origen</th>
                    <th style="text-align:center" data-sort-ignore="true">Destino</th>
                    <th style="text-align:center" data-sort-ignore="true">Asunto</th>
                    <th style="text-align:center" data-sort-ignore="true">Fecha</th>
                    <th style="text-align:center" data-sort-ignore="true">Incidente</th>
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
                                ?>
                                <td style="text-align:center"><?php echo $resultadoConsultarSede->return->nombresed ?></td>
                            <?php } ?>
                            <td style="text-align:center"><?php echo $resultadoConsultarValijas->return[$i]->destinoval->nombresed ?></td>
                            <?php if (!isset($resultadoConsultarValijas->return[$i]->asuntoval)) { ?>
                                <td style="text-align:center"><?php echo "" ?></td>
                                <?php
                            } else {
                                if (strlen($resultadoConsultarValijas->return[$i]->asuntoval) > 10) {
                                    $asunto = substr($resultadoConsultarValijas->return[$i]->asuntoval, 0, 10) . "...";
                                } else {
                                    $asunto = $resultadoConsultarValijas->return[$i]->asuntoval;
                                }
                                ?>
                                <td style="text-align:center"><?php echo $asunto ?></td>											
                                <?php
                            }
                            if (!isset($resultadoConsultarValijas->return[$i]->fechaval)) {
                                ?>
                                <td style="text-align:center"><?php echo "" ?></td>
                            <?php } else { ?>
                                <td style="text-align:center"><?php echo date("d/m/Y", strtotime(substr($resultadoConsultarValijas->return[$i]->fechaval, 0, 10))) ?></td>
                                <?php
                            }
                            if (!isset($resultadoConsultarValijas->return[$i]->idinc)) {
                                ?>
                                <td style="text-align:center"><?php echo "" ?></td>
                                <?php
                            } else {
                                ?>
                                <td style="text-align:center"><?php echo $resultadoConsultarValijas->return[$i]->idinc->nombreinc ?></td>
                            <?php } ?>
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
                            ?>
                            <td style="text-align:center"><?php echo $resultadoConsultarSede->return->nombresed ?></td>
                        <?php } ?>
                        <td style="text-align:center"><?php echo $resultadoConsultarValijas->return->destinoval->nombresed ?></td>
                        <?php if (!isset($resultadoConsultarValijas->return->asuntoval)) { ?>
                            <td style="text-align:center"><?php echo "" ?></td>
                            <?php
                        } else {
                            if (strlen($resultadoConsultarValijas->return->asuntoval) > 10) {
                                $asunto = substr($resultadoConsultarValijas->return->asuntoval, 0, 10) . "...";
                            } else {
                                $asunto = $resultadoConsultarValijas->return->asuntoval;
                            }
                            ?>
                            <td style="text-align:center"><?php echo $asunto ?></td>											
                            <?php
                        }
                        if (!isset($resultadoConsultarValijas->return->fechaval)) {
                            ?>
                            <td style="text-align:center"><?php echo "" ?></td>
                        <?php } else {
                            ?>
                            <td style="text-align:center"><?php echo date("d/m/Y", strtotime(substr($resultadoConsultarValijas->return->fechaval, 0, 10))) ?></td>
                            <?php
                        }
                        if (!isset($resultadoConsultarValijas->return->idinc)) {
                            ?>
                            <td style="text-align:center"><?php echo "" ?></td>
                        <?php } else {
                            ?>
                            <td style="text-align:center"><?php echo $resultadoConsultarValijas->return->idinc->nombreinc ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>                                    
            </tbody>
        </table>
        <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>                            
        <br>
        <br>
        <?php if ($valijasProcesadas != 0 || $valijasNoProcesadas != 0) { ?>
            <div id="grafico" style="min-width: 150px; max-width: 850px; height: 350px; margin: 0 auto">   	
            </div>
            <?php
        }
    }
    ?>

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

    <script> /*Funciones de los gráfico*/
        $(function() {

            /*Gráfico del total de los enviados por fallas o no, dependiendo de si posee respuesta o no*/
            $('#grafico').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Reporte de Valijas'
                },
                xAxis: {
                    categories: [
                        'Procesadas',
                        'Fallas'
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad Total'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:8px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.01,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Valijas',
                        data: [<?php echo $valijasProcesadas ?>, <?php echo $valijasNoProcesadas ?>]

                    }]
            });
        });
    </script>
</body>
</html>