<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
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

$cantidad = 3;

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
$template->themeNav();
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
    </br>
     <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        <?php
                        foreach ($novedadesData as $nov) {
                            $imagenes->set("cod", $nov['cod']);
                            $img = $imagenes->view();
                            $fecha = explode("-", $nov['fecha']);
                            ?>
                            <article class="row blog_item">
                                <div class="col-md-12">
                                    <div class="blog_post">
                                        <div class="project-photo"
                                             style=" height: 300px; background: url(<?= URL . '/' . $img['ruta'] ?>) no-repeat center center/cover;">
                                        </div>
                                        <div class="blog_details">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?>
                                            <a href="<?php echo URL . '/blog/' . $funciones->normalizar_link($nov['titulo']) . "/" . $nov['cod'] ?>">
                                                <h2><?= ucfirst($nov['titulo']) ?></h2>
                                            </a>
                                            <?php echo strip_tags(substr($nov["desarrollo"], 0, 400)); ?>
                                            <hr/>
                                            <a href="<?php echo URL . '/blog/' . $funciones->normalizar_link($nov['titulo']) . "/" . $nov['cod'] ?>" class="btn-y">Seguir leyendo</a>
                                        </div>
                                    </div>
                                </div>
                            </article><br><br>
                        <?php } ?>
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item page-link">
                                    <?php if (($pagina + 1) > 1): ?>
                                <li><a href="<?= $url ?><?= $anidador ?>pagina=<?= $pagina ?>"><i
                                                class="fa fa-angle-left"></i></a></li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $numeroPaginas; $i++): ?>
                                    <li class="<?php if ($i == $pagina + 1) {
                                        echo "active";
                                    } ?>"><a href="<?= $url ?><?= $anidador ?>pagina=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>

                                <?php if (($pagina + 2) <= $numeroPaginas): ?>
                                    <li><a href="<?= $url ?><?= $anidador ?>pagina=<?= ($pagina + 2) ?>"><i
                                                    class="fa fa-angle-right"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Reciente</h3>
                                <?php
                                foreach ($novedadesData as $nov) {
                                $imagenes->set("cod", $nov['cod']);
                                $img = $imagenes->view();
                                $fecha = explode("-", $nov['fecha']);
                                ?>
                                    <div class="media post_item">
                                <div style=" width: 100px; height: 60px; background: url(<?= URL . '/' . $img['ruta'] ?>) no-repeat center center/cover;">
                                </div>
                                <div class="media-body">
                                    <a href="<?php echo URL . '/blog/' . $funciones->normalizar_link($nov['titulo']) . "/" . $nov['cod'] ?>">
                                        <h3><?=$nov['titulo']?></h3>
                                    </a>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="br"></div>
                        </aside>
                        <aside class="single_sidebar_widget ads_widget">
                            <a href="#"><img class="img-fluid" src="<?=URL?>/assets/img/blog/add.jpg" alt=""></a>
                            <div class="br"></div>
                        </aside>
                        <aside class="single-sidebar-widget newsletter_widget">
                            <h4 class="widget_title">Suscribirse</h4>
                            <p>
                                Suscribíte a nuestra boletín para recibir las últimas novedades y promociones.
                            </p>
                            <div class="form-group d-flex flex-row">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Correo electrónico"
                                           onfocus="this.placeholder = ''" onblur="this.placeholder = 'Correo electrónico'">
                                </div>
                                <a href="#" class="bbtns">Suscribir</a>
                            </div>
                            <div class="br"></div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
<?php $template->themeEnd(); ?>