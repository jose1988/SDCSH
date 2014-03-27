<?php
require_once("../gs1class/BCGFontFile.php");
require_once("../gs1class/BCGColor.php");
require_once("../gs1class/BCGDrawing.php");
require_once("../gs1class/BCGgs1128.barcode.php"); 

function guardarImagen($idPaq){
	
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255);
$font = new BCGFontFile('../gs1class/font/Arial.ttf', 10);
$code = new BCGcode128();
$code->setScale(2);
$code->setThickness(15);
$code->setForegroundColor($color_black);
$code->setBackgroundColor($color_white);
$code->setFont($font);
$code->setStart(NULL);
$code->setLabel(NULL);

$codigo=$idPaq;
$code->parse($codigo);
$drawing = new BCGDrawing('../images/codigoBarras/'.$codigo.'.png', $color_white); // Guarda la imagen en la carpeta archivos que debe existir
$drawing->setBarcode($code);
$drawing->draw();
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

}
?>