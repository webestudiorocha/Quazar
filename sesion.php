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
if (count($usuarioSesion) == 0) {
    $funciones->headerMove(URL . "/index");
}
?>
<br>
<br>
<br>

<section class="categories_product_main p_80">
    <div class="container">
        <div class="categories_main_inner">
            <div class="row row_disable">
                <div class="col-lg-3 float-md-right" style="padding-top: 40px !important;">
                    <div class="categories_sidebar">
                        <aside class="l_widgest l_menufacture_widget">
                            <div class="l_w_title"><h3>Panel</h3></div>
                            <ul>
                                <li><a href="<?= URL ?>/sesion/cuenta"> <span class="no_line_h"><i
                                                    class="fa fa-user" aria-hidden="true"></i></span> Mi cuenta </a>
                                </li>
                                <li><a href="<?= URL ?>/sesion/pedidos"> <span class="no_line_h"><i
                                                    class="fa fa-bookmark" aria-hidden="true"></i></span> Mis pedidos
                                    </a></li>
                                <li><a href="<?= URL ?>/sesion/logout"> <span class="no_line_h"><i
                                                    class="fa fa-sign-out" aria-hidden="true"></i></span>Salir </a></li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9 float-md-right">
                    <div class="categories_product_area">
                        <div class="row">
                            <?php
                            $op = isset($_GET["op"]) ? $_GET["op"] : 'pedidos';
                            if ($op != '') {
                                include("assets/inc/sesion/" . $op . ".php");
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<br>
<br>
<?php
$template->themeEnd();
?>
