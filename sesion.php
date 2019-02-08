<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$enviar = new Clases\Email();
$template->set("title", TITULO . " | Panel");
$template->set("description", "Panel " . TITULO);
$template->set("keywords", "Panel " . TITULO);
$template->themeInit();
$usuarios = new Clases\Usuarios();
$usuarioSesion = $usuarios->view_sesion();
if (empty($usuarioSesion)) {
    unset($_SESSION["usuarios"]);
    $funciones->headerMove(URL . "/index");
}
$template->themeNav();

?>
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first d-none d-md-block">
                <h1>Mi cuenta</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?= URL ?>/sesion">Mi Cuenta<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#"><?= ucfirst(isset($_GET["op"]) ? $_GET["op"] : 'pedidos');?></a>
                </nav>
            </div>
            <div class="col-md-12 d-md-none">
                <h1>Mi cuenta</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?= URL ?>/sesion">Mi Cuenta<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#"><?= ucfirst(isset($_GET["op"]) ? $_GET["op"] : 'pedidos');?></a>
                </nav>
            </div>
        </div>
    </div>
</section>
</br>
<!-- End Banner Area -->
<div class="container pt-50 pb-50">
    <div class="row">
        <div class="col-md-3">
            <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget popular_post_widget pedidos_box">
                    <h3 class="widget_title">MENU</h3>
                    <div class="media post_item">
                        <div class="media-body">
                            <a href="<?= URL ?>/sesion/cuenta">
                                <h3>Mi cuenta</h3>
                            </a>
                        </div>
                    </div><hr>
                    <div class="media post_item">
                        <div class="media-body">
                            <a href="<?= URL ?>/sesion/pedidos">
                                <h3>Mis pedidos</h3>
                            </a>
                        </div>
                    </div><hr>
                    <div class="media post_item">
                        <div class="media-body">
                            <a href="<?= URL ?>/sesion/logout">
                                <h3>Salir</h3>
                            </a>
                        </div>
                    </div>
                    <br/>
                </aside>
            </div>
        </div>
        <div class="col-lg-9">
            <section class="">
                <section class="">
                    <?php
                    $op = isset($_GET["op"]) ? $_GET["op"] : 'pedidos';
                    if ($op != '') {
                        include("assets/inc/sesion/" . $op . ".php");
                    }
                    ?>
                </section>
            </section>
        </div>
    </div>
</div>
<?php
$template->themeEnd();
?>
