<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones= new Clases\PublicFunction();

//Clases
$imagenes = new Clases\Imagenes();
$novedades = new Clases\Novedades();
$banners = new Clases\Banner();
//Productos
$id       = isset($_GET["id"]) ? $_GET["id"] : '';
$novedades->set("id",$id);
$novedadData = $novedades->view();
$imagenes->set("cod",$novedadData['cod']);
$imagenData = $imagenes->view();
$novedadesData = $novedades->list('');
$fecha = explode("-", $novedadData['fecha']);
$template->set("title", ucfirst($novedadData['titulo']));
$template->set("description", $novedadData['description']);
$template->set("keywords", $novedadData['keywords']);
$template->set("imagen", URL."/".$imagenData['ruta']);
$template->set("favicon", LOGO);
$template->themeInit();
//
?>
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1><?= ucfirst($novedadData["titulo"]); ?></h1>
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
                            <div class="feature-img">
                                <img src="<?= URL. '/' . $imagenData['ruta']; ?>" alt="<?= $novedadData['titulo']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">

                                <ul class="blog_meta list">
                                    <li><a href="#"> <span><?php echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] ?></span><i class="lnr lnr-calendar-full"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>Astronomy Binoculars A Great Alternative</h2>
                            <p class="excert">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand
                                why you should have to spend money on boot camp when you can get the MCSE study
                                materials yourself at a fraction.
                            </p>
                            <p>
                                Boot camps have its supporters and its detractors. Some people do not understand why
                                you should have to spend money on boot camp when you can get the MCSE study materials
                                yourself at a fraction of the camp price. However, who has the willpower to actually
                                sit through a self-imposed MCSE training. who has the willpower to actually sit through
                                a self-imposed
                            </p>
                            <p>
                                Boot camps have its supporters and its detractors. Some people do not understand why
                                you should have to spend money on boot camp when you can get the MCSE study materials
                                yourself at a fraction of the camp price. However, who has the willpower to actually
                                sit through a self-imposed MCSE training. who has the willpower to actually sit through
                                a self-imposed
                            </p>
                        </div>

                    </div>



                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
<?php $template->themeEnd(); ?>