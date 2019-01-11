<?php

namespace Clases;

class TemplateSite
{

    public $title;
    public $keywords;
    public $description;
    public $favicon;
    public $canonical;
    public $autor;
    public $made;
    public $copy;
    public $pais;
    public $place;
    public $position;
    public $imagen;

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
        <!-- Author Meta -->
        <meta name="author" content="CodePixar">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title>Karma Shop</title>
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/linearicons.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/themify-icons.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/nice-select.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/nouislider.min.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/ion.rangeSlider.css" />
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/ion.rangeSlider.skinFlat.css" />
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/magnific-popup.css">
        <link rel="stylesheet" href="<?= URL; ?>/assets/css/main.css">
  <?php include ("assets/inc/nav.inc.php");?>
    </head>
        <?php
    }

    public function themeNav()
    {
        include 'assets/inc/nav.inc.php';
    }

    public function themeSideIndex()
    {
        include 'assets/inc/sideIndex.inc.php';
    }

    public function themeSideBlog()
    {
        include 'assets/inc/sideBlog.inc.php';
    }

    public function themeEnd()
    {
        include 'assets/inc/footer.inc.php';
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
