
<?php foreach($getPhoto as $select_photo)?>

<?php
//get ownerInformation

    require_once('template/user_ip.php');
    $userIP = get_client_ip();

    $ownerId = $select_photo->user_id;
    $this->db->where("user_id='$ownerId'");
    $ownerInfo = $this->db->get("userz")->result();
    foreach($ownerInfo as $ownerInfo)

        //count all result
        $this->db->where("upload_id", $select_photo->picture_id);
        $countLike = $this->db->count_all_results('upload_like');

        //count if user already like the photo

        $this->db->where("upload_id= '$select_photo->picture_id' AND like_ip='$userIP' ");
        $countUserLike = $this->db->count_all_results('upload_like');



?>



<meta name="description" content="Kompetes pushing your talent beyond its bounds,
sparking new ideas, and driving creativity">

<!--<meta property="og:title" content="Check out this awesome picture from Kompetes.co.uk"/>
<meta property="og:site_name" content="Kompetes"/>
<meta property="og:url" content="https://kompetes.co.uk/photo/check/<?php /*echo $select_photo->picture_id */?>"/>
<meta property="og:description" content="Kompetes pushing your talent beyond its bounds,
sparking new ideas, and driving creativity"/>
<meta property="og:image" content="<?php /*echo base_url('uploads/'.$select_photo->picture_name)*/?>" />-->



<meta property="fb:app_id" content="206290706857314" />
<meta property="og:site_name" content="Kompetes.co.uk" />
<meta property="og:image" content="<?php echo base_url('uploads/'.$select_photo->picture_name)?>" />
<meta property="og:description" content="Kompetes pushing your talent beyond its bounds,
sparking new ideas, and driving creativity" />
<meta property="og:url" content="<?php echo base_url('photos/check/'.$select_photo->picture_id) ?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Check out this awesome picture from Kompetes.co.uk"/>
<meta property="og:image:width" content="453" />
<meta property="og:image:height" content="680" />



<meta name="twitter:card" content="Kompetes">
<meta name="twitter:site" content="<?php echo base_url('photos/check/'.$select_photo->picture_id) ?>">
<meta name="twitter:title" content="Check out this awesome picture from Kompetes.co.uk">
<meta name="twitter:description" content="Kompetes pushing your talent beyond its bounds,
sparking new ideas, and driving creativity">
<meta name="twitter:image" content="<?php echo base_url('uploads/'.$select_photo->picture_name)?>">








<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/carousel_photo.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>bower_components/jssocials/dist/jssocials.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>bower_components/jssocials/dist/jssocials-theme-flat.css" />


<style>
    #content{ width:600px; margin-left:80px;}

    .digg-panel{ border-bottom:1px solid #CCDCEF; min-height:100px; width:450px; margin-bottom:10px;}

    .digg-panel .bio{
        width:320px; margin-left:50px;clear:left;
        color:#666666;
        letter-spacing:-0.03em;
        overflow:hidden;
        font-family:Arial, Helvetica, sans-serif;
        line-height:1.16667em;
        font-size:11px;
        padding-bottom:5px;
    }

    .digg-panel .img-username{ float:left; width:340px; vertical-align:top}

    .digg-panel .img-username img.userImage{ float:left;-webkit-border-radius: 5px;}

    .digg-panel .buttons a{ margin-top:10px;}

    /*.digg-panel .buttons .btn-follow{ display:block; background:url(*/<?php //echo base_url('img/')?>/*follow.png) top center no-repeat; height:38px; width:67px; float:right;}*/

    /*.digg-panel .buttons .btn-following{ display:block; background:url(*/<?php //echo base_url('img/')?>/*following.png) top center no-repeat; height:38px; width:103px; float:right;}*/

    /*.digg-panel .buttons a:hover{ border:solid #333333 1px;}*/

    .digg-panel .user-title{
        font-weight:bold;
        margin-bottom:3px;
        padding-left:10px;
        float:left;
    }
    .digg-panel .user-title a.fullname{
        color:#373529;
        font-family:Arial, Helvetica, sans-serif;
        display:block;
        font-size:1.0em;
        text-decoration:none;
    }
    .digg-panel .user-title a.username{
        color:#105CB6;
        font-family:Arial, Helvetica, sans-serif;
        display:block;
        text-decoration:none;
        font-size:0.7em;
    }
    .digg-panel .user-title a:hover{
        text-decoration:underline;
    }


</style>

<script type="text/javascript">

    //var getLikes = document.getElementById("result").textContent;

    var clicks = 0;
    function onClick() {
        var getLikes = document.getElementById("result").textContent;
        var clicks = Number(getLikes);
        //var clicks = document.getElementById("clicks").textContent;
        clicks += 1;
        document.getElementById("clicks").innerHTML = clicks;
        document.getElementsByName('like').style.background="#f00";
        document.getElementById("clicks").style.background = "#ff5e56";
        document.getElementsByClassName("likex").style.background = "#f00";


    }

    function onFav(){




    }
</script>

<section class="content" style="margin-top: 50px;padding: 0;">

        <div class="container-fluid">

            <!-- sharing link and follow button -->
            <div class="share-follow-row">
                <div class="col-sm-6 col-xs-5">
                    <div class="photo_share_row" style="margin-left: -20px">
                        <ul>

                            <?php
                            if (isset($_SESSION['userLogginID'])) {

                                $userIDx = $_SESSION['userLogginID'];

                            } else {
                                $userIDx = "";
                            }



                            $userIP = get_client_ip();


                            $this->db->where("upload_id = '$select_photo->picture_id' AND user_id ='$userIDx'");
                            $this->db->or_where("upload_id = '$select_photo->picture_id' AND user_ip='$userIP'");
                            $countFav = $this->db->count_all_results('favourite_upload');

                            if($countFav <=0 ){
                            ?>

                                <li class="fav fav_bg" id="fav_<?php echo $select_photo->picture_id ?>" onclick=""><a href="javascript: void(0)" onclick="onFav()" id="fav__<?php echo $select_photo->picture_id ?>" rel="<?php echo $select_photo->picture_id ?>" class="text-black"><i class="fa fa-star"></i></a>

                                </li>
                            <?php } else{?>

                                <li class="fav bg-red fav_bg" id="" onclick=""><a href="javascript: void(0)" onclick="onFav()" id="" rel="<?php echo $select_photo->picture_id ?>" class="text-white"><i class="fa fa-star"></i></a></li>

                            <?php }?>





                            <li class="pull-right likex visible-xs" id="likex_<?php echo $select_photo->picture_id ?>" onclick="clickCounter()"  style="margin-right: -5px !important;"><a href="#" id="likex_<?php echo $select_photo->picture_id ?>" rel="<?php echo $select_photo->picture_id ?>"  class="text-black"><i class="fa fa-thumbs-up"></i></a>

                                <div id="result" class="showResult">
                                    <?php echo $countLike ?>

                                </div>
                            </li>
                            <li class="hidden-xs likex" id="likex_<?php echo $select_photo->picture_id ?>" onclick="onClick()" style=""><a href="javascript: void(0)" onclick="clickCounter()" id="likex_<?php echo $select_photo->picture_id ?>" rel="<?php echo $select_photo->picture_id ?>" class="text-black"><i class="fa fa-thumbs-up"></i></a>

                                <div id="clicks" class="showResult">
                                    <?php echo $countLike ?>
                                </div>
                            </li>
                            <li class="visible-xs"><a href="" class="text-black"><i class="fa fa-share-alt"></i></a></li>

                            <div id="share">
                                <li class="hidden-xs"><a href="" class="text-black"><i class="fa fa-twitter"></i></a></li>
                                <li class="hidden-xs"><a href="" class="text-black"><i class="fa fa-facebook"></i></a></li>
                                <li class="hidden-xs"><a href="" class="text-black"><i class="fa fa-google-plus"></i></a></li>
                                <li class="hidden-xs"><a href="" class="text-black"><i class="fa fa-pinterest"></i></a></li>
                                <li class="hidden-xs"><a href="" class="text-black"><i class="fa fa-envelope"></i></a></li>
                            </div>

                        </ul>
                    </div>
                </div>


                <div class="col-sm-6 col-xs-7">
                    <div class="pull-right" style="margin-top: 10px">
                        <div class="left p-t-5" style="float: left; margin-right: 10px">
                            <a href="<?php echo base_url('profile/check/'.$ownerInfo->user_id)?>"><img src="<?php if(empty($ownerInfo->picture)){echo base_url('users_photo/avatar.png');}else{echo base_url('users_photo/'.$ownerInfo->picture);}?>" width="40" style="height: 40px;width: 40px" class="img-circle"></a>
                        </div>
                        <div class="right"style="float: right">
                            <span class="userName text-black"><a href="<?php echo base_url('profile/check/'.$ownerInfo->user_id)?>" class="text-black"><b><?php echo $ownerInfo->username ?></b></a></span>
                            <br>
                            <!--<a href="<?php /*echo base_url('follow/following/'.$ownerId) */?>"><label class="label label-default">Follow</label></a>-->
                            <div class="body-right " style="margin-left: -15px">
                                <ul>
                                    <?php if(isset($_SESSION['userLogginID']) AND $ownerInfo->user_id !== $_SESSION['userLogginID']){?>
                                        <?php

                                        $userIDD = $_SESSION['userLogginID'];
                                        //echo $ownerInfo->user_id;
                                        //check if the user is already following

                                        $this->db->where("user_id = '$ownerInfo->user_id' AND follower_id = '$userIDD'");
                                        $countFollo = $this->db->count_all_results('followingx');


                                        ?>

                                        <li>
                                            <?php if($countFollo <=0){?>


<!--                                          <span class="buttons" id="button_--><?php //echo $ownerInfo->user_id ?><!--"><a class="btn-follow" href="javascript:void(0)"></a></span>-->
                                                <span class="buttons" id="button_<?php echo $ownerInfo->user_id.'-'. $ownerInfo->username.'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                <a class="btn follow" href="javascript: void(0)" id="<?php echo $ownerInfo->user_id ?>" rel="<?php echo $ownerInfo->user_id ?>">
                                                    <i class="fa fa-user-plus text-red"></i>
                                                    Follow
                                                </a>
                                            </span>
                                            <?php }elseif($countFollo >= 1){?>


<!--                                                <span class="buttons" id="button_--><?php //echo $ownerInfo->user_id ?><!--"><a class="btn-following" href="javascript: void(0)"></a></span>-->

                                            <span class="buttons" id="button_<?php echo $ownerInfo->user_id.'-'. $ownerInfo->username.'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                <a class="btn follow following" id="<?php echo $ownerInfo->user_id ?>" href="javascript:void(0)" rel="<?php echo $ownerInfo->user_id ?>">
                                                    <i class="ext-red"></i>
                                                    Following
                                                </a>
                                            </span>
                                            <?php } ?>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="photo_display_container" style="">

                    <div class="carousel">
                        <div class="itemsNext">
                            <div class="itm text-center">
                                <img src="<?php echo base_url('uploads/'.$select_photo->picture_name)?>" class="text-center">
                            </div>

                        </div>
                            <?php
                            $this->db->where("user_id ='$ownerId'");
                            $this->db->order_by('id','RANDOM');


                            $getNextPhoto = $this->db->get('uploads')->result();

                            foreach($getNextPhoto as $nextPhoto)

                            ;?>


                            <a href="<?php echo base_url('photos/check/'.$nextPhoto->picture_id); ?>" style="height: 30px;" class="text-black">
                                <div class="next arrow"></div>
                            </a>

                            <a  href="<?php echo base_url('photos/check/'.$nextPhoto->picture_id); ?>">
                                <div class="previous arrow" data-disabled=""></div>
                            </a>



                    </div>


                  <!-- <div class="photo_display">
                        <img src="<?php /*echo base_url()*/?>photo/60722357_large1300.jpg">
                    </div>-->

                </div>
            </div>
        </div>



    <div class="" style="background: #fff">
        <div class="container-fluid">
            <div class="commentAward_row" style="min-height: 300px;margin-top: 20px">

                <div class="col-sm-4 col-sm-offset-1">

                    <div id="photo-info" class="more_feature sidebar">
                        <?php

                        //get other picture from same user
                        $ownerId = $select_photo->user_id;

                        $this->db->where("user_id ='$ownerId'");
                        $this->db->order_by('id','RANDOM');
                        $this->db->limit(5);
                        $getMore = $this->db->get('uploads')->result();

                        foreach($getMore as $morePhotos):?>

                            <a href="<?php echo base_url('photos/check/'.$morePhotos->picture_id)?>">
                                <img src="<?php echo base_url("uploads/small_thumb/".$morePhotos->picture_small_name)?>">
                            </a>

                        <?php endforeach ?>

                        <div class="">
                            <small> More from <?php echo $ownerInfo->username; ?> </small>
                        </div>

                        <div class="comment_date">
                            <div class="top-info">
                                <h4><?php echo $countComment; ?></h4>
                                <span class="info-title">Comments</span>
                            </div>

                            <div class="top-info">
                                <h4><?php if(empty($select_photo->view)){echo 0;}else{echo $select_photo->view;}?></h4>
                                <span class="info-title">views</span>
                            </div>

                            <div class="top-info">
                                <h4><?php echo time_elapsed_string($morePhotos->date);?></h4>
                                <span class="info-title">Uploaded</span>
                            </div>
                        </div>

                        <br>
                        <div class="title-contain">
                            <h3><?php echo $select_photo->title;?></h3>
                        </div>


                        <div class="photo_discription">
                            <p><?php echo $select_photo->description; ?></p>
                        </div>

                        <div class="block tags">
                            <div class="block-mini">Tags</div>
                            <?php

                            $tags = explode(',', $select_photo->tags);

                            foreach($tags as $tag):

                            ?>


                            <a href="">#<?php echo str_replace(' ','',$tag) ?></a>
                            <!--<a href="/search/tags/drink">#drink</a>-->

                            <?php endforeach ?>
                        </div>


                        <div class="block tags">
                            <div class="block-mini">Categories</div>
                            <?php

                            $tags = explode(',', $select_photo->category);

                            foreach($tags as $tag):

                                ?>

                                <a href="">#<?php echo str_replace(' ','',$tag) ?></a>
                                <!--<a href="/search/tags/drink">#drink</a>-->

                            <?php endforeach ?>
                        </div>

                      <!--  <div class="block metadata">
                            <div class="block-mini"></div>
                            <div class="item camera">Camera: <span><a href="/search/camera/canon+eos+6d">Canon EOS 6D</a></span></div>
                            <div class="item aperture">Aperture: <span>f/8</span></div>
                            <div class="item iso_film">ISO: <span>100</span></div>
                            <div class="item exposure_time">Shutter Speed: <span>1/250</span></div>
                            <div class="item exposure_time">Focal Length: <span>70/1</span></div>
                        </div>-->


                        <div class="photo_contest">
                            <h6>Photo Contest & Challenges Submission</h6>


                            <ul class="tag-style">

                                <?php

                                foreach($getEntry as $entry){

                                     $entryName = $entry['contest_name'];

                                 ?>

                                    <?php if(!empty($entryName)):?>

                                    <li>
                                        <a href="<?php echo base_url($entry['entry_type'].'s/check/'.$entry['entry_id'])?>"><?php echo $entryName ?></a>
                                    </li>
                                    <?php endif; } ?>

                                <?php

                                foreach($getEntry2 as $entry2){

                                    $entryName2 = $entry2['challenge_name'];

                                    ?>

                                    <?php if(!empty($entryName2)):?>

                                        <li>
                                            <a href="<?php echo base_url($entry2['entry_type'].'s/check/'.$entry2['entry_id'])?>"><?php echo $entryName2 ?></a>
                                        </li>


                                    <?php endif; } ?>
                            </ul>
                        </div>


                        <!--<div class="extra block awards overflow">
                                <h3>Awards</h3>
                                <div class="block award type-default">
                                    Won People's Choice in COWS Photo Challenge<span class="award-date">June, 2017</span>
                                </div>

                                <div class="block award type-default">
                                    Winner in African Animals Photo Challenge<span class="award-date">March, 2017</span>
                                </div>

                                <div class="block award type-contestf">
                                    Won Contest Finalist in Visions Of Africa Photo Contest<span class="award-date">February, 2017</span>
                                </div>

                                <div class="block award type-default">
                                    Won People's Choice in Life Photo Challenge<span class="award-date">August, 2016</span>
                                </div>

                                <div class="block award type-default">
                                    Won People's Choice in Tell me a story Photo Challenge<span class="award-date">January, 2016</span>
                                </div>
                            </div>-->

                        <!--<div class="extra sidebar overflow" style="">
                            <h3>Likes</h3>
                            <items class="block belongs" style="">
                                <item class="peer-recognition" style="">

                                    <div class="peer-users" style="">
                                        <span class="peer-user"><a href="#" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2014/09/12/32325871_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                        </span>
                                        <span class="peer-user"><a href="#" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2015/11/26/60763325_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/BLPhotography" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-user"><a href="#" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2016/08/18/67939287_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                        </span>
                                        <span class="peer-user"><a href="#" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2016/03/11/64461859_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/terrysigns13" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-user"><a href="#" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2016/04/30/65770279_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/pamelahodges" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-left"><a href="javascript:" data-award="likes" data-page="1" data-left="835">+835</a></span>
                                    </div>
                                </item>
                            </items>
                        </div>-->

                        <!--<div class="extra overflow">
                            <h3>Peer Award</h3>
                            <items class="block belongs">
                                <item class="peer-recognition">
                                    <div class="peer-title">Peer Award</div>

                                    <div class="peer-users">
                    	                        	<span class="peer-user"><a href="/member/JoaoAscenso" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/08/30/74833973_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/JoaoAscenso" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-user"><a href="/member/tinamerrigan" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/12/04/76420242_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                        </span>
                                        <span class="peer-user"><a href="/member/SerhiyPochatko" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/10/18/75704317_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                        </span>
                                        <span class="peer-user"><a href="/member/martinisma" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2016/04/07/65304767_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                        </span>
                                        <span class="peer-user"><a href="/member/SherrylM" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/12/09/76488899_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/SherrylM" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-left"><a href="javascript:" data-award="Peer Award" data-page="1" data-left="159">+159</a></span>
                                    </div>
                                </item>
                                <item class="peer-recognition">
                                    <div class="peer-title">Superb Composition</div>

                                    <div class="peer-users">
                    	                        	<span class="peer-user"><a href="/member/creative_odd_duck" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/11/29/76354777_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/creative_odd_duck" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-user"><a href="/member/vicgoodfellow" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/03/13/71849525_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                        </span>
                                        <span class="peer-user"><a href="/member/rPerry" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/03/13/71852752_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/rPerry" class="avatar_membership" target="_parent">Premium</a>
                                                                </span>
                                        <span class="peer-user"><a href="/member/kariwatkins" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2013/11/02/4890501_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/kariwatkins" class="avatar_membership" target="_parent">PRO</a>
                                                                </span>
                                        <span class="peer-user"><a href="/member/efimbirenbaum" target="_parent"><img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/02/03/71206816_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/efimbirenbaum" class="avatar_membership" target="_parent">Premium</a>
                                                                </span>
                                        <span class="peer-left"><a href="javascript:" data-award="Superb Composition" data-page="1" data-left="144">+144</a></span>
                                    </div>
                                </item>

                                <item class="peer-recognition">
                                    <div class="peer-title">Magnificent Capture</div>

                                    <div class="peer-users">
                                        <span class="peer-user">
                                            <a href="#" target="_parent">
                                                <img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/11/30/76368699_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;">
                                            </a>
                                        </span>
                                        <span class="peer-user">
                                            <a href="#" target="_parent">
                                                <img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2017/11/08/76047879_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/brownmoyondizvo" class="avatar_membership" target="_parent">
                                                PRO
                                            </a>
                                        </span>

                                        <span class="peer-user">
                                            <a href="#" target="_parent">
                                                <img src="https://photo-viewbug.s3.amazonaws.com/media/mediafiles/2012/06/06/1892173_75x75.jpg" class="delayed" width="45" data-og="45" data-ow="45" style="height: 45px; opacity: 1;"></a>                                                    		<a href="/member/maryhale9534" class="avatar_membership" target="_parent">
                                                PRO
                                            </a>
                                        </span>

                                        <span class="peer-left">
                                            <a href="javascript:" data-award="Magnificent Capture" data-page="1" data-left="33">
                                                +33
                                            </a>
                                        </span>
                                    </div>
                                </item>
                                <div style="min-height: 100px"></div>
                            </items>
                        </div>-->

                        <div class="clearfix"></div>
                    </div>

                </div>
                <div class="col-sm-6 col-sm-offset-1" style="border-left: 1px solid #d2d2d2;background: #f6f6f6;margin-top: -16px">
                    <?php echo $success ?>
                    <!-- text-area for commenting -->
                    <div class="reviewRow">
                        <div class="reviewerField">
                            <div class="reviwerPic">
                                <img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$userPhoto);}else{ echo base_url('users_photo/avatar.png');}?>">
                            </div>
                        </div>
                        <div class="reviewerContent" id="comment">
                            <?php echo form_error('comment')?>
                            <?php echo form_open()?>
                            <div class="innerBubble" style="">
                                <div style="padding: 10px;">
                                    <textarea class="form-control no-border-radius" name="comment" rows="4" placeholder="Write your comment here not more than 200"></textarea>

                                    <?php if(isset($_SESSION['userLogginID'])){?>
                                    <input type="submit" class="btn bg-black text-white no-border-radius" value="Post Comment">
                                    <?php }else{?>

                                        <a href="<?php echo base_url('login?redirect=photos/check/'.$select_photo->picture_id.'#comment')?>" class="btn btn-danger">Login to Comment </a>

                                    <?php } ?>
                                </div>
                            </div>
                            <?php form_close()?>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- User comment area -->
                    <?php if($countComment >=1):?>
                        <?php foreach($getComment as $comment):?>
                            <?php //echo $countComment ?>
                            <div class="reviewRow">
                                <div class="reviewerField">
                                    <a href="<?php echo base_url('profile/check/'.$comment['user_id'])?>" class="text-black">
                                        <div class="reviwerPic">
                                            <img src="<?php if(!empty($comment['picture'])){echo base_url('users_photo/'.$comment['picture']);}else{ echo base_url('users_photo/avatar.png');}?>">
                                        </div>
                                        <div class="rname"><?php echo $comment['username']?></div>
                                    </a>

                                </div>
                                <div class="reviewerContent">
                                    <div class="innerBubble">
                                        <h5><a href="<?php echo base_url('profile/check/'.$comment['user_id'])?>" class="text-red"> <?php echo $comment['username'] ?></a></h5>
                                        <span><i class=" glyphicon glyphicon-clock"></i> <?php echo time_elapsed_string($comment['date']);?></span>
                                        <p><?php echo $comment['comment']?></p>

                                        <!--<div style="padding: 10px">
                                            <a href="#"><label class="label label-danger no-border-radius">Reply</label> </a>
                                        </div>
-->

                                        <!-- reply comment starts from here -->

                                       <!-- <div class="" style="margin-left: 5px; border-top: 1px dotted #d2d2d2;padding-top: 10px">
                                          <div class="col-sm-8">
                                              <input type="text" class="form-control" name="" style="border-radius: 0">
                                          </div>
                                          <div class="col-sm-4" style="padding-top: 5px">
                                              <button type="submit" class="btn btn-success btn-xs no-border-radius" value="Reply">Submit</button>
                                              <button type="submit" class="btn btn-warning btn-xs no-border-radius" value="Reply">Reply</button>
                                          </div>
                                        </div>-->

                                        <div class="clearfix"></div>

                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>


                </div>
            </div>
        </div>
    </div>






</section>

<script src='<?php echo base_url('js/photo/index.js')?>'></script>
<script src='<?php echo base_url('js/photo/photo_ca.js')?>'></script>

<!--<script type="text/javascript" src="--><?php //echo base_url()?><!--js/jquery-1.2.6.min.js"></script>-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src="<?php echo base_url()?>bower_components/jssocials/dist/jssocials.min.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.livequery.js"></script>

<script type="text/javascript">

    $("#share").jsSocials({
        shares: ["email", "twitter", "facebook", "googleplus", "pinterest", "whatsapp"]
    });


    $(document).ready(function() {

        $('.buttons > a').livequery("click",function(e){

            var parent  = $(this).parent();
            var getID   =  parent.attr('id').replace('button_','');

            //$.post("<?php echo base_url()?>follow/following/"+getID, {
            $.post("<?php echo base_url()?>follow.php?id="+getID, {

            }, function(response){

                $('#button_'+getID).html($(response).fadeIn('slow'));
            });
        });





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
</script>





</body>
</html>