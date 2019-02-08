<?php
$funcionesNav = new Clases\PublicFunction();
//Clases
$imagenesNav = new Clases\Imagenes();
$usuario = new Clases\Usuarios();
$categoriasNav = new Clases\Categorias();
$bannersNav = new Clases\Banner();
$carrito = new Clases\Carrito();
$rubros = new Clases\Rubros();
//Banners
$categoriasDataNav = $categoriasNav->list('');
$carro = $carrito->return();
$filterRubrosCategorias = array("categoria != '' GROUP BY categoria");
$rubrosArrayCategorias = $rubros->list($filterRubrosCategorias, "categoria ASC", "");

$buscar = isset($_GET["buscar"]) ? $_GET["buscar"] : '';
foreach ($categoriasDataNav as $valNav) {
    if ($valNav['titulo'] == 'Botonera' && $valNav['area'] == 'banners') {
        $bannersNav->set("categoria", $valNav['cod']);
        $banDataBotonera = $bannersNav->listForCategory();
    }
}
?>

<header class="header_area sticky-header">
    <div class="main_menu">

        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index"><img src="<?= URL; ?>/assets/img/Isologo.png" alt="" width="90%"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item "><a class="nav-link" href="<?= URL; ?>/index">Inicio</a></li>
                        <li class="nav-item "><a class="nav-link" href="<?= URL; ?>/productos">Productos</a></li>
                        <li class="nav-item "><a class="nav-link" href="<?= URL; ?>/blogs">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= URL; ?>/contacto">Contacto</a></li>
                        <?php if (isset($_SESSION["usuarios"])): ?>
                            <li class="nav-item">
                                <a class="nav-link" title="cuenta" href="<?= URL ?>/sesion">Mi cuenta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" title="salir" href="<?= URL ?>/sesion/logout">Salir</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item ">
                                <a class="nav-link" data-toggle="modal" data-target="#login"
                                   title="Iniciar sesion" href="#">Iniciar sesión</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" data-toggle="modal" data-target="#registrar"
                                   title="Registrar" href="#">Registrarse</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=URL?>/carrito">Carrito <span class="lnr lnr-cart"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>