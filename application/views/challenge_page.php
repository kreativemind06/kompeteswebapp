<?php
	$timestampStart = strtotime($chanllengex->challenge_start_date);
	$formattedStartDate = date('F d', $timestampStart);
	//vote end
	$timestampClose = strtotime($chanllengex->challenge_close_date);
	$formattedCloseDate = date('F d, Y', $timestampClose);
	//voting starting date
	$d1=strtotime($chanllengex->challenge_start_date);
	$d2=ceil(($d1-time())/60/60/24);
	//entry submission end date
	$s1=strtotime($chanllengex->challenge_close_date);
	$s2=ceil(($s1-time())/60/60/24);
?>
<section class="content" style="margin-top: 55px">
	<style type="text/css">
	.contest-bg{
	background: linear-gradient(60deg, rgba(100,0,0,0.5), rgba(0,0,70,.3)), url("<?php echo base_url('uploads/challenges/'.$chanllengex->challenge_banner)?>");
	background-attachment: fixed;
	min-height: 400px;
	background-position: center;
	background-size: cover;
	padding-top: 40px;
	font-family: 'Ubuntu', sans-serif;
	}
	.contest-foot{
	background: linear-gradient(60deg, rgba(100,0,0,0.5), rgba(0,0,70,.3)), url("<?php echo base_url('uploads/challenges/'.$chanllengex->challenge_banner)?>");
	min-height: 300px;
	background-position: center;
	background-size: cover;
	padding-top: 40px;
	font-family: 'Ubuntu', sans-serif;
	}
	</style>
	<div class="contest-bg" style="">
		<div class="container-fluid">
			<h1 class="text-center" style="color: #fff; font-family: sans-serif;font-weight: 700;"> <?php echo $chanllengex->challenge_name?><br></h1>
			<h5 class="text-center text-white"><?php echo $chanllengex->description ?></h5>
		</div>
		<div class="text-center">
			<?php
			//$contestStart = strtotime($contest->contest_start_date);
			//$currentDate = strtotime(date('Y-m-d'));
			//$contestClose = strtotime($contest->contest_close_date);
			if($d2 >0 && isset($_SESSION['userLogginID'])){?>
			<a href="#" data-toggle="modal" data-target="#myModal" class="btn bg-red text-white btn-lg no-border-radius">
				Enter Now
			</a>
			<?php }elseif(!isset($_SESSION['userLogginID']) && $d2 > 0){?>
			<a href="<?php echo base_url('login?redirect=challenges/check/'.$chanllengex->challenge_id)?>" class="btn btn- bg-black text-white btn-lg no-border-radius">
				Login to Enter this contest
			</a>
			<?php }?>
			<?php if($d2 < 0 and $s2 > 0 || $chanllengex->status =='1'){?>
			<a href="<?php echo base_url('vote/info/'.$chanllengex->challenge_id)?>" class="btn btn- bg-red btn-lg text-white no-border-radius">
				Click to Vote
			</a>
			<?php } elseif($s2 < 0 && $d2 < 0 || $chanllengex->status =='2'){?>
			<a class="btn btn-danger btn-lg no-border-radius">
				Contest Closed
			</a>
			<?php }?>
		</div>
	</div>
	<div class="contest-bg-social">
		<div class="container">
			<div class="col-sm-6 col-xs-5" style="margin-left: -20px">
				<ul>
					<li style="margin-left: 0;width: 2px"><a href=""> <i class="fa fa-facebook"></i> </a> </li>
					<li style="margin-left: 0;width: 2px"><a href=""> <i class="fa fa-twitter"></i> </a> </li>
					<li ><a href=""> <i class="fa fa-google-plus"></i> </a> </li>
					<li class="hidden-xs"><a href=""> <i class="fa fa-instagram"></i> </a> </li>
					<li class="hidden-xs"><a href=""> <i class="fa fa-pinterest"></i> </a> </li>
				</ul>
			</div>
			<div class="col-sm-6 col-xs-7">
				<ul class="">
					<li style="" class="pull-right"><a href="<?php echo base_url('challenges/entries/'.$chanllengex->challenge_id)?>"> Entries </a> </li>
					<li style="" class="pull-right"><a href="#rules"> Rules &ensp; </a></li>
					<li style="" class="pull-right active-bottom hidden-xs"><a href=""> Details </a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="margin-bottom: 30px;margin-top: 20px; padding: 0">
		<div class="col-sm-12" style="margin: 0;">
			<div class="contest-grid-price contest-price-row no-border-radius" style="background: #f00">
				<div class="contest-pics" style="">
					<img src="<?php echo base_url('img/badges/png256/'.$banner)?>" width="100%" class="img-circle">
				</div>
				<div class="contest-price text-center text-white">
					<h3 class="text-center text-white">Grand Winner </h3>
					<ul>
						<li>Contest Winner</li>
						<li><?php echo $chanllengex->winner_selection ?> Reward Credits</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-12" style="margin: 0;">
			<div class="contest-grid-price contest-price-row  no-border-radius text-white" style="background: #ff450f">
				<div class="contest-pics">
					<img src="<?php echo base_url('img/badges/png256/'.$choiceBanner)?>" width="100%" class="img-circle">
				</div>
				<div class="contest-price text-center">
					<h3 class="text-center text-white">People's Choice </h3>
					<ul>
						<li>Contest Winner</li>
						<li><?php echo $chanllengex->people_choice ?> Reward Credits</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php
	//get the users picture
	$user_upload_id = $chanllengex->user_id;
	$this->db->where("user_id='$user_upload_id'");
	$getUserPic = $this->db->get("userz")->result();
	foreach($getUserPic as $userPic)
	?>
	<div class="contest-owner" style="min-height: 300px;background: #fff; padding-top: 40px">
		<div class="container">
			<div class="contest-owner-pic text-center">
				<img src="<?php if(!empty($userPic->picture)){echo base_url("users_photo/".$userPic->picture);}else{ echo base_url("users_photo/avatar.png");}?>" width="250" height="250" class="img-circle img-thumbnail">
			</div>
			<div>
				<h2 class="text-center"><?php echo $userPic->username?> </h2>
				<p class="text-center"><?php echo $userPic->about ?>  </p>
			</div>
			<h2 class="text-center" id="rules" style="margin-bottom: 30px">How Kompetes Contest Works</h2>
			<div class="row" id="" style="padding-top: 30px;">
				<div class="col-sm-7 col-sm-offset-3" style="padding: 0">
					<div class="contest-Hwork">
						<?php
						$timestampStart = strtotime($chanllengex->challenge_start_date);
						$formattedStartDate = date('F d', $timestampStart);
						//vote end
						$timestampClose = strtotime($chanllengex->challenge_close_date);
						$formattedCloseDate = date('F d, Y', $timestampClose);
						//remaining date
						$d1=strtotime($chanllengex->challenge_start_date);
						$d2=ceil(($d1-time())/60/60/24);
						?>
						<ul>
							<li>
								<i class="fa fa-clock-o fa-3x text-black"></i>
								<span><?php if($d2 >=0){ echo $d2 .' days left';} else{ echo 'CLOSED';} ?> | Vote from <?php echo $formattedStartDate;?> until <?php echo $formattedCloseDate;?> </span>
							</li>
							<li>
								<i class="fa fa-picture-o fa-3x text-black"></i>
								<span><?php echo $countEntries; ?> submissions | Vote from <?php echo $formattedStartDate;?> until <?php echo $formattedCloseDate;?></span>
							</li>
							<li>
								<i class="fa fa-heart-o fa-3x text-black"></i>
								<span>Judged based on creativity, originality and in accordance to the theme</span>
							</li>
							<!-- <li>
								<i class="fa fa-tag fa-3x"></i>
								<span>Entry fee: Free for Premium and Pro members</span>
							</li>-->
							<!--<li hidden>
								<img src="https://use.fontawesome.com/releases/v5.0.13/svgs/solid/pound-sign.svg" style="width: 2em;" class="pull-left m-r-40">
								<span>Entry fee: <?php /*//if($contest->entry_price=='Free'){echo 'Free';}else{echo $contest->entry_price.' Points ';} */?> for Premium and Pro members</span>
							</li>-->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="contest-foot">
		<div class="container-fluid text-white text-center">
			<h4 class="text-center text-white">About <?php echo $chanllengex->challenge_name ?></h4>
			<p class="text-center text-white" style="font-size: 20px"> <?php echo $chanllengex->description ?></p>
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
<!-- modal for submitting photo -->
<div id="myModal" class="modal fade no-padding-xs" role="dialog">
	<div class="modal-dialog no-border-radius m-0" style="width: 100% !important;">
		<!-- Modal content-->
		<div class="modal-content no-border-radius p-t-20 no-margin-xs" style="height: 575px">
			<div class="text-right m-b-30 p-r-10" >
				<a class="" data-dismiss="modal">X</a>
			</div>
			<div class="p-l-20" style="margin-top: -40px">
				<p>Click the photo(s) you'd like to submit or <a href="<?php echo base_url('upload')?>" class="btn btn-xs bg-red text-white">Upload</a> </p>
			</div>
			<div class="p-l-2-" style="min-height: 50px;background: #d5d5d5"></div>
			<?php echo form_open_multipart('challenges/submit_entry/'.$this->uri->segment(3))?>
			<div class="p-20 ">
				<?php
				if(isset($_SESSION['userLogginID'])){
				$userID = $_SESSION['userLogginID'];
				$this->db->where("user_id='$userID'");
				$countPhoto = $this->db->count_all_results('uploads');
				}
				else{
				$countPhoto =0;
				}
				if($countPhoto >=1){
				$this->db->where("user_id='$userID'");
				$getUploadPicture = $this->db->get("uploads")->result_array();
				$sn = 1; $sn2 = 1;
				foreach($getUploadPicture as $getPhotoz):
				?>
				<div class="submit-photo">
					<input type="radio" name="photo" value="<?php echo $getPhotoz['picture_id']?>" id="cb<?php echo $sn++; ?>" />
					<label for="cb<?php echo $sn2++; ?>"><img src="<?php echo base_url('uploads/small_thumb/'.$getPhotoz['picture_small_name'])?>" /></label>
				</div>
				<?php
				endforeach;
				}
				elseif($countPhoto <=0){ ?>
				<h6 class="text-center">No picture uploaded by you yet</h6>
				<?php }elseif(!isset($_SESSION['userLogginID'])){ ?>
				<h6 class="text-center">Please loggin</h6>
				<?php } ?>
			</div>
			<nav class="navbar navbar-default navbar-fixed-bottom voteBottomView" style="background: #fff">
				<div class="container-fluid">
					<div id="MobileHMenuStick" style="background: #fff">
						<div class="m-b-10 p-l-20" style="">
							<div class="pull-left">
								<div class="">
									<input type="hidden" name="entry_type" value="challenge">
									<input type="submit" value="Submit" class="btn bg-black text-white btn-sm no-border-radius">Submit</input>
									By entering this challenge you accept Kompetes's Terms of Use
								</div>
							</div>
						</div>
					</div>
				</div>
			</nav>
			<?php echo form_close();?>
		</div>
	</div>
</div>
<!-- End modal for submitting photo -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
</body>
</html>