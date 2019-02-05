<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$template->set("title", "Quazar | Inicio");
$template->set("description", "");
$template->set("keywords", "");
$template->set("favicon", LOGO);
$template->themeInit();
$productos = new Clases\Productos();
$imagenes = new Clases\Imagenes();
$novedades = new Clases\Novedades();
$banner = new Clases\Banner();
$sliders = new Clases\Sliders();
$categorias = new Clases\Categorias();

$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$productos->set("cod", $cod);
$novedades->set("cod", $cod);
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';

$sliders_array = $sliders->list("");
$sliders_array_count = count($sliders_array);
$categorias->set("titulo", "BAJO SLIDE");
$categoria_banner = $categorias->view();
$banner_data = $banner->list_for_category($categoria_banner["cod"], "2");
$producto_data = $productos->listWithOps("", "RAND()", 12);
$novedades_data = $novedades->listWithOps("", "", 12);
$template->themeNav();

?>
    <div class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000" id="carousel-1">
        <div class="carousel-inner" role="listbox">
            <?php for ($i = 0; $i < $sliders_array_count; $i++) {
                $imagenes->set("cod",$sliders_array[$i]['cod']);
                $img_slider_data = $imagenes->view();
                ?>
                <div class="carousel-item <?php if ($i == 0) { echo 'active'; } ?>">
                    <a href="<?=$sliders_array[$i]['link']?>">
                    <div class="img-fluid w-100 d-block" style="background: url(<?=URL?>/<?= $img_slider_data['ruta'] ?>)center/cover;"></div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < $sliders_array_count; $i++) { ?>
                <li data-target="#carousel-1" data-slide-to="<?= $i ?>" class="<?php if ($i == 0) {
                    echo 'active';
                } ?>'"></li>
            <?php } ?>
        </ol>
    </div>

<br/>
    <!-- Start category Area -->
    <section class="category-area">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                foreach ($banner_data as $banner) {
                    $imagenes->set("cod", $banner["cod"]);
                    $img_ = $imagenes->view();
                    ?>
                    <div class="col-md-6"><img src="<?= $img_["ruta"] ?>" width="100%"/></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- End category Area -->
    <br>
    <!-- start product Area -->

    <!-- start product Area -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        <?php
        $cantidad = 0;
        for ($i = 0; $i < 2; $i++) { ?>
            <div class="single-product-slider">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="section-title">
                                <h1>Productos</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et
                                    dolore
                                    magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php for ($j = $cantidad; $j < ($cantidad + 4); $j++) { ?>
                            <!-- single product -->
                            <div class="col-md-3">
                                <?php $imagenes->set("cod", $producto_data[$j]["cod"]);
                                $img = $imagenes->view(); ?>
                                <a href='<?= URL . '/producto/' . $funciones->normalizar_link($producto_data[$j]["titulo"]) . '/' . $producto_data[$j]["cod"] ?>'>
                                    <div class="single-product">
                                        <img class='img-fluid'
                                             style='height: 200px; background: url(<?= URL . "/" . $img["ruta"] ?>) no-repeat center center/cover;'
                                             alt=''>
                                        <div class="product-details">
                                            <h6><?= ucfirst($producto_data[$j]["titulo"]) ?></h6>
                                            <div class="price">
                                                <h4>$<?= ucfirst($producto_data[$j]["precio"]); ?> <s
                                                            class="p_desc">$<?= ucfirst($producto_data[$j]["precio_descuento"]); ?></s>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php }
                        $cantidad += 4;
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>

    <!-- start novedades Area -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single novedad slide -->
        <?php
        $cantidad = 0;
        for ($i = 0; $i < 2; $i++) { ?>
            <div class="single-product-slider">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="section-title">
                                <h1>Novedades</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et
                                    dolore
                                    magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php for ($j = $cantidad; $j < ($cantidad + 4); $j++) { ?>
                            <!-- single product -->
                            <div class="col-md-3">
                                <?php $imagenes->set("cod", $novedades_data[$j]["cod"]);
                                $img = $imagenes->view(); ?>
                                <a href='<?= URL . '/blog/' . $funciones->normalizar_link($novedades_data[$j]["titulo"]) . '/' . $novedades_data[$j]["cod"] ?>'>
                                    <div class="single-product">
                                        <img class='img-fluid'
                                             style='height: 200px; background: url(<?= URL . "/" . $img["ruta"] ?>) no-repeat center center/cover;'
                                             alt=''>
                                        <div class="product-details">
                                            <h6><?= ucfirst($novedades_data[$j]["titulo"]) ?></h6>
                                            <div class="n_color"><?= substr($novedades_data[$j]["desarrollo"], 0, 100) ?>
                                                ..
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php }
                        $cantidad += 4;
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <!-- end novedad Area -->
<?php $template->themeEnd(); ?>