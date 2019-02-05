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
        <?php include("assets/inc/header.inc.php"); ?>
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
