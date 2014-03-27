<?php
///Si el contador excede el valor para ver 2 páginas
if ($contadorPaquetes > 5) {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Comprobante de Listado de Paquetes en Nivel 1</title>
            <link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
        </head>
        <body>
            <br>
            <table align="center" width="500" border="0" >
                <tr>
                    <td>
                        <img src="../images/header-top-left.png" width="300" height="50">
                        <h2 align="center">Sistema de Correspondencia</h2>
                        <h3 align="center">Paquetes Confirmados Hoy <?php echo $nombreRol ?></h3>
                        <table width="500" border="1" id="borde">
                            <tr>
                                <td style="text-align:center"><strong>Paquete</strong></td>
                                <td style="text-align:center"><strong>Origen</strong></td>
                                <td style="text-align:center"><strong>Destino</strong></td>
                                <td style="text-align:center"><strong>Dirección</strong></td>
                                <td style="text-align:center"><strong>Teléfono</strong></td>
                                <td style="text-align:center"><strong>Respuesta al Paquete</strong></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < $contadorPaquetes; $i++) {
                                $ruta[$i] = "../images/codigoBarras/" . $idpaq[$i] . ".png";
                                ?>
                                <tr>
                                    <td align="center"><img src=<?php echo $ruta[$i] ?>></td>
                                    <td><?php echo $origen[$i] ?></td>
                                    <td><?php echo $destino[$i] ?></td>
                                    <td><?php echo $direccion[$i] ?></td>
                                    <td><?php echo $telefono[$i] ?></td>
                                    <td align="center"><?php echo $idPaqRes[$i] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <table width="500" border="0">
                            <tr>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>Usuario <?php echo $nombreRol ?></strong></td>
                                <td colspan="2" align="center"><strong>Recepción</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>  
            <br><table style="page-break-after:always"></table><br><br>
            <br><br>
            <br><br>
            <table align="center" width="500" border="0" >
                <tr>
                    <td>
                        <img src="../images/header-top-left.png" width="300" height="50">
                        <h2 align="center">Sistema de Correspondencia</h2>
                        <h3 align="center">Paquetes Confirmados Hoy <?php echo $nombreRol ?></h3>
                        <table width="500" border="1" id="borde">
                            <tr>
                                <td style="text-align:center"><strong>Paquete</strong></td>
                                <td style="text-align:center"><strong>Origen</strong></td>
                                <td style="text-align:center"><strong>Destino</strong></td>
                                <td style="text-align:center"><strong>Dirección</strong></td>
                                <td style="text-align:center"><strong>Teléfono</strong></td>
                                <td style="text-align:center"><strong>Respuesta al Paquete</strong></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < $contadorPaquetes; $i++) {
                                $ruta[$i] = "../images/codigoBarras/" . $idpaq[$i] . ".png";
                                ?>
                                <tr>
                                    <td align="center"><img src=<?php echo $ruta[$i] ?>></td>
                                    <td><?php echo $origen[$i] ?></td>
                                    <td><?php echo $destino[$i] ?></td>
                                    <td><?php echo $direccion[$i] ?></td>
                                    <td><?php echo $telefono[$i] ?></td>
                                    <td align="center"><?php echo $idPaqRes[$i] ?></td>
                                </tr>
                            <?php } ?>

                            $htmlCinco = '</table>
                        <table width="500" border="0">
                            <tr>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>Usuario <?php echo $nombreRol ?></strong></td>
                                <td colspan="2" align="center"><strong>Recepción</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>  
        </body>
    </html>

    <?php
}//Fin del IF
//Si el contador es menor a cinco mando a imprimir una sola hoja
else {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Comprobante de Listado de Paquetes en Nivel 1</title>
            <link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
        </head>
        <body>
            <br>
            <table align="center" width="500" border="0" >
                <tr>
                    <td>
                        <img src="../images/header-top-left.png" width="300" height="50">
                        <h2 align="center">Sistema de Correspondencia</h2>
                        <h3 align="center">Paquetes Confirmados Hoy <?php echo $nombreRol ?></h3>
                        <table width="500" border="1" id="borde">
                            <tr>
                                <td style="text-align:center"><strong>Paquete</strong></td>
                                <td style="text-align:center"><strong>Origen</strong></td>
                                <td style="text-align:center"><strong>Destino</strong></td>
                                <td style="text-align:center"><strong>Dirección</strong></td>
                                <td style="text-align:center"><strong>Teléfono</strong></td>
                                <td style="text-align:center"><strong>Respuesta al Paquete</strong></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < $contadorPaquetes; $i++) {
                                $ruta[$i] = "../images/codigoBarras/" . $idpaq[$i] . ".png";
                                ?>
                                <tr>
                                    <td align="center"><img src=<?php echo $ruta[$i] ?>></td>
                                    <td><?php echo $origen[$i] ?></td>
                                    <td><?php echo $destino[$i] ?></td>
                                    <td><?php echo $direccion[$i] ?></td>
                                    <td><?php echo $telefono[$i] ?></td>
                                    <td align="center"><?php echo $idPaqRes[$i] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <table width="500" border="0">
                            <tr>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>Usuario <?php echo $nombreRol ?></strong></td>
                                <td colspan="2" align="center"><strong>Recepción</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td>-------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                </tr>
                <tr>
                    <td><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                </tr> 
                <tr>
                    <td>
                        <img src="../images/header-top-left.png" width="300" height="50">
                        <h2 align="center">Sistema de Correspondencia</h2>
                        <h3 align="center">Paquetes Confirmados Hoy <?php echo $nombreRol ?></h3>
                        <table width="500" border="1" id="borde">
                            <tr>
                                <td style="text-align:center"><strong>Paquete</strong></td>
                                <td style="text-align:center"><strong>Origen</strong></td>
                                <td style="text-align:center"><strong>Destino</strong></td>
                                <td style="text-align:center"><strong>Dirección</strong></td>
                                <td style="text-align:center"><strong>Teléfono</strong></td>
                                <td style="text-align:center"><strong>Respuesta al Paquete</strong></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < $contadorPaquetes; $i++) {
                                $ruta[$i] = "../images/codigoBarras/" . $idpaq[$i] . ".png";
                                ?>
                                <tr>
                                    <td align="center"><img src=<?php echo $ruta[$i] ?>></td>
                                    <td><?php echo $origen[$i] ?></td>
                                    <td><?php echo $destino[$i] ?></td>
                                    <td><?php echo $direccion[$i] ?></td>
                                    <td><?php echo $telefono[$i] ?></td>
                                    <td align="center"><?php echo $idPaqRes[$i] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <table width="500" border="0">
                            <tr>
                                <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                                <td colspan="2" align="center"><strong>________________</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><strong>Usuario <?php echo $nombreRol ?></strong></td>
                                <td colspan="2" align="center"><strong>Recepción</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> 
        </body>
    </html>
    <?php
}//Fin del ELSE
?>