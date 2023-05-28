<!DOCTYPE html>
<html lang="en">


<head>
    <title>ESESSENS - Handcrafted Fragrances</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include('include/css.php'); ?>
</head>
<body class="home">
<!--including header-->
<?php include('include/header.php'); ?>

<!--mobile menu section-->
<?php include('include/mobile_menu.php'); ?>

<!--main body content-->
<div class="">
    <div class="fullwidth-template">
        <!--main body content-->
        <div class="container">
            <div class="row">
                <div class="content-area content-404 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="site-main">
                        <section class="error-404 not-found">
                            <div class="images">
                                <img src="assets/images/404.png" alt="img">
                            </div>
                            <div class="text-404">
                                <h1 class="page-title">
                                    Error 404 Not Found
                                </h1>
                                <p class="page-content">
                                    We´re sorry but the page you are looking for does nor exist. <br/>
                                    You could return to
                                    <a href="index-2.html" class="hightlight"> Home page</a>
                                    or using
                                    <span class="hightlight toggle-hightlight">
										 search!
									</span>
                                </p>
                                <form role="search" method="get" class="search-form">
                                    <input type="search" class="search-field" placeholder="Your search here…">
                                    <button>Search</button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--footer area included-->
<?php include('include/footer.php'); ?>


<!--mobile footer include-->
<?php include ('include/mobile_footer.php');?>


<a href="#" class="backtotop">
    <i class="fa fa-angle-double-up"></i>
</a>


<?php include ('include/js.php');?>
</body>

</html>