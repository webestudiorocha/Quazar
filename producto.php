
<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
//Clases
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$productos = new Clases\Productos();
$productos->set("cod", $cod);
$producto_data = $productos->view();
$imagenes = new Clases\Imagenes();
$imagenes->set("cod",$producto_data['cod']);
$filter = array("cod='" . $producto_data['cod'] . "'");
$imagenes_data = $imagenes->view();
$cod = isset($_GET["cod"]) ? $_GET["cod"] : '';
$categorias = new Clases\Categorias();
$categorias->set("cod", $cod);
$categoria_data = $categorias->view();
$template = new Clases\TemplateSite();
$template->set("title", TITULO .' | '.ucfirst(strip_tags($producto_data['titulo'])));
$template->set("imagen", URL."/".$imagenes_data['ruta']);
$template->set("favicon", LOGO);
$template->set("keywords", strip_tags($producto_data['keywords']));
$template->set("description", ucfirst(substr(strip_tags($producto_data['desarrollo']), 0, 160)));
$template->themeInit();
?>
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1><?= ucfirst($producto_data['titulo']); ?></h1>

				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
                 <div class="single-prd-item">
                 <a> <img class="img-fluid" style= "height: 400px; width: 500px; no-repeat center center/cover;"  src="<?= URL . '/'. $imagenes_data['ruta'] ?>" alt=""></a>
                 </div>
				</div>
				<div class="col-lg-5 offset-lg-1 borderes">
					<div class="s_product_text">
                        <ul class="list">
                           <h5>Categoria: <?= ucfirst($categoria_data['titulo']);?></h5>
                            <h5>Cantidad en stock: <?= $producto_data['stock']; ?></h5>
                        </ul>
						<h4>Precio: <?= ucfirst($producto_data['precio']); ?></h4>
                        <h4>10% de descuento por pago de contado <?= ucfirst($producto_data['precioDescuento']); ?></h4>
                        </br>
						<div class="product_count">
							<label for="qty"><h4>Cantidad que quiere comprar:</h4></label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
							 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
							 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item ">
					<a class="nav-link active " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descripcion</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					 aria-selected="false">Detalles</a>
				</li>
			</ul>
			<div class="tab-content " id="myTabContent">
				<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p><?= ucfirst($producto_data['desarrollo']); ?></p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Width</h5>
									</td>
									<td>
										<h5>128mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Height</h5>
									</td>
									<td>
										<h5>508mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Depth</h5>
									</td>
									<td>
										<h5>85mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Weight</h5>
									</td>
									<td>
										<h5>52gm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Quality checking</h5>
									</td>
									<td>
										<h5>yes</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Freshness Duration</h5>
									</td>
									<td>
										<h5>03days</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>When packeting</h5>
									</td>
									<td>
										<h5>Without touch of hand</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Each Box contains</h5>
									</td>
									<td>
										<h5>60pcs</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

<?php $template->themeEnd(); ?>