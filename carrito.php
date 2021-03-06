<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$template->set("title", TITULO . " | Carrito de compra");
$template->set("description", "Carrito de compra " . TITULO);
$template->set("keywords", "Carrito de compra " . TITULO);
$template->set("favicon", FAVICON);
$template->themeInit();
//Clases
$productos = new Clases\Productos();
$imagenes = new Clases\Imagenes();
$categorias = new Clases\Categorias();
$banners = new Clases\Banner();
$carrito = new Clases\Carrito();
$envios = new Clases\Envios();
$pagos = new Clases\Pagos();
$carro = $carrito->return();
$carroEnvio = $carrito->checkEnvio();
$total = 0;
if (count($carro) == 0) {
    $funciones->headerMove(URL . "/productos.php");
}
$template->themeNav();
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first d-none d-md-block">
                <h1>Carrito</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?= URL ?>/carrito">Carrito</a>
                </nav>
            </div>
            <div class="col-md-12 d-md-none">
                <h1>Carrito</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?= URL ?>/carrito">Carrito</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<?php
$metodos_de_envios = $envios->list(array("peso >= " . $carrito->peso_final() . " OR peso = 0"));
if (isset($_POST["envio"])) {
    if ($carroEnvio != '') {
        $carrito->delete($carroEnvio);
    }
    $envio_final = $_POST["envio"];
    $envios->set("cod", $envio_final);
    $envio_final_ = $envios->view();
    $carrito->set("id", "Envio-Seleccion");
    $carrito->set("cantidad", 1);
    $carrito->set("titulo", $envio_final_["titulo"]);
    $carrito->set("precio", $envio_final_["precio"]);
    $carrito->add();
    $funciones->headerMove(CANONICAL . "");
}
?>

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <h5>Seleccioná el envió que más te convenga:</h5>
        <form method="post" class="calculate_shoping_form" id="envio">
            <select name="envio" class="form-control" id="envio" onchange="this.form.submit()">
                <option value="" selected disabled>Elegir envío</option>
                <?php
                foreach ($metodos_de_envios as $metodos_de_envio_) {
                    if ($metodos_de_envio_["precio"] == 0) {
                        $metodos_de_envio_precio = "¡Gratis!";
                    } else {
                        $metodos_de_envio_precio = "$" . $metodos_de_envio_["precio"];
                    }
                    echo "<option value='" . $metodos_de_envio_["cod"] . "'>" . $metodos_de_envio_["titulo"] . " -> " . $metodos_de_envio_precio . "</option>";
                }
                ?>
            </select>
        </form>
        <div class="clearfix"></div>
        <br>
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Producto</th>
                        <th class="hidden-xs" scope="col">Precio Unitario</th>
                        <th class="hidden-xs" scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $carroEnvio = $carrito->checkEnvio();
                    if (isset($_GET["remover"])) {
                        $carroPago = $carrito->checkPago();
                        if ($carroPago != '') {
                            $carrito->delete($carroPago);
                        }
                        $carroEnvio = $carrito->checkEnvio();
                        if ($carroEnvio != '') {
                            $carrito->delete($carroEnvio);
                        }
                        $carrito->delete($_GET["remover"]);
                        $funciones->headerMove(URL . "/carrito");
                    }

                    $i = 0;
                    $precio = 0;
                    foreach ($carro as $key => $carroItem) {

                        $precio += ($carroItem["precio"] * $carroItem["cantidad"]);
                        $opciones = @implode(" - ", $carroItem["opciones"]);
                        if ($carroItem["id"] == "Envio-Seleccion" || $carroItem["id"] == "Metodo-Pago") {
                            $clase = "text-bold";
                            $none = "hidden";
                        } else {
                            $clase = "";
                            $none = "";
                        }
                        $productos->set("cod", $carroItem['id']);
                        $pro = $productos->view();
                        $imagenes->set("cod", $pro['cod']);
                        $img = $imagenes->view();
                        $imgMostrar = URL . '/' . $img['ruta'];
                        if ($carroItem["id"] == "Envio-Seleccion") {
                            $imgMostrar = URL . '/assets/img/envios.png';
                        }
                        if ($carroItem["id"] == "Metodo-Pago") {
                            $imgMostrar = URL . '/assets/img/pago.png';
                        }

                        ?>
                        <tr>
                            <td>
                                <a href="<?= URL ?>/carrito.php?remover=<?= $key ?>">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                            <td>
                                <div class="media hidden-xs">
                                    <div class="d-flex">
                                        <div style="background: url(<?= $imgMostrar; ?>)center/cover;height: 70px;width: 70px;border-radius: 3px;"></div>
                                    </div>
                                    <div class="media-body">
                                        <p><?= mb_strtoupper($carroItem["titulo"]); ?></p>
                                    </div>
                                </div>
                                <div class="media d-md-none">
                                    <div class="media-body">
                                        <p><?= mb_strtoupper($carroItem["titulo"]); ?></p>
                                        <p class="<?= $none ?>">Cantidad: <?= $carroItem["cantidad"]; ?></p>
                                        <p class="<?= $none ?>">Precio: $<?= $carroItem["precio"]; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden-xs">
                                <h5 class="<?= $none ?>">$<?= $carroItem["precio"]; ?></h5>
                            </td>
                            <td class="hidden-xs">
                                <div class="product_count">
                                    <h5 class="<?= $none ?>"><?= $carroItem["cantidad"]; ?></h5>
                                </div>
                            </td>
                            <td class="total-mobile">
                                <?php if ($carroItem["precio"] != 0) { ?>
                                    <h5>$ <?= $carroItem["precio"] * $carroItem["cantidad"] ?></h5>
                                <?php } else {
                                    echo "<h5>¡Gratis!</h5>";
                                } ?>
                            </td>
                        </tr>
                        <?php
                        $total += $carroItem["precio"] * $carroItem["cantidad"];
                        $i++;
                    }
                    ?>

                    <tr>
                        <td class="hidden-xs">

                        </td>
                        <td class="hidden-xs">

                        </td>
                        <td class="hidden-xs">

                        </td>
                        <td class="hidden-xs">
                            <h3>Total</h3>
                        </td>
                        <td class="hidden-xs">
                            <h3>$ <?= $total; ?></h3>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="col-md-12 d-md-none mb-10 mt-5" style="float: right;text-align: center;">
                    <h3>Total: $<?= $total; ?></h3>
                </div>
                <br>
                <div class="col-md-12">
                    <form method="post">
                        <!---->
                        <?php
                        $metodo = isset($_POST["metodos-pago"]) ? $_POST["metodos-pago"] : '';
                        $metodo_get = isset($_GET["metodos-pago"]) ? $_GET["metodos-pago"] : '';
                        if ($metodo != '') {
                            $key_metodo = $carrito->checkPago();
                            $carrito->delete($key_metodo);
                            $pagos->set("cod", $metodo);
                            $pago__ = $pagos->view();
                            $precio_final_metodo = $carrito->precio_total();
                            if ($pago__["aumento"] != 0 || $pago__["disminuir"] != '') {
                                if ($pago__["aumento"]) {
                                    $numero = (($precio_final_metodo * $pago__["aumento"]) / 100);
                                    $carrito->set("id", "Metodo-Pago");
                                    $carrito->set("cantidad", 1);
                                    $carrito->set("titulo", "CARGO +" . $pago__['aumento'] . "% / " . mb_strtoupper($pago__["titulo"]));
                                    $carrito->set("precio", $numero);
                                    $carrito->add();
                                } else {
                                    $numero = (($precio_final_metodo * $pago__["disminuir"]) / 100);
                                    $carrito->set("id", "Metodo-Pago");
                                    $carrito->set("cantidad", 1);
                                    $carrito->set("titulo", "DESCUENTO -" . $pago__['disminuir'] . "% / " . mb_strtoupper($pago__["titulo"]));
                                    $carrito->set("precio", "-" . $numero);
                                    $carrito->add();
                                }
                                $funciones->headerMove(CANONICAL . "/" . $metodo);
                            }
                        }
                        ?>
                        <div class="cart_totals_area" style="float:right;">
                            <?php
                            //unset($_SESSION["carrito"]);
                            if ($carroEnvio != '') {
                                ?>
                                <h4>Métodos de pago</h4>
                                <?php
                            } elseif ($carroEnvio == '') {
                                ?>
                                <h4>Elegir envío</h4>
                                <?php
                            }
                            ?>
                            <div class="cart_t_list">
                                <div class="media">
                                    <div class="media-body">
                                        <?php if ($carroEnvio == '') { ?>
                                            <span class="anchobtn espaciosbtn btn primary-btn" id="button_envio">¿CÓMO PEREFERÍS EL ENVÍO DEL PEDIDO?</span>
                                            <p class="checkout text-bold"><br/>¡Necesitamos que nos digas como querés realizar <br/>tu envío para que lo tengas listo cuanto antes!</p>
                                            <?php
                                        } else {
                                            $lista_pagos = $pagos->list(array(" estado = 0 "));
                                            foreach ($lista_pagos as $pago) {
                                                ?>
                                                <div class="radioButtonPay mb-10">
                                                    <input type="radio" id="<?= ($pago["cod"]) ?>" name="metodos-pago" value="<?= ($pago["cod"]) ?>" onclick="this.form.submit()" <?php if ($metodo_get === $pago["cod"]) {
                                                        echo " checked ";
                                                    } ?>>
                                                    <label for="<?= ($pago["cod"]) ?>"><b><?= mb_strtoupper($pago["titulo"]) ?></b></label>
                                                    <p>
                                                        <?= $pago["leyenda"] ?>
                                                    </p>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        <?php if ($metodo_get != '') { ?>
                            <a class="primary-btn" href="<?= URL ?>/pagar/<?= $metodo_get ?>">Pagar</a>
                        <?php } ?>
                        <!---->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<?php $template->themeEnd(); ?>

<script>
    $("#button_envio").click(function () {
        $('#envio').addClass('alert alert-danger');
        $('#envio').css('height', '65px');
        $('html, body').animate({
            scrollTop: 200
        }, 1000);
    });
</script>
