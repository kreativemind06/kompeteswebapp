<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/iqra/contests.css')?>">
<section class="content contest-section">
	<div class="contest-section-div">
		<div class="p-t-0 m-b-15">
			<div class="contest-cat-line">
				<div class="col-sm-8 col-sm-offset-2">
					<ul>
						<li class="label bg-black"><a href="<?php echo base_url('contests')?>">Explore All</a></li>
						<li class="label bg-black"><a href="<?php echo base_url('contests/cat/art')?>">Art</a></li>
						<li class="label bg-black"><a href="<?php echo base_url('contests/cat/photography')?>">Photography</a></li>
						<li class="label bg-black"><a href="<?php //echo base_url('contests/video')?>">Video</a></li>
						<!--<li class="label label-success hidden-xs"><a href="<?php /*echo base_url('contests/cat/discover')*/?>">Discover</a></li>
						<li class="label label-warning hidden-xs"><a href="<?php /*echo base_url('contests/cat/new')*/?>">New</a></li>
						<li class="label bg-aqua-gradient hidden-xs"><a href="<?php /*echo base_url('contests/cat/action')*/?>">Action</a></li>
						<li class="label bg-purple hidden-xs"><a href="<?php /*echo base_url('winner')*/?>">Winner</a></li>
						<li class="label bg-teal-gradient hidden-xs"><a href="<?php /*echo base_url('contests/cat/city')*/?>">City</a></li>-->
						<li class="bg-black pull-right dropdown"><a href="" class="dropdown-toggle label2" data-toggle="dropdown" aria-expanded="false">Categories ▾</a>
						<ul class="dropdown-menu cat-label" role="menu" aria-labelledby="dLabel">
							<div class="row">
								<div class="dropLinks">
									<ul>
										<?php foreach($getCategory as $cat):?>
										<li><a href="<?php echo base_url('contests/cat/').$cat['category_name']?>" class="cat-btn"><?php echo $cat['category_name']?></a></li>
										<?php endforeach?>
									</ul>
								</div>
							</div>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div>
		<?php foreach($getContest as $contests):?>
		<div class="grid-contest">
			<div class="box-crop"><img src="<?php echo base_url('uploads/contests/'.$contests['contest_picture'])?>"></div>
			<a href="<?php echo base_url('contests/check/'.$contests['contest_id'])?>">
				<div class="contest-name">
					<h4 class="text-center"><?php echo $contests['contest_name']?></h4>
					<p class="text-center"><?php echo $contests['contest_grand_price']?></p>
				</div>
			</a>
		</div>
		<?php endforeach ?>
		<div class="clearfix"></div>
		<?php if($countContest<=0):?>
		<div class="text-center">
			<h6>No contest available for this category</h6>
		</div>
		<?php endif ?>
	</div>
</div>