<?php




$idsede=$_POST['idsede'];



 $wsdl_url = 'http://localhost:15362/SistemaDeCorrespondencia/CorrespondeciaWS?WSDL';
    $client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
    $usu = array('sede' => $idsede);
    $SedeRol = $client->consultarSedeRol($UsuarioRol);
   

   consultarAreasXSede
     
	   echo '<option value="">Seleccione Un Area</option>';   
	  for($i=0;$i<$cont;$i++){	

			 $arreglo_n=pg_fetch_array($result,$i);

			echo '<option value="'. $arreglo_n[0].'">' . $arreglo_n[1]. '</option>';
		}
	
	?>