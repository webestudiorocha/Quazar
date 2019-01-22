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

    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="sns_header_top">
            <div class="container">
                <div class="sns_module">
                    <div class="header-account">
                        <div class="myaccount">
                            <div class="customer-ct content">
                                <ul class="navbar-nav mr-auto">
                                    <?php if (isset($_SESSION["usuarios"])): ?>
                                        <li>
                                            <a class="top-link-myaccount" title="cuenta" href="<?= URL ?>/sesion">Mi
                                                cuenta</a>

                                            <a class="top-link-login" title="salir" href="<?= URL ?>/sesion/logout">Salir</a>
                                        </li>
                                    <?php else: ?>

                                        <li  class="nav-item ">
                                            <a style="color: black !important;" class="top-link-login" data-toggle="modal" data-target="#login"
                                               title="Iniciar sesion" href="#">Iniciar sesión</a>


                                        <a style="color: black !important;" class="fa fa-pencil" data-toggle="modal" data-target="#registrar"
                                               title="Registrar" href="#">Registrarse</a>
                                        </li>

                                    <?php endif; ?>
                                </ul>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<header class="header_area sticky-header">
    <div class="main_menu">

        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.php"><img src="<?= URL; ?>/assets/img/Isologo.jpg" alt=""></a>
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
                        <li class="nav-item "><a class="nav-link" href="<?= URL; ?>/index.php">Inicio</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="<?= URL; ?>/productos.php">Productos</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item "><a class="nav-link" href="<?= URL; ?>/blogs.php">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= URL; ?>/contact.php">Contacto</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>