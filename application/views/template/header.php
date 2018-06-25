<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $title ?> | Kompetes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/font-awesome/css/fontawesome.css")?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap_3.css")?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/animate.css")?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/kompetes.css")?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>css/masonry.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/iqra/templates.css')?>">
		<link rel="icon" href="<?php echo base_url()?>img/ico.png">
		<style>
		.nav > li > .no-hover:hover {
		border: none !important;
		}
		.nav > li > .no-hover:focus {
		background: none !important;
		}
		</style>
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="400">
		<nav class="navbar navbar-black navbar-offcanvas navbar-offcanvas navbar-fixed-top navbar-border">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="toggleBtn navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url()?>">
						<span class="siteName">&ensp;Kompetes</span>
						<img class="mobileLogo" src="<?php echo base_url()?>img/logo2.png" width="35">
					</a>
					<?php if(!isset($this->session->userLogginID)){?>
					<div class="visible-xs mobile-header">
						<ul>
							<li class="no-bg"><a href="<?php echo base_url()?>login">Login</a></li>
							<li><a href="<?php echo base_url()?>register">Register</a></li>
						</ul>
					</div>
					<?php }else{?>
					<div class="visible-xs mobile-header">
						<ul>
							<li class="no-bg">
								<a href="#" class="text-center" data-toggle="modal" data-target="#mobileSearch">
									<i class="fa fa-search text-center"></i>
								</a>
							</li>
							<li class="dropdown no-bg">
								<a class="dropdown-toggle text-center no-hover" data-toggle="dropdown">
									<i class="fa fa-bell text-center"></i>
									<div class="notificatio_count">
										<b><?php echo $countNotification ?></b>
									</div>
								</a>
								<ul class="dropdown-menu no-border-radius notification_dropMenu">
									<div class="notification_drop">
										<ul>
											<?php if($countNotification >= 1): ?>
											<?php foreach($getNotifications as $notification):?>
											<li>
												<a class="notificationAnchor" href="<?php echo $notification['link']; ?>">
													<?php echo $notification['message']; ?>
												</a>
											</li>
											<?php endforeach ?>
											<?php endif?>
										</ul>
									</div>
								</ul>
							</li>
							<li class="dropdown no-bg">
								<a class="dropdown-toggle text-center no-hover" data-toggle="dropdown">
									<div class="userPhotoDP">
										<img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$userPhoto);}else{ echo base_url('users_photo/avatar.png');}?>">
									</div>
								</a>
								<ul class="dropdown-menu no-border-radius profile-menu">
									<div class="userDropInfo">
										<ul>
											<li class="no-bg width-100">
												<a href="<?php echo base_url('profile')?>">
													<img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$userPhoto);}else{ echo base_url('users_photo/avatar.png');}?>" width="40" height="40">
													<name>
													<?php if(!empty($userFirstName)){ echo $userFirstName. ' '. $userLastname;}else{ echo $username; }?>
													<br>
													<small class="text-center">View Profile</small>
													</name>
												</a>
											</li>
											<li class="width-100 bg bg-black"><a href="<?php echo base_url("upgrade")?>">Credit</a></li>
											<!--<li class="no-bg width-100" ><a href="#">My Stats</a></li>
											<li class="no-bg width-100"><a href="#">Inbox </a></li>-->
											<li class="no-bg width-100"><a href="<?php echo base_url('user/credit')?>">My Credits </a></li>
											<li class="no-bg width-100"><a href="<?php echo base_url('profile/update')?>">Account Settings </a></li>
											<li class="no-bg width-100"><a href="<?php echo base_url('authentication/logout')?>">Logout </a></li>
										</ul>
									</div>
								</ul>
							</li>
						</ul>
					</div>
					<?php }?>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<?php if(!isset($this->session->userLogginID)){?>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url('login')?>">Login</a></li>
						<li class="dropdown signUpBg">
							<a href="<?php echo base_url('register')?>">Sign up</a>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="<?php echo base_url()?>">Home</a></li>
						<li class="active"><a href="<?php echo base_url()?>contests">Contests</a></li>
						<li><a href="<?php echo base_url()?>image">Images</a></li>
						<!--<li hidden><a href="<?php /*echo base_url('video')*/?>">Videos</a></li>-->
						<li><a href="<?php echo base_url('vote')?>">Votes</a></li>
					</ul>
				</div>
				<?php }else{?>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="search hidden-xs">
							<input type="search" placeholder="Search">
						</li>
						<li class="dropdown hidden-xs">
							<a class="dropdown-toggle no-hover" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<div class="notificatio_count">
									<b><?php echo $countNotification ?></b>
								</div>
							</a>
							<ul class="dropdown-menu">
								<div class="notification_drop">
									<ul>
										<?php if($countNotification >= 1): ?>
										<?php foreach($getNotifications as $notification):?>
										<li>
											<a href="<?php echo $notification['link']; ?>">
												<?php echo $notification['message']; ?>
											</a>
										</li>
										<?php endforeach ?>
										<?php endif?>
									</ul>
								</div>
							</ul>
						</li>
						<li class="dropdown hidden-xs">
							<a href="" class="dropdown-toggle no-hover" data-toggle="dropdown">
								<div class="userPhotoDP">
									<img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$userPhoto);}else{ echo base_url('users_photo/avatar.png');}?>">
								</div>
							</a>
							<ul class="dropdown-menu">
								<div class="userDropInfo">
									<ul>
										<li>
											<a href="<?php echo base_url('profile')?>" style="color: #333333 !important;">
												<img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$userPhoto);}else{ echo base_url('users_photo/avatar.png');}?>" width="40" height="40">
												<name style="color: #333333 !important;">
												<?php if(!empty($userFirstName)){ echo $userFirstName. ' '. $userLastname;}else{ echo $username; }?>
												<br>
												<small>View Profile</small>
												</name>
											</a>
										</li>
										<li><a href="<?php echo base_url("upgrade") ?>" style="color: #333333 !important;">Buy Credit</a></li>
										<!--<li><a href="#" style="color: #333333 !important;">My Stats</a></li>
										<li><a href="#" style="color: #333333 !important;">Inbox </a></li>-->
										<li><a href="<?php echo base_url('user/credit')?>" style="color: #333333 !important;">My Credit </a></li>
										<li><a href="<?php echo base_url('profile/update')?>" style="color: #333333 !important;">Account Settings </a></li>
										<?php if($adminStatus == 1){?>
										<li class="bg-red text-white"><a href="<?php echo base_url('admin/home')?>" style="color: #fff !important;">Switch to Admin </a></li>
										<?php } ?>
										<li><a href="<?php echo base_url('authentication/logout')?>" style="color: #333333 !important;">Logout </a></li>
									</ul>
								</div>
							</ul>
						</li>
						<li class="dropdown hidden-xs">
							<!--                    <a><i class="fa fa-ellipsis-v"></i> </a>-->
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="<?php echo base_url('user/home')?>">Home</a></li>
						<li class="active"><a href="<?php echo base_url()?>contests">Contests</a></li>
						<li><a href="<?php echo base_url()?>image">Images</a></li>
						<li><a href="<?php echo base_url('challenges')?>">Member Contest</a></li>
						<!--<li hidden><a href="<?php /*echo base_url('video')*/?>">Videos</a></li>-->
						<li><a href="<?php echo base_url('vote')?>">Votes</a></li>
						<li class="nav-active"><a href="<?php echo base_url('upload')?>">+ Upload</a></li>
						<li><a href="<?php echo base_url("upgrade")?>"> Credit</a></li>
						<li class="visible-xs" style="min-height: 400px"></li>
					</ul>
					</div><!-- /.navbar-collapse -->
					<?php }?>
					<!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</body>
		</html>