<?php
if (!isset($SedeRol->return)) {
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
<?php }
if ($SedeRol->return->idrol->idrol == "2" || $SedeRol->return->idrol->idrol == "5") {
    ?>
                                                <li><a href="headquarters_operator.php" > Recibir Paquete</a></li>
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
                                            <li><a href="../pages/package_overdue_origin.php">Paquetes Enviados</a></li>
                                            <li class="divider"></li>
                                            <li><a href="../pages/package_overdue_destination.php">Paquetes Recibidos</a></li>
<?php if ($SedeRol->return->idrol->idrol == "4" || $SedeRol->return->idrol->idrol == "5") { ?>
                                                <li class="divider"></li>
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
                                <a href="inbox.php">Atrás</a>
                            </li>
                        </ul>
                    </div>
                    <div class="span10">
                        <div class="tab-content" id="bandeja">
                            <form class="form-search" id="formulario">
                                <h2>Recibir paquete</h2>
                                Código de Correspondencia:  <input type="text" onkeypress="return isNumberKey(event)" placeholder="Ej. 4246" title="Ingrese el código de correspondencia" autocomplete="off" pattern="[0-9]{1,38}" style="width:140px ;height:28px" id="idpaq" name="idpaq"  required>
                                <button type="button" class="btn" onClick="Paquete();">Recibir Paquete</button>
                                <div id="data">
<?php
if (isset($PaquetesConfirmados->return)) {

    echo "<br>";
    ?>

                                        <h2> Correspondencia hoy en la Sede</h2>
                                        <table class='footable table table-striped table-bordered' data-page-size='10'>    
                                            <thead bgcolor='#FF0000'>
                                                <tr>	
                                                    <th style='width:7%; text-align:center'>Origen</th>
                                                    <th style='width:7%; text-align:center' data-sort-ignore="true">Destino</th>
                                                    <th style='width:7%; text-align:center' data-sort-ignore="true">Asunto </th>
                                                    <th style='width:7%; text-align:center' data-sort-ignore="true">Tipo</th>
                                                    <th style='width:7%; text-align:center' data-sort-ignore="true">Contenido</th>
                                                    <th style='width:7%; text-align:center' data-sort-ignore="true">Con Respuesta</th>
                                                </tr>
                                            </thead>
                                            <tbody>
    <?php
    if (count($PaquetesConfirmados->return) == 1) {
        if ($PaquetesConfirmados->return->respaq == "0") {
            $rta = "No";
        } else {
            $rta = "Si";
        }
        if (strlen($PaquetesConfirmados->return->textopaq) > 10) {
            $contenido = substr($PaquetesConfirmados->return->textopaq, 0, 10) . "...";
        } else {
            $contenido = $PaquetesConfirmados->return->textopaq;
        }
        if (strlen($PaquetesConfirmados->return->asuntopaq) > 10) {
            $asunto = substr($PaquetesConfirmados->return->asuntopaq, 0, 10) . "...";
        } else {
            $asunto = $PaquetesConfirmados->return->asuntopaq;
        }
        ?>
                                                    <tr>     
                                                        <td  style='text-align:center'><?php echo $PaquetesConfirmados->return->origenpaq->idusu->nombreusu . " " . $PaquetesConfirmados->return->origenpaq->idusu->apellidousu; ?></td>
                                                        <td style='text-align:center'><?php echo $PaquetesConfirmados->return->destinopaq->idusu->nombreusu . " " . $PaquetesConfirmados->return->destinopaq->idusu->apellidousu; ?></td>
                                                        <td style='text-align:center'><?php echo $asunto; ?></td>
                                                        <td style='text-align:center'><?php echo $PaquetesConfirmados->return->iddoc->nombredoc; ?></td>
                                                        <td style='text-align:center'><?php echo $contenido; ?></td>
                                                        <td style='text-align:center'><?php echo $rta; ?></td>  
                                                    </tr>   
        <?php
    } else {
        for ($i = 0; $i < count($PaquetesConfirmados->return); $i++) {
            if ($PaquetesConfirmados->return[$i]->respaq == "0") {
                $rta = "No";
            } else {
                $rta = "Si";
            }
            if (strlen($PaquetesConfirmados->return[$i]->textopaq) > 25) {
                $contenido = substr($PaquetesConfirmados->return[$i]->textopaq, 0, 23) . "...";
            } else {
                $contenido = $PaquetesConfirmados->return[$i]->textopaq;
            }
            if (strlen($PaquetesConfirmados->return[$i]->asuntopaq) > 10) {
                $asunto = substr($PaquetesConfirmados->return[$i]->asuntopaq, 0, 10) . "...";
            } else {
                $asunto = $PaquetesConfirmados->return[$i]->asuntopaq;
            }
            ?>
                                                        <tr>     
                                                            <td  style='text-align:center'><?php echo $PaquetesConfirmados->return[$i]->origenpaq->idusu->nombreusu . " " . $PaquetesConfirmados->return[$i]->origenpaq->idusu->apellidousu; ?></td>
                                                            <td style='text-align:center'><?php echo $PaquetesConfirmados->return[$i]->destinopaq->idusu->nombreusu . " " . $PaquetesConfirmados->return[$i]->destinopaq->idusu->apellidousu; ?></td>
                                                            <td style='text-align:center'><?php echo $asunto; ?></td>
                                                            <td style='text-align:center'><?php echo $PaquetesConfirmados->return[$i]->iddoc->nombredoc; ?></td>
                                                            <td style='text-align:center'><?php echo $contenido; ?></td>
                                                            <td style='text-align:center'><?php echo $rta; ?></td>  
                                                        </tr>   
            <?php
        }
    }//fin else
    ?>  
                                            </tbody>
                                        </table>
                                        <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>								

                                                <?php
                                            }
                                            ?>


                                </div>  

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /container -->
            <div id="footer" class="container">    	
            </div>
        </div>
        <script>

                                    window.onload = function() {
                                        killerSession();
                                    }
                                    function killerSession() {
                                        setTimeout("window.open('../recursos/cerrarsesion.php','_top');", 300000);
                                    }

                                    function isNumberKey(evt)
                                    {
                                        var charCode = (evt.which) ? evt.which : event.keyCode
                                        if (charCode == 13) {
                                            Paquete();
                                        }
                                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                            return false;
                                        }

                                        return true;
                                    }
        </script>
        <script>

            function Paquete() {
                if (idpaq = document.forms.formulario.idpaq.value != "") {
                    var idpaq = document.forms.formulario.idpaq.value;
                    var parametros = {
                        "idpaq": idpaq
                    };
                    $.ajax({
                        type: "POST",
                        url: "../ajax/view_package_headquarters.php",
                        data: parametros,
                        dataType: "text",
                        success: function(response) {
                            $("#data").html(response);
                        }
                    });
                    document.forms.formulario.idpaq.value = "";
                } else {
                    alert("Por favor agregue el código de correspondencia")
                }


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