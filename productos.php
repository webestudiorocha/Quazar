<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones= new Clases\PublicFunction();
$template->set("title", TITULO." | Productos");
$template->set("description", "Productos de".TITULO);
$template->set("keywords", "Productos de".TITULO);
$template->set("favicon", FAVICON);
$template->themeInit();
$categoria = isset($_GET["categoria"]) ? $_GET["categoria"] : '';
$productos = new Clases\Productos();
$productos->set("categoria", $categoria);
$novedadesPaginador = $productos->paginador('', 3);
$imagenes = new Clases\Imagenes();
$categorias = new Clases\Categorias();
$categoria_data = $categorias->list(array("area = 'productos'"));
$pagina = !empty($_GET["pagina"]) ? $_GET["pagina"] : '0';

$cantidad = 9;

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

$filter = "";
if (!empty($categoria)) {
    $filter = array("categoria = '" . $categoria . "'");
}

$producto_Data = $productos->listWithOps($filter, "", $cantidad * $pagina . ',' . $cantidad);
$numeroPaginas = $productos->paginador($filter, $cantidad);
$numeroPaginas = $productos->paginador($filter, $cantidad);
$template->themeNav();

?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first d-none d-md-block">
                    <h1>Productos</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                        <a href="<?= URL ?>/productos">Productos</a>
                    </nav>
                </div>
                <div class="col-md-12 d-md-none">
                    <h1>Productos</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                        <a href="<?= URL ?>/productos">Productos</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</br>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar-categories">
                    <div class="head">Categorias</div>
                    <ul class="main-categories">
                        <?php foreach ($categoria_data as $categoria): ?>
                            <li class="main-nav-list">
                                <a  href="<?= URL; ?>/productos/<?= $categoria['titulo']; ?>/<?= $categoria['cod']; ?>">
                                    <span class="lnr lnr-arrow-right"></span><?= $categoria['titulo']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
            <div class=" col-md-9">
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <!-- single product -->
                        <?php foreach ($producto_Data as $prod):?>
                            <div class="col-md-4">
                                <?php $imagenes->set("cod", $prod["cod"]);
                                $img = $imagenes->view(); ?>
                                <a href='<?= URL . '/producto/' . $funciones->normalizar_link($prod["titulo"]) . '/' . $prod["cod"] ?>'>
                                    <div class="single-product" style="height: 300px;">
                                        <img class='img-fluid' style='height: 200px; background: url(<?= URL . "/" . $img["ruta"] ?>) no-repeat center center/cover;' alt=''>
                                        <div class="product-details" style="text-align: center;">
                                            <h6><?= ucfirst($prod["titulo"]) ?></h6>
                                            <div class="price">
                                                <h4>$<?= ucfirst($prod["precio"]); ?> <s class="p_desc">$<?= ucfirst($prod["precio_descuento"]); ?></s></h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
<?php
$template->themeEnd(); ?>