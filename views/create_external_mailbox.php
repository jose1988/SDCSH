<?php
include("../recursos/funciones.php");
if (isset($_POST["crear"])) {
    javaalert("Se ha guardado con exito");
    iraURL("inbox.php");
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
                            <div class="modal-header">
                                <h3>Correspondencia 
                                    <span>SH</span> - José
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
                    </ul>
                </div>

                <!--Caso pantalla uno-->
                <div class="row-fluid">
                    <div class="span2">
                        <ul class="nav nav-pills nav-stacked">
                            <li> <a href="crear.php">Atrás</a> <li>
                        </ul>
                    </div>

                    <div class="span10" align="center">
                        <div class="tab-content" id="lista" align="center"> 
                            <form id="formulario" method="post">                            
                                <h2> Datos del Usuario </h2> 
                                <table class='footable table table-striped table-bordered'>
                                    <tr>
                                        <td style="text-align:center" >Nombre</td>
                                        <td style="text-align:center"><input type="text" name="nombre" id="nombre" maxlength="19" size="30" title="Ingrese el primer nombre" placeholder="Ej. Jose" autofocus required></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">Apellido</td>
                                        <td style="text-align:center"><input type="text" name="apellido" id="apellido" maxlength="19" size="30" title="Ingrese el  apellido" placeholder="Ej. Fuentes"  ></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%">Cédula o Rif</td>
                                        <td style="text-align:center"><input type="text" name="cedularif" id="cedularif" maxlength="19" size="30" title="Ingrese el número de cédula o Rif" placeholder="Ej.   " required>
                                        </td>		
                                    </tr>
                                    <tr>
                                        <td style="text-align:center" width="50%">Correo</td>
                                        <td style="text-align:center"><input type="text" name="correo" id="correo" maxlength="100" size="50" title="Ingrese un correo" placeholder="Ej. josefuentes@gmail.com">
                                            <div id="Info2" style="float:right"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">Telefono 1</td>
                                        <td style="text-align:center"><input type="tel" name="telefono1" id="telefono1" maxlength="19" size="30" title="Ingrese el numero de telefono" placeholder="Ej. 04269876543"   required></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">Telefono 2</td>
                                        <td style="text-align:center"><input type="tel" name="telefono2" id="telefono2" maxlength="19" size="30" placeholder="Ej. 04168674789"  ></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">Dirección</td>
                                        <td style="text-align:center"><textarea id="direccion" name="direccion" style="width:500px"></textarea></td>		 
                                    </tr>
                                </table>
                                <br>
                                <div class="span11" align="center"><button class="btn" id="crear" name="crear" type="submit">Guardar</button></div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            /*window.onload = function(){killerSession();}
             
             function killerSession(){
             setTimeout("window.open('../recursos/cerrarsesion.php','_top');",300000);
             }
             </script>
        <script src="../js/footable.js" type="text/javascript"></script>
        <script src="../js/footable.paginate.js" type="text/javascript"></script>
        <script src="../js/footable.sortable.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jquery-2.0.3.js" ></script> 

             <script type="text/javascript">
             $(document).ready(function() {
             
             
             
             <!-- Codigo para verificar si el nombre del usuario ya existe --> 
             $('#usuario').blur(function(){
             if($(this).val()!=""){
             $('#Info').html('<img src="../images/loader.gif" alt="" />').fadeOut(1000);
             }
             var nombre = $(this).val();        
             var dataString = 'nombre='+nombre;
             
             var parametros = {
             
             "nombre" : nombre
             };
             $.ajax({
             type: "POST",
             url: "../ajax/chequeoNombreUsuario.php",
             data: parametros,
             success: function(data) {
             $('#Info').fadeIn(1000).html(data);
             }
             });     
             });
             
             
             <!-- Codigo para verificar las contraseñas --> 
             $('#contrasena_c').blur(function(){
             
             document.getElementById('fortaleza').style.display='none';
             
             if($(this).val()!="" && document.forms.formulario.contrasena.value!=""){
             $('#contra').html('<img src="../images/loader.gif" alt="" />').fadeOut(1000);
             $('#contra1').html('<img src="../images/loader.gif" alt="" />').fadeOut(1000);
             
             }
             
             var contrasena_c = $(this).val();        
             var dataString = 'contrasena_c='+contrasena_c;
             var con= document.forms.formulario.contrasena.value;
             
             $.ajax({
             type: "POST",
             url: "../ajax/chequeoContrasena.php?contra="+con+"",
             data: dataString,
             success: function(data) {
             $('#contra').fadeIn(1000).html(data);
             $('#contra1').fadeIn(1000).html(data);
             }
             });
             });
             
             $('#contrasena').blur(function(){
             document.getElementById('fortaleza').style.display='none';
             
             if($(this).val()!="" && document.forms.formulario.contrasena_c.value!=""){
             $('#contra').html('<img src="../images/loader.gif" alt="" />').fadeOut(1000);
             $('#contra1').html('<img src="../images/loader.gif" alt="" />').fadeOut(1000);
             
             }
             
             var contrasena = $(this).val();        
             var dataString = 'contrasena='+contrasena;
             var con= document.forms.formulario.contrasena_c.value;
             
             $.ajax({
             type: "POST",
             url: "../ajax/chequeoContrasena.php?contra="+con+"",
             data: dataString,
             success: function(data) {
             $('#contra').fadeIn(1000).html(data);
             $('#contra1').fadeIn(1000).html(data);
             }
             });
             });  
             <!-- Codigo para verificar si el Correo lleva el formato correcto --> 
             $('#correo').blur(function(){
             if($(this).val()!=""){
             $('#Info2').html('<img src="../images/loader.gif" alt="" />').fadeOut(1000);
             }
             var correo = $(this).val();
             var dataString = 'correo='+correo;
             $.ajax({
             type: "POST",
             url: "../ajax/chequeoCorreo.php",
             data: dataString,
             success: function(data) {
             $('#Info2').fadeIn(1000).html(data);
             }
             });     
             });	
             });
             
             <!-- Codigo para verificar la fortaleza de la contraseña --> 
             
             var numeros="0123456789";
             var letras="abcdefghyjklmnñopqrstuvwxyz";
             var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
             
             function tiene_numeros(texto){
             for(i=0; i<texto.length; i++){
             if (numeros.indexOf(texto.charAt(i),0)!=-1){
             return 1;
             }
             }
             return 0;
             } 
             
             function tiene_letras(texto){
             texto = texto.toLowerCase();
             for(i=0; i<texto.length; i++){
             if (letras.indexOf(texto.charAt(i),0)!=-1){
             return 1;
             }
             }
             return 0;
             } 
             
             function tiene_minusculas(texto){
             for(i=0; i<texto.length; i++){
             if (letras.indexOf(texto.charAt(i),0)!=-1){
             return 1;
             }
             }
             return 0;
             } 
             
             function tiene_mayusculas(texto){
             for(i=0; i<texto.length; i++){
             if (letras_mayusculas.indexOf(texto.charAt(i),0)!=-1){
             return 1;
             }
             }
             return 0;
             } 
             
             function seguridad_clave(clave){
             var seguridad = 0;
             if (clave.length!=0){
             if (tiene_numeros(clave) && tiene_letras(clave)){
             seguridad += 30;
             }
             if (tiene_minusculas(clave) && tiene_mayusculas(clave)){
             seguridad += 30;
             }
             if (clave.length >= 4 && clave.length <= 5){
             seguridad += 10;
             }else{
             if (clave.length >= 6 && clave.length <= 8){
             seguridad += 30;
             }else{
             if (clave.length > 8){
             seguridad += 40;
             }
             }
             }
             }
             return seguridad				
             }	
             
             function muestra_seguridad_clave(clave,formulario){
             seguridad=seguridad_clave(clave);
             document.getElementById('fortaleza').style.color='#FFFFFF'; 
             if(seguridad>0 && seguridad<=40){
             document.getElementById('fortaleza').style.display='block'; 
             document.getElementById('fortaleza').style.backgroundColor="#2ECCFA"; 
             formulario.fortaleza.value="Debil";
             }else if(seguridad>40 && seguridad<=70){
             formulario.fortaleza.value="Medio";
             document.getElementById('fortaleza').style.backgroundColor="#5882FA"; 
             }else if(seguridad>70){
             formulario.fortaleza.value="Fuerte";
             document.getElementById('fortaleza').style.backgroundColor="#0404B4"; 
             }else{
             document.getElementById('fortaleza').style.display='none'; 
             }		
             }*/
        </script>  

    </body>
</html>