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
                            <h2> <strong>Estadísticas de Valijas</strong> </h2>                    
                            <h2>                            
                                <form class="form-Dvalija" method="post" id="fval">
                                    Fecha de Inicio:<input type="text" id="datepicker" name="datepicker" autocomplete="off" style="width:100px" title="Seleccione la fecha de alerta" required/>
                                    Fecha de Fin:<input type="text" id="datepickerf" name="datepickerf" autocomplete="off" style="width:100px" title="Seleccione la fecha límite" required/>
                                    <button type="button" onClick="Editar();" class="btn">Buscar</button>
                                </form>
                            </h2>
                            <div id="datos">                            
                                <br>
                            </div>
                            <div class="span11" align="center"></div>
                            <br>                      
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
            function Editar() {
                var fechaInicio = document.forms.fval.datepicker.value;
                var fechaFin = document.forms.fval.datepickerf.value;
                var parametros = {
                    "fechaInicio": fechaInicio,
                    "fechaFin": fechaFin
                };
                $.ajax({
                    type: "POST",
                    url: "../ajax/reports_valise.php",
                    data: parametros,
                    dataType: "text",
                    success: function(response) {
                        $("#datos").html(response);
                    }
                });
            }
        </script>

    </body>
</html>