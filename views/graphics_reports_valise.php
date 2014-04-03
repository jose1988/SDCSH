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
        <!-- Scripts de los graficos -->
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
                            <li> <a href="../pages/reports_valise.php">Atrás</a> <li>
                        </ul>
                    </div>

                    <div class="span10" align="center">
                        <div class="tab-content" id="lista" align="center">
                            <h2> <strong>Gráfico de Valijas</strong> </h2>
                            <br>                            
                            <?php
                            if ($opcionSede == "") {
                                if ($contadorSede <= 10) {
                                    $tama = 300;
                                } elseif ($contadorSede > 10 && $contadorSede <= 20) {
                                    $tama = 400;
                                } elseif ($contadorSede > 20 && $contadorSede <= 30) {
                                    $tama = 500;
                                } elseif ($contadorSede > 30 && $contadorSede <= 40) {
                                    $tama = 600;
                                }
                                ?>
                                <div align="center" id="graficoHorizontal" style="min-width: 100px; max-width: 600px; height: <?php echo $tama ?>px; margin: 0 auto">   	
                                </div>
                                <?php } else {
                                ?>
                                <div align="center" id="graficoVertical" style="min-width: 200px; max-width: 400px; height: 400px; margin: 0 auto">   	
                                </div>
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
        <script>
            /*Gráfico vertical para las valijas de una sede*/
            $(function() {
                $('#graficoVertical').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Estadísticas de Valijas'
                    },
                    xAxis: {
                        categories: [
                            'Nombre de la Sede'
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
                            data: [100]

                        }]
                });
            });
        </script>

        <script>
            /*Gráfico horizontal para todas las sedes*/
            $(function() {
                $('#graficoHorizontal').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Estradísticas de Valijas'
                    },
                    xAxis: {
                        categories: ['San Cristóbal', 'Caracas', 'Mérida', 'Maracaibo', 'San Fernando de Apure', 'Barinas', 'Margarita', 'Valencia', 'Valera', 'Maracay'],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad Total',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: 'Valijas'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 0,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: '#FFFFFF',
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: 'Valijas',
                            data: [107, 31, 635, 203, 2, 20, 100, 400, 30, 500]
                        }]
                });
            });
        </script>
    </body>
</html>