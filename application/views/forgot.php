<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>..:: Recover Password - Kompetes ::..</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/bootstrap_3.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/kompetes.css">

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



<section class="content forgot-bg" style="margin-top: -16px">
    <div class="container-fluid" style="min-height: 570px">

        <div class="col-sm-4 col-sm-offset-4 col-xs-12 col-xs-offset-0">


            <div class="" style="margin-top: 90px">
                <div style="z-index: 10000;">
                    <h5 style="color: #fff;margin-bottom: 0px" class="">Forgot your password? No problem</h5>
                    <p class="text-center" style="color:#fff">
                        Enter the email address associated with your Kompetes account.
                    </p>
                    <form>
                        <div class="form-group">
                            <!--<label>Username</label>-->
                            <input type="email" name="email" class="container" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-lg" name="submit" style="border-radius: 0; width: 100%; background: #449D44" value="Recover Password">
                        </div>

                    </form>
                </div>
            </div>

        </div>





    </div>

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


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

<!--<script src='js/bootstrap.min.js'></script>-->
</body>
</html>
