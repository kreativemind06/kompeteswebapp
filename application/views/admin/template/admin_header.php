
<!DOCTYPE html>
<html lang="en">
<!--
<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Kompetes Admin Board</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="<?php echo base_url() ?>adminassets/css/admin_main.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('css/kompetes.css') ?>" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>/img/ico.png" />

</head>
<body>

<header class="th_header">
    <nav class="th_menu">
        <div class="menu_toggle"><span></span><span></span><span></span></div>
        <div class="th_menu_container">
            <ul>
                <li><a href="<?php echo base_url('admin/home') ?>">Dashboard</a></li>
                <li><a href="<?php echo base_url('admin/users/0') ?>">Users</a></li>
                <li><a href="<?php echo base_url('admin/contests') ?>">Contests</a></li>
                <li><a href="<?php echo base_url('admin/challenges') ?>">Challenges</a></li>
                <li><a href="<?php echo base_url('admin/photos') ?>">Photos</a></li>
                <li><a href="<?php echo base_url('admin/videos') ?>">Videos</a></li>
                <li><a href="<?php echo base_url('admin/vote') ?>">Votes</a></li>
                <li><a href="">Upload</a>
                    <ul>
                        <li><a href="<?php echo base_url('admin/contest_upload') ?>">Upload Contest</a></li>
                        <li><a href="<?php echo base_url('upload')?>">Photos Upload</a></li>
                        <li><a href="<?php //echo base_url('admin/video_upload') ?>">Videos Upload</a></li>

                    </ul>
                </li>

                <li><a href="">Transactions</a>
                    <ul>
                        <li><a href="<?php echo base_url('admin/transactions') ?>">Payment Transactions</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo base_url('admin/credit')?>">Credit Management</a></li>
                <li><a href="<?php echo base_url('user/home')?>">Switch to User Account</a></li>

                <li><a href="<?php echo base_url() ?>authentication/logout">Logout</a></li>

            </ul>
        </div>
    </nav>
</header>


<div class="">

    <!-- top header section -->
    <div class="th_top_header">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-10 logo_section">

                <img src="<?php echo base_url() ?>img/logo2.png" width="30">
                <b class="" style="color: #FFF;">Kompetes</b>
            </div>



            <div class="col-sm-8 hidden-xs">
                <div class="th_user_login">
                    <div class="user_login_detail">
                        <h5 class="user_name" style="color: #FFF;margin-top: -10px"><a>Hi,<span style="color: #FFF;"> Admin</span></a> </h5>
                        <div class="th_user_profile">
                            <ul>
                                <li><a data-toggle="modal" data-target="#changepassword"><i class="fa fa-key" aria-hidden="true"></i>Password</a></li>
                                <li><a href="<?php echo base_url() ?>authentication/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>