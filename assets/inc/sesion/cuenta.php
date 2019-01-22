<?php
//Clases
$usuario = new Clases\Usuarios();
$usuario->set("cod", $_SESSION["usuarios"]["cod"]);
$usuarioData = $usuario->view();
?>
<br>
<br>
<div class="col-lg-9 float-md-right">
    <?php
    if (isset($_POST["guardar"])):

        $nombre = $funciones->antihack_mysqli(!empty($_POST["nombre"]) ? $_POST["nombre"] : '');
        $apellido = $funciones->antihack_mysqli(!empty($_POST["apellido"]) ? $_POST["apellido"] : '');
        $email = $funciones->antihack_mysqli(!empty($_POST["email"]) ? $_POST["email"] : '');
        $password = $funciones->antihack_mysqli(!empty($_POST["password"]) ? $_POST["password"] : '');
        $provincia = $funciones->antihack_mysqli(!empty($_POST["provincia"]) ? $_POST["provincia"] : '');
        $localidad = $funciones->antihack_mysqli(!empty($_POST["localidad"]) ? $_POST["localidad"] : '');
        $direccion = $funciones->antihack_mysqli(!empty($_POST["direccion"]) ? $_POST["direccion"] : '');
        $telefono = $funciones->antihack_mysqli(!empty($_POST["telefono"]) ? $_POST["telefono"] : '');
        $postal = $funciones->antihack_mysqli(!empty($_POST["postal"]) ? $_POST["postal"] : '');

        if (!empty($_POST["password"]) && !empty($_POST["password2"])):
            if ($_POST["password"] == $_POST['password2']):
                $password = $funciones->antihack_mysqli($_POST["password"]);
            else:
                echo '<div class="alert alert-warning" role="alert">Las contraseña no coinciden</div>';
                $password = $usuarioData['password'];
            endif;
        else:
            $password = $usuarioData['password'];
        endif;

        $usuario->set("cod", $usuarioData['cod']);
        $usuario->set("nombre", $nombre);
        $usuario->set("apellido", $apellido);
        $usuario->set("email", $email);
        $usuario->set("provincia", $provincia);
        $usuario->set("localidad", $localidad);
        $usuario->set("direccion", $direccion);
        $usuario->set("telefono", $telefono);
        $usuario->set("postal", $postal);
        $usuario->set("password", $password);
        $usuario->set("fecha", $usuarioData['fecha']);

        $usuario->edit();
        $funciones->headerMove(URL . '/sesion/cuenta');
    endif;
    ?>
    <br>
    <br>
    <div class="categories_product_area ">
        <div class="row">
            <div class="col-md-12">
                <form class="login_form" id="registro" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">Nombre
                            <div class="input-group"><input class="form-control h40" value="" type="text"
                                                            placeholder="Nombre" name="nombre" required=""> <span
                                        class="input-group-addon"> <i class="login_icon glyphicon glyphicon-user"></i> </span>
                            </div>
                        </div>
                        <div class="col-md-6">Apellido
                            <div class="input-group"><input class="form-control h40" value="" type="text"
                                                            placeholder="Apellido" name="apellido" required=""> <span
                                        class="input-group-addon"> <i class="login_icon glyphicon glyphicon-user"></i> </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">Email
                            <div class="input-group"><input class="form-control h40" value="" type="email"
                                                            placeholder="Email" name="email" required=""> <span
                                        class="input-group-addon"> <i
                                            class="login_icon glyphicon glyphicon-envelope"></i> </span></div>
                        </div>
                        <div class="col-md-6">Teléfono
                            <div class="input-group"><input class="form-control h40" value="" type="number"
                                                            placeholder="Teléfono" name="telefono" required=""> <span
                                        class="input-group-addon"> <i class="login_icon glyphicon glyphicon-phone"></i> </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">Provincia
                            <div class="input-group"><select class="pull-right form-control h40" name="provincia"
                                                             id="provincia" required="">
                                    <option value="" selected=""></option>
                                    <option value="Buenos Aires">BUENOS AIRES</option>
                                    <option value="C?rdoba">C?RDOBA</option>
                                    <option value="Catamarca">CATAMARCA</option>
                                    <option value="Chaco">CHACO</option>
                                    <option value="Chubut">CHUBUT</option>
                                    <option value="Ciudad Aut?noma de Buenos Aires (CABA)">CIUDAD AUT?NOMA DE BUENOS
                                        AIRES (CABA)
                                    </option>
                                    <option value="Corrientes">CORRIENTES</option>
                                    <option value="Entre R?os">ENTRE R?OS</option>
                                    <option value="Formosa">FORMOSA</option>
                                    <option value="Jujuy">JUJUY</option>
                                    <option value="La Pampa">LA PAMPA</option>
                                    <option value="La Rioja">LA RIOJA</option>
                                    <option value="Mendoza">MENDOZA</option>
                                    <option value="Misiones">MISIONES</option>
                                    <option value="Neuqu?n">NEUQU?N</option>
                                    <option value="R?o Negro">R?O NEGRO</option>
                                    <option value="Salta">SALTA</option>
                                    <option value="San Juan">SAN JUAN</option>
                                    <option value="San Luis">SAN LUIS</option>
                                    <option value="Santa Cruz">SANTA CRUZ</option>
                                    <option value="Santa Fe">SANTA FE</option>
                                    <option value="Santiago del Estero">SANTIAGO DEL ESTERO</option>
                                    <option value="Tierra del Fuego">TIERRA DEL FUEGO</option>
                                    <option value="Tucum?n">TUCUM?N</option>
                                </select> <span class="input-group-addon"><i
                                            class="login_icon glyphicon glyphicon-map-marker"></i></span></div>
                        </div>
                        <div class="col-md-6">Localidad
                            <div class="input-group"><select class="form-control h40" name="localidad" id="localidad"
                                                             required="">
                                    <option value="" selected=""></option>
                                </select> <span class="input-group-addon"><i
                                            class="login_icon glyphicon glyphicon-map-marker"></i></span></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">Dirección
                            <div class="input-group"><input class="form-control h40" value="" type="text"
                                                            placeholder="Dirección" name="direccion" required=""> <span
                                        class="input-group-addon"> <i
                                            class="login_icon glyphicon glyphicon-map-marker"></i> </span></div>
                        </div>
                        <div class="col-md-6">Código Postal
                            <div class="input-group"><input class="form-control h40" value="" type="text"
                                                            placeholder="Código Postal" name="postal" required=""> <span
                                        class="input-group-addon"> <i
                                            class="login_icon glyphicon glyphicon-map-marker"></i> </span></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">Contraseña
                            <div class="input-group"><input type="password" name="password" id="password_fake"
                                                            class="hidden" autocomplete="off" style="display: none;">
                                <input autocomplete="off" class="form-control h40" value="" type="password"
                                       placeholder="Contraseña" name="password" required=""> <span
                                        class="input-group-addon"> <i class="login_icon glyphicon glyphicon-lock"></i> </span>
                            </div>
                        </div>
                        <div class="col-md-6">Confirmar Contraseña
                            <div class="input-group"><input class="form-control h40" value="" type="password"
                                                            placeholder="Confirmar Contraseña" name="password2"
                                                            required=""> <span class="input-group-addon"> <i
                                            class="login_icon glyphicon glyphicon-lock"></i> </span></div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="guardar" class="btn update_btn form-control ">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>