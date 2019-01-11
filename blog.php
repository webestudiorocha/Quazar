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
$imagenes_data = $imagenes->list($filter);
$fecha = explode("-", $novedades_data['fecha']);
$template = new Clases\TemplateSite();
$template->set("title", TITULO .' | '.ucfirst(strip_tags($novedades_data['titulo'])));
$template->set("imagen", URL."/".$imagenes_data[0]['ruta']);
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
                    <h1></h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-12 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="img/blog/feature-img1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">

                                <ul class="blog_meta list">

                                    <li><a href="#">12 Dec, 2018<i class="lnr lnr-calendar-full"></i></a></li>

                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2></h2>
                            <p class="excert">

                            </p>


                        </div>

                    </div>



                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
<?php $template->themeEnd(); ?>