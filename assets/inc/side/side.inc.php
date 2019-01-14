<?php
$funciones = new Clases\PublicFunction();
$enviar = new Clases\Email();
$servicios = new Clases\Servicios();
$portfolios = new Clases\Portfolio();
$ruta = CANONICAL;
$codSide = isset($_GET["cod"]) ? $_GET["cod"] : '';
$mensaje = '';
if (strpos($ruta, 'servicio') !== false) {
    $servicios->set("cod", $codSide);
    $serv = $servicios->view();
    $mensaje = "este servicio de " . ucfirst($serv['titulo']) . "?";
} elseif (strpos($ruta, 'portfolio') !== false) {
    $portfolios->set("cod", $codSide);
    $port = $portfolios->view();
    $mensaje = "a " . ucfirst($port['titulo']) . "?";
}
?>