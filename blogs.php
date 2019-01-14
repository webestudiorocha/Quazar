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
$novedades = new Clases\Novedades();
$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : '0';
$novedadesPaginador = $novedades->paginador('', 3);
$imagenes = new Clases\Imagenes();
$funciones = new Clases\PublicFunction();
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

$novedadesData = $novedades->listWithOps("", "", $cantidad * $pagina . ',' . $cantidad);
$numeroPaginas = $novedades->paginador("", $cantidad);
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Blog</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-3.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Social Life</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Enjoy your social life together</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-2.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Politics</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Be a part of politics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-1.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Food</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Let the food be finished</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->

<!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <?php
                    foreach ($novedadesData as $nov) :
                    $imagenes->set("cod", $nov['cod']);
                    $img = $imagenes->view();
                    $fecha = explode("-", $nov['fecha']);
                    ?>
                    <article class="row blog_item">

                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <ul class="blog_meta list">
                                    <li><span class="poster"><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></span><i class="lnr lnr-calendar-full"></i></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="blog_post">
                                <div class="project-photo"
                                     style=" height: 300px; background: url(<?= URL . '/' . $img['ruta'] ?>) no-repeat center center/cover;">
                                </div>
                                <div class="blog_details">
                                    <a href="<?php echo URL . '/blog/' . $funciones->normalizar_link($nov['titulo']) . "/" . $nov['cod'] ?>"><?= ucfirst($nov['titulo']) ?></a>
                                    <p><?php echo strip_tags(substr($nov["desarrollo"],0,400)); ?>...</p>
                                    <a title="Leer más" href="<?php echo URL . '/blog/' . $funciones->normalizar_link($nov['titulo']) . "/" . $nov['cod'] ?>" class="white_bg_btn">Leer Mas</a>
                                </div>
                            </div>

                        </div>
                    </article>
                </br>
                    <?php endforeach;?>
                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item page-link">
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
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================Blog Area =================-->
<?php $template->themeEnd(); ?>