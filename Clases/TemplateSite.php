<?php

namespace Clases;

class TemplateSite
{

    public $title;
    public $keywords;
    public $description;
    public $favicon;
    // public $canonical;
    // public $autor;
    // public $made;
    // public $copy;
    // public $pais;
    // public $place;
    // public $position;
    public $imagen;

    private $canonical = CANONICAL;
    private $autor     = TITULO;
    private $made      = EMAIL;
    private $pais      = 'Argentina';
    private $place     = PROVINCIA;
    private $position  = CIUDAD;
    private $copy      = TITULO;

    public function themeInit()
    {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <!-- Mobile Specific Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Favicon-->
            <link rel="shortcut icon" href="<?= URL; ?>/assets/img/fav.png">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/linearicons.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/font-awesome.min.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/themify-icons.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/bootstrap.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/owl.carousel.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/nouislider.min.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/ion.rangeSlider.css" />
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/ion.rangeSlider.skinFlat.css" />
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/magnific-popup.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/main.css">
            <link rel="stylesheet" href="<?= URL; ?>/assets/css/nice-select.css">
            <!-- Begin Inspectlet Asynchronous Code -->
            <script type="text/javascript">
                (function() {
                    window.__insp = window.__insp || [];
                    __insp.push(['wid', 1732562160]);
                    var ldinsp = function(){
                        if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=1732562160&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
                    setTimeout(ldinsp, 0);
                })();
            </script>
            <!-- End Inspectlet Asynchronous Code -->
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134158323-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-134158323-1');
            </script>

            <?php
            echo '<meta charset="utf-8"/>';
            echo '<meta name="author" lang="es" content="' . $this->autor . '" />';
            echo '<link rel="author" href="' . $this->made . '" rel="nofollow" />';
            echo '<meta name="copyright" content="' . $this->copy . '" />';
            echo '<link rel="canonical" href="' . $this->canonical . '" />';
            echo '<meta name="distribution" content="global" />';
            echo '<meta name="robots" content="all" />';
            echo '<meta name="rating" content="general" />';
            echo '<meta name="content-language" content="es-ar" />';
            echo '<meta name="DC.identifier" content="' . $this->canonical . '" />';
            echo '<meta name="DC.format" content="text/html" />';
            echo '<meta name="DC.coverage" content="' . $this->pais . '" />';
            echo '<meta name="DC.language" content="es-ar" />';
            echo '<meta http-equiv="window-target" content="_top" />';
            echo '<meta name="robots" content="all" />';
            echo '<meta http-equiv="content-language" content="es-ES" />';
            echo '<meta name="google" content="notranslate" />';
            echo '<meta name="geo.region" content="AR-X" />';
            echo '<meta name="geo.placename" content="' . $this->place . '" />';
            echo '<meta name="geo.position" content="' . $this->position . '" />';
            echo '<meta name="ICBM" content="' . $this->position . '" />';
            echo '<meta content="public" name="Pragma" />';
            echo '<meta http-equiv="pragma" content="public" />';
            echo '<meta http-equiv="cache-control" content="public" />';
            echo '<meta property="og:url" content="' . $this->canonical . '" />';
            echo '<meta charset="utf-8">';
            echo '<meta content="IE=edge" http-equiv="X-UA-Compatible">';
            echo '<meta content="width=device-width, initial-scale=1" name="viewport">';
            echo '<meta name="language" content="Spanish">';
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />';
            echo '<title>' . $this->title . '</title>';
            echo '<meta http-equiv="title" content="' . $this->title . '" />';
            echo '<meta name="description" lang=es content="' . $this->description . '" />';
            echo '<meta name="keywords" lang=es content="' . $this->keywords . '" />';
            echo '<link href="' . $this->favicon . '" rel="Shortcut Icon" />';
            echo '<meta name="DC.title" content="' . $this->title . '" />';
            echo '<meta name="DC.subject" content="' . $this->description . '" />';
            echo '<meta name="DC.description" content="' . $this->description . '" />';
            echo '<meta property="og:title" content="' . $this->title . '" />';
            echo '<meta property="og:description" content="' . $this->description . '" />';
            echo '<meta property="og:image" content="' . $this->imagen . '" />';

            ?>
        </head>
    <body>
        <?php
    }
    public function themeNav()
    {
        include("assets/inc/nav.inc.php");
    }

    public function themeSideIndex()
    {
        include 'assets/inc/sideIndex.inc.php';
    }

    public function themeSideBlog()
    {
        include 'assets/inc/side/side.inc.php';
    }

    public function themeEnd()
    {
        include 'assets/inc/footer.inc.php';
        echo '</body></html>';
    }

    public function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function get($atributo)
    {
        return $this->$atributo;
    }
}
