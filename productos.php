<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$template->set("title", "Quazar | Productos");
$template->set("description", "");
$template->set("keywords", "");
$template->set("favicon", LOGO);
$template->themeInit();
//Clases
$productos = new Clases\Productos();
$producto_Data = $productos->listWithOps("", "", "");
$imagenes = new Clases\Imagenes();
$categorias = new Clases\Categorias();
$categoria_data = $categorias->list("");
?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Productos</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Categorias</div>
                    <ul class="main-categories">
                        <?php foreach ($categoria_data as $categorias): ?>
                            <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable">
                                    <span class="lnr lnr-arrow-right"></span><?= $categorias['titulo']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Marcas</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label
                                            for="apple">Apple<span>(29)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label
                                            for="black">Black<span>(29)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Precio</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span>
                                <div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span>
                                <div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <!-- single product -->
                        <div class="col-lg-4 col-md-6">
                            <?php foreach ($producto_Data as $prod):?>
                             <?php   $imagenes->set("cod", $prod['cod']);
                                $img = $imagenes->view(); ?>
                            <div class="single-product">
                                <img class="img-fluid" src="<?= URL . '/' . $img['ruta'] ?>" alt="">
                                <div class="product-details">
                                    <h6><?= $prod['titulo']; ?></h6>
                                    <p><?php echo strip_tags(substr($prod["desarrollo"],0,300)); ?>...</p>
                                    <div class="price">
                                        <h6>Precio: $<?= $prod['precio']; ?></h6>
                                        <h6>Precio con Descuento: $<?= $prod['precioDescuento']; ?></h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <a href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text" href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>">Ver Más</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                      <?php endforeach;?>
                        </div>
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>

<?php $template->themeEnd(); ?>