<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Comprobante de Valija</title>
        <link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
    </head>
    <body>
        <br>
        <?php $ruta = "../images/codigoBarras/" . $idval . ".png"; ?>
        <table align="center" width="500" border="0" >
            <tr>
                <td>
                    <img src="../images/header-top-left.png" width="300" height="50">
                    <h2 align="center">Sistema de Correspondencia</h2>
                    <h3 align="center">Comprobante de Valija</h3>
                    <table width="500" border="0">
                        <tr>
                            <td><strong>Sede: </strong><?php echo $sede ?></td>
                            <td align="center"><strong>Valija No: </strong> <img src=<?php echo $ruta ?>> </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Realizado por: </strong><?php echo $nombre . ' ' . $apellido ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Nombre: </strong><?php echo $nombredes ?></td>
                            <td><strong>Dirección: </strong><?php echo $direcciondes ?></td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono: </strong><?php echo $telefonodes ?></td>
                            <td><strong>Lugar de Envio: </strong><?php echo $sede ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center"><strong>________________</strong></td>
                            <td align="center"><strong>________________</strong></td>
                        </tr>
                        <tr>
                            <td align="center"><strong>Usuario Valija</strong></td>
                            <td align="center"><strong>Recepción Zoom</strong></td>
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
                    <h3 align="center">Comprobante de Valija</h3>
                    <table width="500" border="0">
                        <tr>
                            <td><strong>Sede: </strong><?php echo $sede ?></td>
                            <td align="center"><strong>Valija No: </strong> <img src=<?php echo $ruta ?>> </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Realizado por: </strong><?php echo $nombre . ' ' . $apellido ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><strong>Nombre: </strong><?php echo $nombredes ?></td>
                            <td><strong>Dirección: </strong><?php echo $direcciondes ?></td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono: </strong><?php echo $telefonodes ?></td>
                            <td><strong>Lugar de Envio: </strong><?php echo $sede ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center"><strong>________________</strong></td>
                            <td align="center"><strong>________________</strong></td>
                        </tr>
                        <tr>
                            <td align="center"><strong>Usuario Valija</strong></td>
                            <td align="center"><strong>Recepción Zoom</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table> 
    </body>
</html>