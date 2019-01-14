<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
//Clases
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$novedades = new Clases\Novedades();
$novedades->set("cod", $cod);
$novedades_data = $novedades->view();
$imagenes = new Clases\Imagenes();
$filter = array("cod='" . $novedades_data['cod'] . "'");
$imagenes_data = $imagenes->view();
$fecha = explode("-", $novedades_data['fecha']);
$template = new Clases\TemplateSite();
$template->set("title", TITULO .' | '.ucfirst(strip_tags($novedades_data['titulo'])));
$template->set("imagen", URL."/".$imagenes_data['ruta']);
$template->set("favicon", LOGO);
$template->set("keywords", strip_tags($novedades_data['keywords']));
$template->set("description", ucfirst(substr(strip_tags($novedades_data['desarrollo']), 0, 160)));
$template->themeInit();
?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1><?= ucfirst($novedades_data["titulo"]); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img"
                                style=" height: 300px; background: url(<?= URL . '/' . $imagenes_data['ruta'] ?>) no-repeat center center/cover;">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">

                                <ul class="blog_meta list">
                                    <li><i class="lnr lnr-calendar-full"></i><span></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h1><?= $novedades_data['titulo']; ?></h1>
                            <p>
                                <?= $novedades_data['desarrollo']; ?>
                            </p>


                        </div>

                    </div>



                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
<?php $template->themeEnd(); ?>