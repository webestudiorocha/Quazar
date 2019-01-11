<?php
require_once "Config/Autoload.php";
Config\Autoload::runSitio();
$template = new Clases\TemplateSite();
$funciones = new Clases\PublicFunction();
$template->set("title", "Quazar | Inicio");
$template->set("description", "");
$template->set("keywords", "");
$template->set("favicon", LOGO);
$template->themeInit()
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Blog</h1>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-3.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Social Life</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Enjoy your social life together</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-2.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Politics</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Be a part of politics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-1.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Food</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Let the food be finished</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->

<!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <article class="row blog_item">
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <a href="#">Food,</a>
                                    <a class="active" href="#">Technology,</a>
                                    <a href="#">Politics,</a>
                                    <a href="#">Lifestyle</a>
                                </div>
                                <ul class="blog_meta list">
                                    <li><a href="#">Mark wiens<i class="lnr lnr-user"></i></a></li>
                                    <li><a href="#">12 Dec, 2018<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="#">1.2M Views<i class="lnr lnr-eye"></i></a></li>
                                    <li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="blog_post">
                                <img src="img/blog/main-blog/m-blog-1.jpg" alt="">
                                <div class="blog_details">
                                    <a href="single-blog.html">
                                        <h2>Astronomy Binoculars A Great Alternative</h2>
                                    </a>
                                    <p>MCSE boot camps have its supporters and its detractors. Some people do not
                                        understand why you should have to spend money on boot camp when you can get
                                        the MCSE study materials yourself at a fraction.</p>
                                    <a href="single-blog.html" class="white_bg_btn">View More</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">
                                            <span class="lnr lnr-chevron-left"></span>
                                        </span>
                                </a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">01</a></li>
                            <li class="page-item active"><a href="#" class="page-link">02</a></li>
                            <li class="page-item"><a href="#" class="page-link">03</a></li>
                            <li class="page-item"><a href="#" class="page-link">04</a></li>
                            <li class="page-item"><a href="#" class="page-link">09</a></li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">
                                            <span class="lnr lnr-chevron-right"></span>
                                        </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================Blog Area =================-->
<?php $template->themeEnd(); ?>