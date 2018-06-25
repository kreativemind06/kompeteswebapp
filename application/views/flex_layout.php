<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>..:: Friendship Contest - Kompetes ::..</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/bootstrap_3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/kompetes.css">

    <link rel="stylesheet" type="text/css" href="css/owwlyz.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/masonry.css"/>
    <style type="text/css">
        .grid {
            max-width: 1200px;
        }

        /* reveal grid after images loaded */
        .grid.are-images-unloaded {
            opacity: 0;
        }

        .grid__item,
        .grid__col-sizer {
            width: 32.0%;

        }

        .grid__gutter-sizer { width: 2%; }

        /* hide by default */
        .grid.are-images-unloaded .image-grid__item {
            opacity: 0;
        }

        .grid__item {
            margin-bottom: 20px;
            float: left;
        }

        .grid__item--height1 { height: 140px; background: #EA0; }
        .grid__item--height2 { height: 220px; background: #C25; }
        .grid__item--height3 { height: 300px; background: #19F; }

        .grid__item--width2 { width: 66%; }

        .grid__item img {
            display: block;
            max-width: 100%;
        }


        .page-load-status {
            display: none; /* hidden by default */
            padding-top: 20px;
            border-top: 1px solid #DDD;
            text-align: center;
            color: #777;
        }

        /* loader ellips in separate pen CSS */

    </style>
    <link rel="stylesheet" type="text/css" media="screen" href="css/owwlyz.css"/>

    <link rel="icon" href="img/ico.png">

</head>
<body>



<nav class="navbar navbar-black navbar-offcanvas">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="margin-right: -20px">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="index.html">
                <span style="float: right" class="siteName" style="margin-right: 20px;">&ensp; Kompetes</span>
                <img src="img/logo2.png" width="35" style="margin-top: -5px;">
            </a>


            <div class="visible-xs mobile-header">
                <ul>
                    <li style="background: none"><a href="login.html">Login</a></li>
                    <li style="margin-right: 0"><a href="register.html">Register</a></li>
                </ul>

            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.html">Login</a></li>
                <li class="dropdown signUpBg">
                    <a href="register.html">Signup</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="contests.html">Contests</a></li>
                <li><a href="photos.html">Photos</a></li>
                <li><a href="videos.html">Videos</a></li>
                <li><a href="votes.html">Votes</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<section class="content" style="margin-top: -15px;padding: 0;">
    <style>

        @media only screen and (max-width: 650px){
            .col-xs-6{
                width: 49.5% !important;
            }

        }

        @media (min-width: 768px) {
            .col-sm-4{
                width: 30.8% !important;
            }
        }

    </style>


    <div class="container-fluid" style="min-height: 550px; padding: 0;">

        <div id="photo_wrapper" class="photo_wrapper">
            <div class="grid__col-sizer"></div>
            <div class="grid__gutter-sizer"></div>
            <div class="photo_row">
                <div class="">
                    <img src="photo/70402170_widepreview400.jpg" width="400" class="img-responsive">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/70592508_widepreview400.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/60722357_large1300.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/45105561_widepreview400.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/62491531_widepreview400.jpg">
                </div>
            </div>


            <div class="photo_row">
                <div class="">
                    <img src="photo/recover.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/70402170_widepreview400.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/62491531_widepreview400.jpg">
                </div>
            </div>



            <div class="photo_row">
                <div class="">
                    <img src="photo/baby.jpg">
                </div>
            </div>


            <div class="photo_row">
                <div class="">
                    <img src="photo/baby_1.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/food_2.jpg">
                </div>
            </div>

            <div class="photo_row">
                <div class="">
                    <img src="photo/71223401_large1300.jpg">
                </div>
            </div>


            <div class="photo_row">
                <div class="">
                    <img src="photo/action.jpg">
                </div>
            </div>



            <div class="photo_row">
                <div class="">
                    <img src="photo/war.jpg">
                </div>
            </div>






            <div class="clearfix"></div>

        </div>




    </div>

    <!-- begins from here -->

    <div class="footer">
        <div class="container">
            <div class="col-sm-12">

                <ul class="float-left inl">
                    <li><a href="<?php echo base_url('pages/about')?>">About Us</a></li>
                    <li style="width: 120px"><a href="<?php echo base_url('pages/sponsor_contest')?>">Sponsor Contest</a></li>

                    <li><a href="<?php echo base_url('pages/privacy')?>">Privacy</a></li>
                    <li><a href="<?php echo base_url('pages/terms')?>">Terms</a></li>
                    <li><a href="<?php echo base_url('pages/support')?>">Support</a></li>
                    <li style="max-width: 20px !important; margin-right: -35px;padding-left: 0"><a href="https://www.facebook.com/kompetes" target="_new"> <i class="fa fa-facebook m-r-5 m-l-5"></i></a></li>
                    <li style="max-width: 20px !important;margin-right: -35px;padding-left: 0"><a href="https://twitter.com/kompetes" target="_new"><i class="fa fa-twitter m-r-5 m-l-5"></i></a></li>
                    <li style="width: 20px;margin-right: -35px;"><a href="https://www.instagram.com/kompetes" target="_new"><i class="fa fa-instagram m-r-5 m-l-5"></i></a></li>
                    <li style="width: 40px;margin-right: -35px;"><a href="https://www.pinterest.co.uk/artknews" target="_new"><i class="fa fa-pinterest-p m-r-5 m-l-5"></i></a></li>
                    <li style=""><a href="https://www.artknews.co.uk/" target="_new">Artknews Magazine</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

<script src='https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js'></script>
<script src='https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js'></script>
<!--<script src="js/jquery.masonry.js"></script>-->
<script  src="js/index.js"></script>
</body>
</html>