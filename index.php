<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones= new Clases\PublicFunction();
$template->set("title", "Quazar | Inicio");
$template->set("description", "");
$template->set("keywords", "");
$template->set("favicon", LOGO);
$template->themeInit();
$productos = new Clases\Productos();
$imagenes = new Clases\Imagenes();
$novedades =new Clases\Novedades();
$sliders = new Clases\Sliders();
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$productos->set("cod", $cod);
$novedades->set("cod", $cod);
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$sliders_data = $sliders->list('', '', '');
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : '0';
$cantidad = 3;
$producto_Data = $productos->listWithOps("", "", $cantidad * $pagina . ',' . $cantidad);
$novedades_data = $novedades->listWithOps("", "", $cantidad * $pagina . ',' . $cantidad);
?>
<!-- start banner Area -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $activo = 0;
            foreach ($sliders_data as $sli) {
                $imagenes->set("cod", $sli['cod']);
                $img_data = $imagenes->view();
                ?>
                <div class="carousel-item <?php if ($activo == 0) {
                    echo 'active';
                    $activo++;
                } ?>" style=" height: 600px; background: url(<?= URL . '/' . $img_data['ruta'] ?>) no-repeat center center/cover;">
                    <!--<img class="d-block h-400" src="<?= URL . '/' . $img_data['ruta'] ?>">-->
                </div>
                <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<!-- End banner Area -->
<br>

<!-- Start category Area -->
<section  class="category-area">
    <div class="container">
        <div   class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="<?= URL; ?>/assets/img/category/c1.jpg" alt="">
                            <a href="<?= URL; ?>/assets/img/category/c1.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Sneaker for Sports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="<?= URL; ?>/assets/img/category/c2.jpg" alt="">
                            <a href="<?= URL; ?>/assets/img/category/c2.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Sneaker for Sports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="<?= URL; ?>/assets/img/category/c3.jpg" alt="">
                            <a href="<?= URL; ?>/assets/img/category/c3.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Product for Couple</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="<?= URL; ?>/assets/img/category/c4.jpg" alt="">
                            <a href="<?= URL; ?>/assets/img/category/c4.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Sneaker for Sports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" src="<?= URL; ?>/assets/img/category/c5.jpg" alt="">
                    <a href="<?= URL; ?>/assets/img/category/c5.jpg" class="img-pop-up" target="_blank">
                        <div class="deal-details">
                            <h6 class="deal-title">Sneaker for Sports</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End category Area -->
<br>
<!-- start product Area -->

    <section>
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">

                    <div class="section-title">
                        <h1>Productos</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($producto_Data as $productos): ?>
                    <!-- single product -->
                    <div class="col-md-4">
                        <?php  $imagenes->set("cod", $productos['cod']);
                        $img = $imagenes->view(); ?>
                        <div class="single-product">

                            <a href="<?= URL . '/producto/' . $funciones->normalizar_link($productos['titulo']) . "/" . $productos['cod'] ?>" ><img class="img-fluid" style=" height: 200px; background: url(<?= URL . '/' . $img['ruta'] ?>) no-repeat center center/cover;" alt=""></a>

                            <div class="product-details">
                                <a href="<?= URL . '/producto/' . $funciones->normalizar_link($productos['titulo']) . "/" . $productos['cod'] ?>" ><h6><?= ucfirst($productos['titulo'])?></h6></a>
                                <p><?php echo strip_tags(substr($productos["desarrollo"],0,100)); ?>...</p>
                                <div class="price">
                                    <h6>Precio: $<?= ucfirst($productos['precio']); ?></h6>
                                    <h6>Precio de contado: $<?= ucfirst($productos['precioDescuento']); ?></h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="<?= URL . '/producto/' . $funciones->normalizar_link($productos['titulo']) . "/" . $productos['cod'] ?>" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text" href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>">Ver Más</p>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
    <section>
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">

                        <div class="section-title">
                            <h1>Blog</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($novedades_data as $novedades): ?>
                        <!-- single product -->
                        <div class="col-md-4">
                            <?php  $imagenes->set("cod", $novedades['cod']);
                            $img = $imagenes->view();
                            $fecha = explode("-", $novedades['fecha']);?>
                            <div class="single-product">

                                <a href="<?= URL . '/blog/' . $funciones->normalizar_link($novedades['titulo']) . "/" . $novedades['cod'] ?>" ><img class="img-fluid" style=" height: 200px; background: url(<?= URL . '/' . $img['ruta'] ?>) no-repeat center center/cover;" alt=""></a>

                                <div class="product-details">
                                    <a href="<?= URL . '/blog/' . $funciones->normalizar_link($novedades['titulo']) . "/" . $novedades['cod'] ?>" ><h6><?= ucfirst($novedades['titulo'])?></h6></a>
                                    <p><?php echo strip_tags(substr($productos["desarrollo"],0,100)); ?>...</p>
                                    <div class="prd-bottom">
                                        <a href="<?= URL . '/blog/' . $funciones->normalizar_link($novedades['titulo']) . "/" . $novedades['cod'] ?>" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text" href="<?= URL . '/blog/' . $funciones->normalizar_link($novedades['titulo']) . "/" . $novedades['cod'] ?>">Ver Más</p>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<!-- end product Area -->
<?php $template->themeEnd();?>