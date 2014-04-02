<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Comprobante de Traking del Paquete</title>
        <link rel="stylesheet" href="../recursos/estilosPdf.css" type="text/css" />
    </head>
    <body>
        <div>
            <img style="top:auto" src="../images/header-top-left.png" width="250" height="40">
        </div>
        <div align="center">	
            <h2 align="center">Sistema de Correspondencia</h2>
            <h3 align="center">Paquete o Correspondencia</h3>
            <table align="center" width="400" border="1" rules="all">
                <tr>
                    <td align="center"><strong>No Paquete</strong></td>
                    <td align="center"><strong>Origen</strong></td>
                    <td align="center"><strong>De</strong></td>
                    <td align="center"><strong>Para</strong></td>
                    <td align="center"><strong>Destino</strong></td>
                </tr>
                <tr>
                    <td align="center"><?php echo $idPaq ?></td>
                    <td><?php echo $origen ?></td>
                    <td><?php echo $deNombre ?></td>
                    <td><?php echo $paraNombre ?></td>
                    <td><?php echo $destino ?></td>
                </tr>
            </table>
            <br>
            <h3 align="center">Traking del Paquete</h3>
            <table align="center" width="500" border="1" rules="all">
                <tr>
                    <td align="center"><strong>Usuario</strong></td>
                    <td align="center"><strong>Fecha y Hora</strong></td>
                    <td align="center"><strong>Status</strong></td>
                    <td align="center"><strong>Tipo</strong></td>
                    <td align="center"><strong>Nivel</strong></td>
                </tr>
                <?php
                if ($contadorPaquete > 1) {
                    for ($i = 0; $i < $contadorPaquete; $i++) {
                        ?>
                        <tr>
                            <td><?php echo $resultadoPaquete->return[$i]->iduse->idusu->nombreusu ?></td>
                            <td><?php echo $fecha[$i] ?></td>
                            <?php
                            $status = "";
                            if ($resultadoPaquete->return[$i]->statusseg == "0") {
                                $status = "En Proceso";
                            } elseif ($resultadoPaquete->return[$i]->statusseg == "1") {
                                $status = "Entregado";
                            } elseif ($resultadoPaquete->return[$i]->statusseg == "2") {
                                $status = "Reenviado";
                            } elseif ($resultadoPaquete->return[$i]->statusseg == "3") {
                                $status = "Extraviado";
                            }
                            ?>
                            <td><?php echo $status ?></td>
                            <?php
                            $tipo = "";
                            if ($resultadoPaquete->return[$i]->tiposeg == "0") {
                                $tipo = "Origen";
                            } elseif ($resultadoPaquete->return[$i]->tiposeg == "1") {
                                $tipo = "Destino";
                            }
                            ?>
                            <td><?php echo $tipo ?></td>
                            <td><?php echo $resultadoPaquete->return[$i]->nivelseg ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td><?php echo $resultadoPaquete->return->iduse->idusu->nombreusu ?></td>
                        <td><?php echo $fecha ?></td>
                        <?php
                        $status = "";
                        if ($resultadoPaquete->return->statusseg == "0") {
                            $status = "En Proceso";
                        } elseif ($resultadoPaquete->return->statusseg == "1") {
                            $status = "Entregado";
                        } elseif ($resultadoPaquete->return->statusseg == "2") {
                            $status = "Reenviado";
                        } elseif ($resultadoPaquete->return->statusseg == "3") {
                            $status = "Extraviado";
                        }
                        ?>
                        <td><?php echo $status ?></td>
                        <?php
                        $tipo = "";
                        if ($resultadoPaquete->return->tiposeg == "0") {
                            $tipo = "Origen";
                        } elseif ($resultadoPaquete->return->tiposeg == "1") {
                            $tipo = "Destino";
                        }
                        ?>
                        <td><?php echo $tipo ?></td>
                        <td><?php echo $resultadoPaquete->return->nivelseg ?></td>
                    </tr>
                <?php }
                ?>
            </table>
        </div>
        <br>
        <br>
        <div align="center">
            <img style="top:auto" src="../images/todo.png" width="700" height="40">        	
        </div>
    </body>
</html>