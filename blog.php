<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
//Clases
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$novedades = new Clases\Novedades();
$imagenes = new Clases\Imagenes();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$novedades->set("cod", $cod);
$novedades_data = $novedades->view();
$imagenes->set("cod", $novedades_data['cod']);
$filter = array("cod='" . $novedades_data['cod'] . "'");
$novedadesData = $novedades->listWithOps("", "", "5");

$imagenes_data = $imagenes->view();
$fecha = explode("-", $novedades_data['fecha']);
$template->set("title", TITULO . ' | ' . ucfirst(strip_tags($novedades_data['titulo'])));
$template->set("imagen", URL . "/" . $imagenes_data['ruta']);
$template->set("favicon", LOGO);
$template->set("keywords", strip_tags($novedades_data['keywords']));
$template->set("description", ucfirst(substr(strip_tags($novedades_data['desarrollo']), 0, 160)));
$template->themeInit();
$template->themeNav();
?>
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
                    <img src="<?= URL . '/' . $imagenes_data['ruta'] ?>" width="100%">
                    <div class="blog_info text-left">
                        <ul class="blog_meta list">
                            <li><span class="poster"> <?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></span>
                                <i class="lnr lnr-calendar-full"></i></li>
                        </ul>
                    </div>
                    <p>
                        <?= $novedades_data['desarrollo']; ?>
                    </p>
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
                                        <h3><?= $nov['titulo'] ?></h3>
                                    </a>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="br"></div>
                    </aside>
                    <aside class="single_sidebar_widget ads_widget">
                        <a href="#"><img class="img-fluid" src="<?= URL ?>/assets/img/blog/add.jpg" alt=""></a>
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
                                    <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                       placeholder="Correo electrónico"
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

<?php $template->themeEnd(); ?>




