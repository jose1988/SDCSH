<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Comprobante de Paquetes Confirmados</title>
        <link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
    </head>
    <body>
        <div>
            <img style="top:auto" src="../images/header-top-left.png" width="250" height="40">
        </div>
        <div align="center">	
            <h2 align="center">Sistema de Correspondencia</h2>
            <h3 align="center">Comprobante de Paquetes Confirmados</h3>
            <table align="center" width="500" border="1" rules="all">
            <tr>
                <td style="text-align:center"><strong>Código</strong></td>
                <td style="text-align:center"><strong>No</strong></td>
                <td style="text-align:center"><strong>Origen</strong></td>
                <td style="text-align:center"><strong>Destino</strong></td>
                <td style="text-align:center"><strong>Sede</strong></td>
                <td style="text-align:center"><strong>Área</strong></td>
            </tr>
            <?php
            for ($i = 0; $i < $contadorPaquetes; $i++) {
                $ruta[$i] = "../images/codigoBarras/" . $codigo[$i] . ".png";
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php } ?>
        </table>
        	<br>
        	<br>
            <table align="center" width="500" border="0">
                <tr>
                    <td align="center"><strong>________________</strong></td>
                    <td align="center"><strong>________________</strong></td>
                </tr>
                <tr>
                    <td align="center"><strong>Usuario</strong></td>
                    <td align="center"><strong>Recepción</strong></td>
                </tr>
            </table>
        </div>
        <br>
        <br>
        <div align="center">
            <img style="top:auto" src="../images/todo.png" width="700" height="40">        	
        </div>
    </body>
</html>