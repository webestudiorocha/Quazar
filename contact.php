<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$imagenes = new Clases\Imagenes();
$portfolio = new Clases\Portfolio();
$novedades = new Clases\Novedades();
$sliders = new Clases\Sliders();
$template->set("title", TITULO . " | Inicio");
$template->set("description", "Inicio " . TITULO);
$template->set("keywords", "Inicio," . TITULO);
$template->set("imagen", LOGO);
$enviar = new Clases\Email();
$funciones = new Clases\PublicFunction();
$template->themeInit();
?>
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Contacto</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
    <br>
    </br>
	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
        <h1 style="text-align: center">Formulario</h1>
        <?php if (isset($_POST["enviar"])):
            $nombre = $funciones->antihack_mysqli(isset($_POST["nombre"]) ? $_POST["nombre"] : '');
            $email = $funciones->antihack_mysqli(isset($_POST["email"]) ? $_POST["email"] : '');
            $telefono = $funciones->antihack_mysqli(isset($_POST["telefono"]) ? $_POST["telefono"] : '');
            $consulta = $funciones->antihack_mysqli(isset($_POST["consulta"]) ? $_POST["consulta"] : '');
            $asunto = $funciones->antihack_mysqli(isset($_POST["asunto"]) ? $_POST["asunto"] : '');

            $mensajeFinal = "<b>Nombre</b>: " . $nombre . " <br/>";
            $mensajeFinal .= "<b>Email</b>: " . $email . "<br/>";
            $mensajeFinal .= "<b>Teléfono</b>: " . $telefono . " <br/>";
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
            $mensajeFinalAdmin .= "<b>URL</b>: " . $asunto . "<br/>";
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

				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6>San Francisco, Cordoba</h6>
							<p>xxxxxxx</p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6><a href="#">213213213</a></h6>
                                <p></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6><a href="#">info@quazar.com.ar</a></h6>
							<p>Tu consulta no es molestia!</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" method="post" id="contact-form" >
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" id="name" name="nombre" placeholder="Nombre" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre'">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
							</div>
                            <div class="form-group">
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Telefono'">
                            </div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="consulta" id="message" rows="1" placeholder="Mensaje" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mensaje'"></textarea>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<button type="submit" value="submit" class="primary-btn">Enviar Mensaje</button>
						</div>
					</form>
				</div>
			</div>
            <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                 data-mlat="40.701083" data-mlon="-74.1522848">
            </div>
		</div>
	</section>
	<!--================Contact Area =================-->

	<!--================Contact Success and Error message Area =================-->
	<div id="success" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Thank you</h2>
					<p>Your message is successfully sent...</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Modals error -->

	<div id="error" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Sorry !</h2>
					<p> Something went wrong </p>
				</div>
			</div>
		</div>
	</div>
	<!--================End Contact Success and Error message Area =================-->
<?php $template->themeEnd();?>