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
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$productos = new Clases\Productos();
$productos->set("cod", $cod);
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : '0';
$novedadesPaginador = $productos->paginador('', 3);
$imagenes = new Clases\Imagenes();
$categorias = new Clases\Categorias();
$categoria_data = $categorias->list("");
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : '0';

$cantidad = 4;

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
</br>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row" style="flex-wrap: initial !important;">
            <div class="col-md-3">
                <div class="sidebar-categories">
                    <div class="head">Categorias</div>
                    <ul class="main-categories">
                        <?php foreach ($categoria_data as $categorias): ?>
                            <li class="main-nav-list"><a data-toggle="collapse" aria-expanded="false" aria-controls="fruitsVegetable">
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
                </div>
            </div>
            <div class=" col-md-9">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">

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
                        <?php foreach ($producto_Data as $prod):?>
                        <div class="col-md-6">

                             <?php   $imagenes->set("cod", $prod['cod']);
                                $img = $imagenes->view(); ?>
                            <div class="single-product">
                                <a href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>" ><img class="img-fluid" style=" height: 200px; background: url(<?= URL . '/' . $img['ruta'] ?>) no-repeat center center/cover;" alt=""></a>
                                <div class="product-details">
                                    <a href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>" ><h6><?= ucfirst($prod['titulo'])?></h6></a>
                                    <p><?php echo strip_tags(substr($prod["desarrollo"],0,100)); ?>...</p>
                                    <div class="price">
                                        <h6>Precio: $<?= $prod['precio']; ?></h6>
                                        <h6>Precio de contado: $<?= $prod['precioDescuento']; ?></h6>
                                    </div>
                                    <div class="prd-bottom">
                                        <a href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text" href="<?= URL . '/producto/' . $funciones->normalizar_link($prod['titulo']) . "/" . $prod['cod'] ?>">Ver Más</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php endforeach;?>
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">

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
</br>
<?php $template->themeEnd(); ?>