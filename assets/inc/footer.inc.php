<footer class="footer-area section_gap mt-50">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="single-footer-widget">
                    <h6>Sobre Nosotros</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
                        magna aliqua.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-footer-widget">
                    <h6>Seguinos en nuestras redes sociales</h6>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> <i aria-hidden="true"></i> by <a href="http://www.estudiorochayasoc.com/" target="_blank">Estudio Rocha y Asociados</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </div>
</footer>
<!-- End footer Area -->

<script src="<?= URL; ?>/assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="<?= URL; ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?= URL; ?>/assets/js/jquery.ajaxchimp.min.js"></script>
<script src="<?= URL; ?>/assets/js/jquery.nice-select.min.js"></script>
<script src="<?= URL; ?>/assets/js/jquery.sticky.js"></script>
<script src="<?= URL; ?>/assets/js/nouislider.min.js"></script>
<script src="<?= URL; ?>/assets/js/countdown.js"></script>
<script src="<?= URL; ?>/assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?= URL; ?>/assets/js/owl.carousel.min.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="<?= URL; ?>/assets/js/gmaps.min.js"></script>
<script src="<?= URL; ?>/assets/js/main.js"></script>
<script>
    $("#provincia").change(function () {
        $("#provincia option:selected").each(function () {
            elegido = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?=URL ?>/assets/inc/localidades.inc.php",
                data: "elegido=" + elegido,
                dataType: "html",
                success: function (data) {
                    $('#localidad option').remove();
                    var substr = data.split(';');
                    for (var i = 0; i < substr.length; i++) {
                        var value = substr[i];
                        $("#localidad").append(
                            $("<option></option>").attr("value", value).text(value)
                        );
                    }
                }
            });
        });
    })
</script>
<?php include 'assets/inc/login.inc.php'; ?>