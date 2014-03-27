<?php
if (!isset($Usuario->return)) {
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
    <?php
    $apellido = "";
    $correo = "";
    $telefono1 = "";
    $telefono2 = "";
    $direccion1 = "";
    $direccion2 = "";
    if (isset($Usuario->return->apellidousu)) {
        $apellido = $Usuario->return->apellidousu;
    }
    if (isset($Usuario->return->correousu)) {
        $correo = $Usuario->return->correousu;
    }
    if (isset($Usuario->return->telefonousu)) {
        $telefono1 = $Usuario->return->telefonousu;
    }
    if (isset($Usuario->return->telefono2usu)) {
        $telefono2 = $Usuario->return->telefono2usu;
    }
    if (isset($Usuario->return->direccionusu)) {
        $direccion1 = $Usuario->return->direccionusu;
    }
    if (isset($Usuario->return->direccion2usu)) {
        $direccion2 = $Usuario->return->direccion2usu;
    }
    ?>
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
                                            <li class="divider"></li>
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
                        <li> <a href="inbox.php">Atrás</a> </li>
                    </ul>
                </div>

                <div class="span10" align="center">
                    <div class="tab-content" id="lista" align="center"> 
                        <form id="formulario" method="post">      
                            <div class="tab-content" id="lista" align="center"> 
                                <h2> Datos del Usuario </h2> 
                                <table class='footable table table-striped table-bordered'>
                                    <tr>
                                        <td style="text-align:center" >Nombre</td>
                                        <td style="text-align:center"><input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $Usuario->return->nombreusu; ?>" maxlength="150" size="30"  autofocus required></td>
                                    </tr>
                                    <tr>

                                        <td style="text-align:center">Apellido</td>
                                        <td style="text-align:center"><input type="text" name="apellido" id="apellido" autocomplete="off" value="<?php echo $apellido; ?>" maxlength="150" size="30"  ></td>
                                    </tr>

                                    <td style="text-align:center" width="50%">Correo</td>
                                    <td style="text-align:center"><input type="email" name="correo" id="correo" autocomplete="off" value="<?php echo $correo; ?>" maxlength="100" size="50" >	 
                                    </td>		

                                    </tr>

                                    <tr>

                                        <td style="text-align:center" width="50%">Usuario</td>
                                        <td style="text-align:center"><input type="text" name="usuario" id="usuario"  value="<?php echo $Usuario->return->userusu; ?>" size="30"   disabled>
                                        </td>		
                                    </tr>
                                    <tr>


                                    <tr>

                                        <td style="text-align:center">Teléfono 1</td>
                                        <td style="text-align:center"><input type="tel" name="telefono1" id="telefono1" autocomplete="off" value="<?php echo $telefono1; ?>" maxlength="50" size="30"    ></td>
                                    </tr>
                                    <tr>

                                        <td style="text-align:center">Teléfono 2</td>
                                        <td style="text-align:center"><input type="tel" name="telefono2" id="telefono2" autocomplete="off" value="<?php echo $telefono2; ?>" maxlength="50" size="30"  ></td>
                                    </tr>
                                    <tr>

                                        <td style="text-align:center">Dirección 1</td>
                                        <td style="text-align:center"><textarea style="width:500px;"   id="direccion1" name="direccion1"  maxlength="2000" style="width:800px"><?php echo $direccion1; ?></textarea></td>
                                    </tr>
                                    <tr>

                                        <td style="text-align:center">Dirección 2</td>
                                        <td style="text-align:center"><textarea style="width:500px;" id="direccion2" name="direccion2" maxlength="2000" style="width:800px"><?php echo $direccion2; ?></textarea></td>
                                    </tr>

                                </table><br>
                                <div class="span11" align="center"><button class="btn" id="guardar" name="guardar" onclick="return confirm('¿Esta seguro que desea guardar los cambios?')" type="submit">Guardar</button></div>
                                <br>
                                </form>
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
            <script type="text/javascript" src="../js/jquery-2.0.3.js" ></script> 


    </body>
</html>