<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones= new Clases\PublicFunction();
$template->set("title", "Quazar| Blogs");
$template->set("description", "");
$template->set("keywords", "");
$template->set("favicon", LOGO);
$template->themeInit();
$productos = new Clases\Productos();
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : '0';
$novedadesPaginador = $productos->paginador('', 3);
$imagenes = new Clases\Imagenes();
$categorias = new Clases\Categorias();
$categoria_data = $categorias->list("");
$funciones = new Clases\PublicFunction();
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : '0';

$cantidad = 2;

if ($pagina > 0) {
    $pagina = $pagina - 1;
}

if (@count($_GET) > 1) {
    $anidador = "&";
} else {
    $anidador = "?";
}

if (isset($_GET['pagina'])):
    $url = $funciones->eliminar_get(CANONICAL, 'pagina');
else:
    $url = CANONICAL;
endif;

$producto_Data = $productos->listWithOps("", "", $cantidad * $pagina . ',' . $cantidad);
$numeroPaginas = $productos->paginador("", $cantidad);
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
            <div class="col-md-3">
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
                    <div class="top-filter-head">Filtrar Productos</div>
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
                        <li>
                            <?php if (($pagina + 1) > 1): ?>
                        <li><a href="<?= $url ?><?= $anidador ?>pagina=<?= $pagina ?>"><i
                                        class="fa fa-angle-left" ></i></a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $numeroPaginas; $i++): ?>
                            <li class="<?php if ($i == $pagina + 1) {
                                echo "active";
                            } ?>"><a href="<?= $url ?><?= $anidador ?>pagina=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>

                        <?php if (($pagina + 2) <= $numeroPaginas): ?>
                            <li><a href="<?= $url ?><?= $anidador ?>pagina=<?= ($pagina + 2) ?>"><i
                                            class="fa fa-angle-right" ></i></a></li>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <!-- single product -->
                        <div class="col-md-3">
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
                        <li>
                            <?php if (($pagina + 1) > 1): ?>
                        <li><a href="<?= $url ?><?= $anidador ?>pagina=<?= $pagina ?>"><i
                                        class="fa fa-angle-left" ></i></a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $numeroPaginas; $i++): ?>
                            <li class="<?php if ($i == $pagina + 1) {
                                echo "active";
                            } ?>"><a href="<?= $url ?><?= $anidador ?>pagina=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>

                        <?php if (($pagina + 2) <= $numeroPaginas): ?>
                            <li><a href="<?= $url ?><?= $anidador ?>pagina=<?= ($pagina + 2) ?>"><i
                                            class="fa fa-angle-right" ></i></a></li>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>

<?php $template->themeEnd(); ?>