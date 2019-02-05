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
$template->set("favicon", LOGO);
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
            <div class="col-first">
                <h1><?= ucfirst($producto_data['titulo']); ?></h1>

            </div>
        </div>
    </div>
</section>

<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="pro-details-carousel">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php
                            $i = 3;
                            while (is_file($data["imagen" . $i . "_portfolio"])) {
                                $imagen = BASE_URL . "/" . $data["imagen" . $i . "_portfolio"];
                                ?>
                                <div class="item <?php if ($i == 3) {
                                    echo "active";
                                } ?>"><img src="<?php echo $imagen ?>" width="100%"></div>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?= $producto_data['titulo'] ?></h3>
                    <h2>$<?= $producto_data['precio'] ?></h2>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Category</span> : <?= $categoria_data['titulo'] ?>
                            </a>
                        </li>
                        <li><a href="#"><span>Disponibilidad</span> : En stock</a></li>
                    </ul>
                    <?= $producto_data['desarrollo'] ?>

                    <?php
                    if (isset($_POST["enviar_carrito"])) {

                        $carrito->set("id", $producto_data['cod']);
                        $carrito->set("cantidad", $_POST["cantidad"]);
                        $carrito->set("titulo", $producto_data['titulo']);

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
                        if (strpos(CANONICAL, "success") == true) {
                            echo "<div class='alert alert-success'>Agregaste un producto a tu carrito, querés <a href='" . URL . "/carrito'><b>pasar por caja</b></a> o <a href='" . URL . "/productos'><b>seguir comprando</b></a></div>";
                        }
                        if (strpos(CANONICAL, "error") == true) {
                            echo "<div class='alert alert-danger'>No se puede agregar por falta de stock, compruebe si ya posee este producto en su carrito.</div>";
                        }
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
