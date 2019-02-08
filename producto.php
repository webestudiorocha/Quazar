<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
//Clases
$funciones = new Clases\PublicFunction();
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$carrito = new Clases\Carrito();
$productos = new Clases\Productos();
$productos->set("cod", $cod);
$producto_data = $productos->view();
$imagenes = new Clases\Imagenes();
$imagenes->set("cod", $producto_data['cod']);
$filter = array("cod='" . $producto_data['cod'] . "'");
$imagenes_array = $imagenes->list($filter);
$categorias = new Clases\Categorias();
$categorias->set("cod", $producto_data['categoria']);
$categoria_data = $categorias->view();
$template = new Clases\TemplateSite();
$template->set("title", TITULO . ' | ' . ucfirst(strip_tags($producto_data['titulo'])));
$template->set("imagen", URL . "/" . $imagenes_array[0]['ruta']);
$template->set("favicon", FAVICON);
$template->set("keywords", strip_tags($producto_data['keywords']));
$template->set("description", ucfirst(substr(strip_tags($producto_data['desarrollo']), 0, 160)));

$url_limpia = CANONICAL;
$url_limpia = str_replace("?success", "", $url_limpia);
$url_limpia = str_replace("?error", "", $url_limpia);
$template->themeInit();

$template->themeNav();
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first d-none d-md-block">
                <h1><?= ucfirst($producto_data['titulo']); ?></h1>
                <nav class="d-flex align-items-center">
                    <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#"><?= ucfirst($producto_data['titulo']); ?></a>
                </nav>
            </div>
            <div class="col-md-12 d-md-none">
                <h1><?= ucfirst($producto_data['titulo']); ?></h1>
                <nav class="d-flex align-items-center">
                    <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#"><?= ucfirst($producto_data['titulo']); ?></a>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php
                        if (count($imagenes_array) > 1) {
                            for ($i = 0; $i < count($imagenes_array); $i++) { ?>
                                <li data-target="#carouselProducto" data-slide-to="<?= $i ?>" class="<?php if ($i == 0) {
                                    echo 'active';
                                } ?>"></li>
                            <?php }
                        } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php for ($i = 0; $i < count($imagenes_array); $i++) { ?>
                            <div class="carousel-item <?php if ($i == 0) {
                                echo 'active';
                            } ?>">
                                <div class="d-block w-100" style="background: url(<?= URL ?>/<?= $imagenes_array[$i]['ruta'] ?>)center/cover;height:450px;"></div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    if (count($imagenes_array) > 1) {
                        ?>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <span class="sr-only">Siguiente</span>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?= $producto_data['titulo'] ?></h3>
                    <h2>$<?= $producto_data['precio'] ?></h2>
                    <ul class="list">
                        <li><span>Categoría: </span><a class="active" href="#"><?= $categoria_data['titulo'] ?></a>
                        </li>
                        <li><span>Disponibilidad: </span>
                            <a class="active" href="#"><?php if ($producto_data['stock'] > 0) {
                                    echo 'En Stock';
                                } else {
                                    echo 'Sin Stock';
                                } ?></a></li>
                    </ul>
                    <?= $producto_data['desarrollo'] ?>

                    <?php
                    if (isset($_POST["enviar_carrito"])) {

                        $carrito->set("id", $producto_data['cod']);
                        $carrito->set("cantidad", $_POST["cantidad"]);
                        $carrito->set("titulo", $producto_data['titulo']);
                        $carrito->set("stock", $producto_data['stock']);
                        if (($producto_data['precio_descuento'] <= 0) || $producto_data["precio_descuento"] == '') {
                            $carrito->set("precio", $producto_data['precio']);
                        } else {
                            $carrito->set("precio", $producto_data['precio_descuento']);
                        }

                        if (is_array($_SESSION["usuarios"])) {
                            if ($_SESSION["usuarios"]["descuento"] == 1) {
                                if ($producto_data['precio'] != $producto_data['precio_mayorista'] && $producto_data['precio_mayorista'] != 0) {
                                    $carrito->set("precio", $producto_data['precio_mayorista']);
                                } else {
                                    $carrito->set("precio", $producto_data['precio']);
                                }
                            } else {
                                $carrito->set("precio", $producto_data['precio']);
                            }
                        }
                        if ($carrito->add()) {
                            $funciones->headerMove($url_limpia . "?success");
                        } else {
                            $funciones->headerMove($url_limpia . "?error");
                        }
                    }
                    if (strpos(CANONICAL, "success") == true) {
                        echo "<div class='alert alert-success'>Agregaste un producto a tu carrito, querés <a href='" . URL . "/carrito'><b>pasar por caja</b></a> o <a href='" . URL . "/productos'><b>seguir comprando</b></a></div>";
                    }
                    if (strpos(CANONICAL, "error") == true) {
                        echo "<div class='alert alert-danger'>No se puede agregar por falta de stock, compruebe si ya posee este producto en su carrito.</div>";
                    }
                    ?>
                    <form method="post">
                        <div class="product_count">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" id="sst" min="1" max="<?= $producto_data['stock'] ?>" value="1" title="Cantidad:"
                                   class="input-text qty" oninvalid="this.setCustomValidity('Stock disponible: <?= $producto_data['stock'] ?>')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <button class="primary-btn" type="submit" name="enviar_carrito">Añadir al carrito</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->


<?php $template->themeEnd(); ?>
