<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/iqra/contests.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/iqra/photos.css')?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>css/masonry.css"/>
<style>
/*@media only screen and (max-width: 650px){
.col-xs-6{width: 49.5% !important;}
}
@media (min-width: 768px) {.col-sm-4{width: 30.8% !important;}
}*/
.photos-section{margin-top: 30px;padding: 0;}
.margin-top-50{margin-top: 50px;}
.photos-container{min-height: 550px; padding: 0px;}
</style>
<section class="content photos-section">
	<div class="p-t-0 m-b-15">
		<div class="contest-cat-line margin-top-50">
			<div class="col-sm-8 col-sm-offset-2">
				<ul>
					<li class="label bg-black"><a href="<?php echo base_url('photos/cat/art')?>">Art</a></li>
					<li class="label bg-black"><a href="<?php echo base_url('photos/cat/photography')?>">Photography</a></li>
					<!-- <li class="label label-danger"><a href="<?php /*echo base_url('photos')*/?>"> Explore All</a> </li>
					<li class="label label-warning"><a href="<?php /*echo base_url('video')*/?>"> Video </a> </li>
					<li class="label bg-aqua-gradient hidden-xs"><a href="<?php /*echo base_url('photos/cat/action')*/?>"> Action </a> </li>
					<li class="label bg-purple hidden-xs"><a href="<?php /*echo base_url('photos/cat/winner')*/?>"> Winner </a> </li>
					<li class="label bg-teal-gradient hidden-xs"><a href="<?php /*echo base_url('photos/cat/city')*/?>"> City </a> </li>
					
					<li class="label label-primary pull-right dropdown" style="margin-right: -10px"><a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Categories ▾ </a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="width: 300px;height: 400px">
							<div class="row">
								<div class="dropLinks">
									<ul class="" style="color: #000;">
										<?php /*foreach($getCategory as $cat):*/?>
										<li><a href="<?php /*echo base_url('photos/cat/').$cat['category_name']*/?>" class=""><?php /*echo $cat['category_name']*/?></a></li>
										<?php /*endforeach*/?>
									</ul>
								</div>
							</div>
						</ul> 
					</li> -->
				</ul>
			</div>
		</div>
	</div>
<div class="container-fluid photos-container">
	<div id="photo_wrapper" class="photo_wrapper">
		<?php foreach($getPhotos as $photos):?>
		<article class="photo_row">
			<div class="show-image">
				<a href="<?php echo base_url('photos/check/'.$photos['picture_id'])?>">
					<img src="<?php echo base_url('uploads/'.$photos['picture_name'])?>">
				</a>
				<div>
					<?php
					require_once('template/user_ip.php');
					$userIP = get_client_ip();
					//count all likes
					$this->db->where("upload_id", $photos['picture_id']);
					$countLike = $this->db->count_all_results('upload_like');
					$photoIDx = $photos['picture_id'];
					//check if a particular user already like
					$this->db->where("like_ip = '$userIP' AND upload_id ='$photoIDx'");
					$countUserLike =$this->db->count_all_results("upload_like");
					?>
					<?php if($countUserLike <=0){?>
					<label class="award likex label bg-black" id="likex_<?php echo $photos['picture_id'] ?>" onclick="onClick()">
						<a href="javascript: void(0)" class="text-white" id="likex_<?php echo $photos['picture_id'] ?>" rel="<?php echo $photos['picture_id'] ?>"> <i class="fa fa-thumbs-up"></i></a>
						<div id="result" class="showResult2">
							<?php echo $countLike ?>
						</div>
					</label>
					<?php }else{?>
					<label class="award likex label bg-black" id="likex_<?php echo $photos['picture_id'] ?>" onclick="onClick()">
						<a href="javascript: void(0)" class="text-white" id="likex_<?php echo $photos['picture_id'] ?>" rel="<?php echo $photos['picture_id'] ?>"> <i class="fa fa-thumbs-down text-red"></i></a>
						<div id="result" class="showResult2">
							<?php echo $countLike ?>
						</div>
					</label>
					<?php } ?>
					<?php if(isset($this->session->userLogginID)):?>
					<label id="fav_<?php echo $photos['picture_id'] ?>" class="fav fav_bg star label bg-black">
						<a href="javascript: void(0)" class="text-white " id="fav__<?php echo $photos['picture_id'] ?>" rel="<?php echo $photos['picture_id'] ?>">
							<i class="fa fa-star"></i>
						</a>
					</label>
					<?php endif ?>
				</div>
			</div>
		</article>
		<?php endforeach ?>
		<?php if($countPhoto <=0):?>
		<h6 class="text-center">No Photo Uploaded for this category yet</h6>
		<?php endif?>
		<div class="clearfix"></div>
	</div>
</div>
</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script type="text/javascript" src="<?php echo base_url()?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.livequery.js"></script>
<script src="<?php echo  base_url()?>js/jquery.masonry.js"></script>
	<script type="text/javascript">
		$(function(){
		var $container = $('#photo_wrapper');
		$container.imagesLoaded( function(){
		$container.masonry({
		itemSelector : '.photo_row'
		});
		});
		});
	
		$(document).ready(function() {
		$('.likex > a').livequery("click",function(e){
		var parent  = $(this).parent();
		var getID   =  parent.attr('id').replace('likex_','');
		//$.post("<?php echo base_url()?>follow/following/"+getID, {
		$.post("<?php echo base_url()?>ajax_link/like/"+getID, {
		}, function(response){
		$('#likex_'+getID).html($(response).fadeIn('slow'));
		});
		});
		$('.fav > a').livequery("click",function(e){
		var parent  = $(this).parent();
		var getID   =  parent.attr('id').replace('fav_','');
		//$.post("<?php echo base_url()?>follow/following/"+getID, {
		$.post("<?php echo base_url()?>ajax_link/fav/"+getID, {
		}, function(response){
		$('#fav_'+getID).html($(response).fadeIn('slow'));
		});
		});
		});
	
		//var getLikes = document.getElementById("result").textContent;
		var clicks = 0;
		function onClick() {
		var getLikes = document.getElementById("result").textContent;
		var clicks = Number(getLikes);
		//var clicks = document.getElementById("clicks").textContent;
		clicks += 1;
		document.getElementById("result").innerHTML = clicks;
		document.getElementsByClassName("likex").style.background = "#f00";
		}
	</script>
</body>
</html>