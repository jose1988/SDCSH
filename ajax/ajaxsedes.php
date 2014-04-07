<?php
try {
    $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $Sedes = $client->consultarSedes();
    if (!isset($Sedes->return)) {
        javaalert("lo sentimos no se pueden deshabilitar areas, no existen sedes registradas, Consulte con el administrador");
        iraURL('../pages/inbox.php');
    }
    $reg = count($Sedes->return);
    include("../views/disable_area.php");
} catch (Exception $e) {
    javaalert('Error al deshabiltar el area');
    iraURL('../pages/inbox.php');
}
echo "<h2> <strong>Sedes</strong> </h2>";
echo "<br>";
echo "<table class='footable table table-striped table-bordered' align='center' data-page-size='10'>
    	 <thead bgcolor='#ff0000'>
                                    <tr>";
echo "<th  style='width:7%; text-align:center' >ID</th>";
echo "<th  text-align:center' data-sort-ignore='true'>Nombre </th>";
echo "<th style='width:7%; text-align:center' >Areas</th>								
         </thead>
        <tbody>		
        	<tr>";
if ($reg > 0) {
    $j = 0;
    while ($j < $reg) {
        echo "<th text-align:center' data-sort-ignore='true'>" . $Sedes->return[$j]->idsed . "</th>";
        echo "<td style='text-align:left'>" . $Sedes->return[$j]->nombresed . "</td>";
        ?>
        <th text-align:center'> 
             <button class='btn' onClick="buscarAreas('<?php echo $Sedes->return[$j]->idsed; ?>');">
                <span class="icon-home" > </span>
            </button></th>
        <?php
        echo "</tr>";
        $j++;
    }
}
echo " </tbody>
  	</table>";
echo '<ul id="pagination" class="footable-nav"><span>Pag:</span></ul>';
?>