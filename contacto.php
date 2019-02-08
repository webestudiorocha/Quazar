<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$imagenes = new Clases\Imagenes();
$portfolio = new Clases\Portfolio();
$novedades = new Clases\Novedades();
$sliders = new Clases\Sliders();
$template->set("title", TITULO . " | Contacto");
$template->set("description", "Contacto de " . TITULO);
$template->set("keywords", "Contacto de " . TITULO);
$template->set("favicon", FAVICON);
$enviar = new Clases\Email();
$template->themeInit();
$template->themeNav();

?>
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first d-none d-md-block">
					<h1>Contacto</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                        <a href="<?= URL ?>/contacto">Contacto</a>
                    </nav>
				</div>
                <div class="col-md-12 d-md-none">
					<h1>Contacto</h1>
                    <nav class="d-flex align-items-center">
                        <a href="<?= URL ?>/index">Inicio<span class="lnr lnr-arrow-right"></span></a>
                        <a href="<?= URL ?>/contacto">Contacto</a>
                    </nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
    <br>
    </br>
	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
        <h1 style="text-align: center">Dejanos tu consulta</h1>
        <?php if (isset($_POST["enviar"])):
            $nombre = $funciones->antihack_mysqli(isset($_POST["nombre"]) ? $_POST["nombre"] : '');
            $email = $funciones->antihack_mysqli(isset($_POST["email"]) ? $_POST["email"] : '');
            $telefono = $funciones->antihack_mysqli(isset($_POST["telefono"]) ? $_POST["telefono"] : '');
            $consulta = $funciones->antihack_mysqli(isset($_POST["consulta"]) ? $_POST["consulta"] : '');

            $mensajeFinal = "<b>Gracias por realizar tu consulta, te contactaremos a la brevedad</b><br/>";
            $mensajeFinal .= "<b>Consulta</b>: " . $consulta . "<br/>";

            //USUARIO
            $enviar->set("asunto", "Realizaste tu consulta");
            $enviar->set("receptor", $email);
            $enviar->set("emisor", EMAIL);
            $enviar->set("mensaje", $mensajeFinal);
            if ($enviar->emailEnviar() == 1):
                echo '<div class="alert alert-success" role="alert">¡Consulta enviada correctamente!</div>';
            endif;

            //ADMIN

            $mensajeFinalAdmin = "<b>Nombre</b>: " . $nombre . " <br/>";
            $mensajeFinalAdmin .= "<b>Email</b>: " . $email . "<br/>";
            $mensajeFinalAdmin .= "<b>Teléfono</b>: " . $telefono . " <br/>";
            $mensajeFinalAdmin .= "<b>Consulta</b>: " . $consulta . "<br/>";
            //ADMIN
            $enviar->set("asunto", "Consulta Web");
            $enviar->set("receptor", EMAIL);
            $enviar->set("mensaje", $mensajeFinalAdmin);
            if ($enviar->emailEnviar() == 0):
                echo '<div class="alert alert-danger" role="alert">¡No se ha podido enviar la consulta!</div>';
            endif;
        endif; ?>
		<div class="container">
			<div class="row">

				<div class="col-md-4">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6><?=CIUDAD.', '.PROVINCIA?></h6>
							<p><?=DIRECCION?></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6><a href="#"><?=TELEFONO?></a></h6>
                                <p></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6><a href="#"><?=EMAIL?></a></h6>
							<p>Tu consulta no es molestia!</p>
						</div>
					</div>
				</div>
				<div  class="col-md-8">
					<form class="row contact_form" method="post" id="contact-form" >
						<div class="col-md-6">
							<div class="form-group">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required id="name"
                                       title="nombre" />
                            </div>
							<div class="form-group">
                                <input type="hidden" name="asunto" class="form-control" placeholder="Nombre" required id="name"
                                       title="asunto" value="<?= CANONICAL ?>"/>							</div>
                            <div class="form-group">
                                <input type="text" name="telefono" class="form-control" placeholder="Telefono" required
                                       id="telefono" title="telefono" value=""/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email"
                                       required id="email" title="Email" value=""/>
                            </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
                                <textarea name="consulta" class="form-control" placeholder="Consulta" id="comment" title="Comment"></textarea>
                            </div>
						</div>
						<div class="col-md-12 text-right">
                            <input type="submit" name="enviar" class="primary-btn" id="submit" value="Enviar Mensaje">
						</div>
					</form>
				</div>
			</div>
            <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                 data-mlat="40.701083" data-mlon="-74.1522848">
            </div>
		</div>
	</section>
<?php $template->themeEnd();?>