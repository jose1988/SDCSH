<?php 
require_once('../lib/class.wsdlcache.php');
require_once('../core/class.inputfilter.php');

//DESARROLLO LOCAL
//$ip = "172.30.3.93";//MAQUINA LUIS
//$ip2 = "172.30.3.119";//MAQUINA KEIWER
//$ip3 = "127.0.0.1";
//$puerto = "8080";

//DESARROLLO-PRUEBAS
//$ip = "172.30.3.161";
$ip="127.0.0.1";
$puerto = "7001";

//CERTIFICACION
//$ip = "172.24.102.152";
//$puerto = "8181";

//PRODUCCION
//$ip = "10.10.80.2"; 
//$puerto = "8181";

$ws_sdc             = "http://" . $ip . ":" . $puerto . "SistemaDeCorrespondencia/CorrespondeciaWS?WSDL";
$ws_hori             = "http://" . $ip . ":" . $puerto . "/horizonte2/horizonteWS?wsdl";
$ws_pia	             = "http://" . $ip . ":" . $puerto . "/PIAServices/PIAServices?wsdl";
$ws_mail	         = "http://" . $ip . ":" . $puerto . "/horimail/ServicesMailWS?wsdl";
$ws_directory	     = "http://" . $ip . ":" . $puerto . "/SHActiveDirectory/SHActiveDirectoryWS?wsdl";
$ws_AD               = "http://" . $ip . ":" . $puerto . "/SHActiveDirectory/SHActiveDirectoryWS?wsdl";

$cache = new wsdlcache('../cache', 864000000);
$cachesdc = new wsdlcache('../cache', 864000000);
$cacheP = new wsdlcache('../cache', 864000000);
$cacheMail = new wsdlcache('../cache', 864000000);
$cacheDirectory = new wsdlcache('../cache', 864000000);
$cacheAD = new wsdlcache('../cache', 864000000);

$wsdl = $cache->get($ws_hori);
$wsdl_sdc = $cache->get($ws_sdc);
$wsdl_pia = $cacheP->get($ws_pia);
$wsdl_mail = $cacheProveedores->get($ws_mail);
$wsdl_directory = $cacheDirectory->get($ws_directory);
$wsdl_AD = $cacheAD->get($ws_AD);

if (is_null($wsdl_sdc)) {
	$wsdl = new wsdl($ws_sdc);
	$cachesdc->put($wsdl_sdc);
} else {
	$wsdl_sdc->clearDebug();
}

if (is_null($wsdl)) {
	$wsdl = new wsdl($ws_hori);
	$cache->put($wsdl);
} else {
	$wsdl->clearDebug();
}

if (is_null($wsdl_pia)) {
	$wsdl_pia = new wsdl($ws_pia);
	$cacheP->put($wsdl_pia);
} else {
	$wsdl_pia->clearDebug();
}


if (is_null($wsdl_mail)) {
	$wsdl_mail= new wsdl($ws_mail);
	$cacheMail->put($wsdl_mail);
} else {
	$wsdl_proveedores->clearDebug();
}

if (is_null($wsdl_directory)) {
	$wsdl_directory= new wsdl($ws_directory);
	$cacheDirectory->put($wsdl_directory);
} else {
	$wsdl_directory->clearDebug();
}



if (is_null($wsdl_AD)) {
	$wsdl_AD = new wsdl($ws_AD);
	$cacheAD->put($wsdl_AD);
} else {
	$wsdl_AD->clearDebug();
}

$filter = new InputFilter();

$_POST = $filter->process($_POST);
$_GET = $filter->process($_GET);
?>