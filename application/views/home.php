<style>

#right_var{
    width: 400px;
    position: ;
    margin: 0;
    padding: 0;


}


.sticky_var{

    position: fixed;
    right: 150px;
    height: 750px;
    left: ;
    top: 0;
    float: left;
    margin-top: 30px !important;
    overflow-y: scroll;




}

.photos_wall{
    min-height: 1700px;

}

.photos_wall + sticky_var{
    padding-top: 400px !important;


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

</script>



<section class="content" style="margin-top: 40px;padding: 0;">
    <div class="container-fluid no-margin-xs">

        <div class="mobile-rec visible-xs">
            <ul>
                <li class="active"><a>Following</a></li>
                <li class="no-border"><a href="#" data-toggle="modal" data-target="#recommended">Recommended</a></li>
            </ul>
        </div>


        <!-- modal for the mobile recommended -->

        <div class="modal fade" id="recommended" role="dialog">
            <div class="modal-dialog m-l-0 m-r-0 m-b-0" style="margin-top: 3px;position: ">
                <!-- Modal content-->
                <div class="modal-content modal-lg no-border-radius" style="min-height: 1000px;">

                    <div class="modal-body p-r-0">

                        <div class="pull-right">
                            <a class="" data-dismiss="modal">
                                <label class="label bg-red">
                                    Home
                                </label>
                            </a>
                        </div>

                        <div class="right_var p-r-10" id="" style="z-index: -1;">
                            <div class="border-bottom" style="margin-bottom: -30px; margin-top: 55px;border-bottom: 1px solid #d2d2d2">

                                <small>Open Contests</small>
                            </div>
                            <div class="divider-horizontal"></div>
                            <?php foreach($getContestAvail as $getContest):?>
                                <?php
                                $timestampStart = strtotime($getContest['contest_start_date']);
                                $formattedStartDate = date('F d', $timestampStart);

                                //vote end
                                $timestampClose = strtotime($getContest['contest_close_date']);
                                $formattedCloseDate = date('F d, Y', $timestampClose);

                                //remaining date
                                $d1=strtotime($getContest['contest_start_date']);
                                $d2=ceil(($d1-time())/60/60/24);

                                ?>
                                <div class="row_contest" style="background: ">
                                    <a class="text-black" href="<?php echo base_url("contests/check/".$getContest['contest_id'])?>">
                                        <div class="contest_thumb_image">
                                            <img src="<?php echo base_url('uploads/contests/'.$getContest['contest_picture'])?>" class="img-circle" width="35" height="35">
                                        </div>
                                        <div class="contest_info_row">
                                            <h5 class="contest_heading" style="line-height: 19.7px;"><?php echo $getContest['contest_name']?> Contest</h5>
                                            <p class="m-t-5 text-black">
                                                <?php echo $getContest['contest_grand_price']?>
                                                <small class="pull-right m-t-30"><?php echo $d2 ?> Days left</small>
                                            </p>

                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            <?php endforeach ?>


                            <div id="">

                                <div>
                                    <div class=""style="margin-bottom: -30px; margin-top: 40px;border-bottom: 1px solid #d2d2d2">

                                        <small>Who to Follow</small>
                                    </div>
                                    <div class="divider-horizontal"></div>

                                    <?php

                                    $userIDD = $_SESSION['userLogginID'];
                                    foreach($getMoreFollow as $getMoreF):

                                        $userzID = $getMoreF['user_id'];

                                        //check if the user is following already

                                        $this->db->where("follower_id = '$userIDD' AND user_id ='$userzID'");
                                        $countFollowBack = $this->db->count_all_results('followingx');

                                        ?>


                                        <div class="follow_row" style="background: #f2f2f2; border-bottom: 1px solid #d2d2d2" <?php if ($countFollowBack >=1){echo 'hidden';} ?>>
                                            <img src="<?php if(empty($getMoreF['picture'])){ echo base_url('users_photo/avatar.png');}else{echo base_url('users_photo/'.$getMoreF['picture']);}?>" width="30" height="30">
                                            <a class="text-black" href="<?php echo base_url('profile/check/'.$getMoreF['user_id']) ?>" target="_new"><?php echo $getMoreF['username']?></a>
                                            <span class="body-right right">
                            <?php if ($countFollowBack <=0){?>


                                <span class="buttons" id="button_<?php echo $getMoreF['user_id'].'-'. $getMoreF['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                    <a class="btn follow" href="javascript: void(0)" id="<?php echo $getMoreF['user_id'] ?>" rel="<?php echo $getMoreF['user_id'] ?>">
                                                        <i class="fa fa-user-plus text-red"></i>
                                                        Follow
                                                    </a>
                                                </span>

                            <?php } ?>

                                                <?php if($countFollowBack >=1 ){?>

                                                    <span class="buttons" id="button_<?php echo $getMoreF['user_id'].'-'. $getMoreF['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                    <a class="btn follow following" href="javascript: void(0)" id="<?php echo $getMoreF['user_id'] ?>" rel="<?php echo $getMoreF['user_id'] ?>">
                                                        <i class="fa text-red"></i>
                                                        Following
                                                    </a>
                                                </span>

                                                <?php }?>
                                 </span>

                                        </div>
                                    <?php endforeach ?>

                                </div>


                                <div>
                                    <div class="" style="margin-bottom: -30px; margin-top: 40px;border-bottom: 1px solid #d2d2d2">

                                        <small>Ongoing Voting</small>
                                    </div>

                                    <div class="divider-horizontal"></div>

                                    <?php foreach ($getOngoingVoting as $votingList): ?>


                                        <div class="ongoing_voting_row">
                                            <a class="text-black" href="<?php echo base_url("vote/info/".$votingList['contest_id'])?>">
                                                <img src="<?php echo base_url('uploads/contests/'.$votingList['contest_picture'])?>" width="30" height="30">
                                                <?php echo $votingList['contest_name']?> contest Voting
                                            </a>
                                        </div>

                                    <?php endforeach ?>

                                </div>


                                <div hidden>
                                    <div class=""  style="margin-bottom: -30px; margin-top: 40px">
                                        <small class="">Invite more Friends</small>
                                    </div>

                                    <div class="divider-horizontal"></div>

                                    <div class="invite_row p-b-10 f-ubuntu">
                                        <img src="<?php echo base_url()?>img/icons/Facebook.png" class="m-r-5">
                                        Invite using Facebook
                                    </div>


                                    <div class="invite_row p-b-10 f-ubuntu">
                                        <img src="<?php echo base_url()?>img/icons/Twitter.png" class="m-r-5">
                                        Invite using Twitter
                                    </div>

                                    <div class="invite_row">
                                        <img src="<?php echo base_url()?>img/icons/Google-+.png">
                                        Invite using Google+
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- end of modal for recommended -->

        <div class="col-sm-7 no-padding-xs">

            <?php if($countFollowing<=0):?>


                <div class="row" style="min-height: 400px">
                    <h6 class="f-s-18 text-black m-l-25" style="margin-bottom:-30px;border-bottom:1px solid #fff">People You May Follow</h6>

                    <?php foreach($getMoreFollow as $moreFollower):?>

                        <?php
                        $userzID = $moreFollower['user_id'];
                        $this->db->where("user_id ='$userzID'");
                        $this->db->order_by("id","RANDOM");
                        $getCaption = $this->db->get('uploads')->result_array();

                        //count number of followers
                        $this->db->where("user_id='$userzID'");
                        $countUserzFollowers = $this->db->count_all_results("followingx");

                        //count number of following
                        $this->db->where("follower_id='$userzID'");
                        $countUserzFollowing = $this->db->count_all_results("followingx");
                        ?>


                        <div class="col-sm-6 m-0 p-20">
                            <div class="profile-grid-block p-0">
                                <a href="<?php echo base_url('profile/check/'.$moreFollower['user_id'])?>">
                                    <div class="grid-image" style="background: linear-gradient(rgba(70,20,10,0.6),rgba(0,0,0,0.4)), url(<?php if(!empty($getCaption[0]['picture_small_name'])){echo base_url('uploads/small_thumb/'.$getCaption[0]['picture_small_name']);}else{echo base_url('photo/77345942_widepreview400.jpg'); }?>)">

                                    </div>
                                    <div class="grid-user-content" style="background: #f2f2f2">
                                        <div class="grid-user-picture">
                                            <img src="<?php if($moreFollower['picture']){echo base_url('users_photo/'.$moreFollower['picture']);}else{ echo base_url('users_photo/avatar.png');}?>" class="img-circle img-thumbnail" width="100" height="100" style="height: 62px">
                                        </div>
                                        <h5 class="text-center f-raleway f-s-18 ">
                                            <span class="text-black">
                                            <?php echo $moreFollower['username'] ?>
                                            </span>

                                            <br>

                                            <div class="body-right">
                                                <span class="buttons" id="button_<?php echo $moreFollower['user_id'].'-'. $moreFollower['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                <a class="btn follow" href="javascript: void(0)" id="<?php echo $moreFollower['user_id'] ?>" rel="<?php echo $moreFollower['user_id'] ?>">
                                                    <i class="fa fa-user-plus text-red"></i>
                                                    Follow
                                                </a>
                                            </span>


                                            </div>

<!--                                            <a class="btn btn-success btn-xs m-b-10 bg-red no-border-radius" href="">Follow</a>-->
                                        </h5>

                                        <div class="text-center col-xs-offset-2 contest-cat-line p-l-10">
                                            <ul>
                                                <li class="label label-primary p-t-2" style="height: 20px;min-width: 30px"><a href="<?php echo 'https://facebook.com/'. str_replace('@','',$moreFollower['facebook'])?>" target="_new" class="f-s-10"><i class="fa fa-facebook"></i> </a></li>
                                                <li class="label label-info p-t-2" style="height: 20px;min-width: 30px"><a href="<?php echo 'https://twitter.com/'. $moreFollower['twitter']?>" target="_new" class="f-s-10"><i class="fa fa-twitter"></i> </a></li>
                                                <li class="label label-danger p-t-2" style="height: 20px;min-width: 30px"><a href="<?php echo 'https://instagram.com/'. str_replace('@','',$moreFollower['instagram'])?>" target="_new" class="f-s-10"><i class="fa fa-instagram"></i> </a></li>
                                                <li class="label label-prim bg-black p-t-4" style="height: 20px;"><a href="<?php echo base_url('profile/followers/'.$moreFollower['user_id']) ?>" class="f-s-10"> Followers <?php echo $countUserzFollowers ?> </a></li>
                                                <li class="label label-wa bg-red p-t-4" style="height: 20px;"><a href="<?php echo base_url('profile/following/'.$moreFollower['user_id']) ?>" class="f-s-10"> Following <?php echo $countUserzFollowing ?> </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>



            <div class="photos_wall" style="min-height: 1700px;padding-top: 30px;padding-bottom: 100px;">




                <?php foreach($getPost as $post):?>

                    <?php
                        $postType = $post['post_type'];
                        $postMediaID = $post['media_id'];

                    //get post information

                    $this->db->where("picture_id = '$postMediaID'");
                    $getMediaFile = $this->db->get("uploads")->result();

                    foreach($getMediaFile as $mediaFile);

                    ?>

                    <?php if($postType =='photo'): ?>
                        <!-- photorow start here -->
                        <div class="photos_row" style="margin-bottom: 50px;background: #f3f3f3 !important; ">
                            <div class="photo_title" style="height: 60px;width: 100%; padding: 10px;background: #f3f3f3">
                                <div class="logoPhoto" style="padding-top: 5px;background: #f3f3f3">
                                    <img src="<?php echo base_url()?>img/logo.png" width="30" height="30">
                                    <span> Recommend for you by <a href="<?php echo base_url('profile/check/'.$post['poster_id'])?>" target="_new"> <?php echo $post['poster_name']?></a></span>
                                </div>
                            </div>
                           <div class="likeRow">
                                <div>
                                    <ul>

                                        <?php

                                            $userIDx = $_SESSION['userLogginID'];

                                            require_once('template/user_ip.php');
                                            $userIP = get_client_ip();

                                            $this->db->where("upload_id = '$postMediaID' AND user_id ='$userIDx'");
                                            $this->db->or_where("upload_id = '$postMediaID' AND user_ip='$userIP'");
                                            $countFav = $this->db->count_all_results('favourite_upload');

                                            //count like

                                        $this->db->where("upload_id", $postMediaID);
                                        $countLike = $this->db->count_all_results('upload_like');

                                        if($countFav <=0 ){
                                        ?>

                                            <li class="fav2 fav_bg" id="fav_<?php echo $postMediaID ?>" onclick=""><a href="javascript: void(0)" id="fav__<?php echo $postMediaID ?>" rel="<?php echo $postMediaID?>"><i class="fa fa-star fa-2x"></i></a></li>

                                        <?php }else{ ?>
                                            <li class="fav2 fav_bg" id="" onclick=""><a href="javascript: void(0)" id="" rel=""><i class="fa fa-star text-red fa-2x"></i></a></li>
                                        <?php }?>


                                        <?php

                                        //check if picture is already like by the user
                                        $this->db->where("upload_id ='$postMediaID' AND user_id ='$userIDx'");
                                        $this->db->or_where("upload_id ='$postMediaID' AND like_ip ='$userIP'");
                                        $countuserLike = $this->db->count_all_results('upload_like');



                                        if($countLike <=0){?>

                                            <li  class="likex" id="likex_<?php echo $postMediaID ?>" onclick="onClick()" style=""><a href="javascript: void(0)" onclick="clickCounter()" id="likex_<?php echo $postMediaID ?>" rel="<?php echo $postMediaID ?>"><i class="fa fa-thumbs-up fa-2x"></i></a>

                                            <div id="clicks" class="showResult text-center bg-purple">
                                                <?php echo $countLike ?>
                                            </div>

                                        </li>

                                        <?php }else{?>

                                            <li  class="likex" id="likex_<?php echo $postMediaID ?>" onclick="onClick()" style=""><a href="javascript: void(0)" onclick="clickCounter()" id="likex_<?php echo $postMediaID ?>" rel="<?php echo $postMediaID ?>"><i class="fa fa-thumbs-down fa-2x text-red"></i></a>

                                                <div id="clicks" class="showResult text-center bg-purple">
                                                    <?php echo $countLike ?>
                                                </div>

                                            </li>



                                        <?php }?>
                                    </ul>
                                </div>
                           </div>
                            <div class="photos_content hidden-xs" style="">
                                <a href="<?php echo base_url("photos/check/".$postMediaID) ?>">
                                    <img src="<?php echo base_url('uploads/'.str_replace('_small','',$mediaFile->picture_small_name));?>" width="100%" style="margin-top:; z-index: -1">
                                </a>
                            </div>

                            <div class="photos_content photos_content_xs visible-xs" style="">
                                <a href="<?php base_url("photos/check/".$postMediaID)?>">
                                    <img src="<?php echo base_url('uploads/medium_thumb/'.$mediaFile->picture_medium_name);?>" width="100%" style="margin-top:; z-index: -1">
                                </a>
                            </div>
                        </div>
                        <!-- photorow Ends Here -->
                    <?php endif?>

                    <?php if($postType =='video'): ?>
                        <!-- row for video -->
                        <div class="photos_row video-col" style="margin-bottom: 50px">
                        <div class="photo_title" style="height: 60px;background: #fff;width: 100%; padding: 10px;">
                            <div class="logoPhoto" style="padding-top: 5px">
                                <img src="<?php echo base_url()?>img/logo.png" width="30" height="30">
                                <span> Recommend for you by <a href=""> Prudent2012</a></span>
                            </div>
                        </div>
                        <div class="likeRow">
                            <div>
                                <ul>
                                    <li><a><i class="fa fa-star fa-2x"></i></a></li>
                                    <li><a><i class="fa fa-heart fa-2x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="photos_content video_content" style="margin-top: -40px">

                            <video poster="" controls crossorigin style="width:100%;height: 500px">
                                <!-- Video files -->
                                <source src="<?php echo base_url()?>video/Hero%20Slideshow.MP4" type="video/mp4" style="width: 100%">
                                <!--<source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.webm" type="video/webm">-->

                                <!-- Text track file -->
                                <!--<track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                                    default>-->

                                <!-- Fallback for browsers that don't support the <video> element -->
                                <!--<a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.mp4" download>Download</a>-->
                            </video>
                        </div>
                    </div>
                    <!-- Video Row Ends Here -->
                    <?php endif?>



                    <?php if($postType =='challenge'): ?>

                        <?php

                        $this->db->where("challenge_id = '$postMediaID'");
                        $getChallengeFile = $this->db->get("challenges")->result();

                        foreach($getChallengeFile as $getChallenge):

                            ?>

                            <!-- open contest -->
                            <div class="photos_row" style="background:;">
                                <div class="photo_title" style="height: 60px;background: #fff;width: 100%; padding: 10px;">
                                    <div class="logoPhoto" style="padding-top: 5px">
                                        <img src="<?php echo base_url()?>img/logo.png" width="30" height="30">
                                        <span> Recommend for you <a href="<?php echo base_url("")?>"><?php echo $getChallenge->challenge_name; ?> Challenge</a> By <a href="" class="text-center"> <?php echo $getChallenge->username?></a> </span>
                                    </div>
                                </div>

                                <div class="photos_content photo_contest" style="">
                                    <a href="<?php echo base_url('')?>">
                                        <img src="<?php echo base_url("uploads/challenges/".$getChallenge->challenge_banner)?>" width="100%" style="">
                                    </a>

                                </div>
                                <div class="photo_contest_info" style="margin-bottom: 170px !important; ; ">

                                    <h2 class="text-center"><?php echo $getChallenge->challenge_name; ?> Challenge</h2>
                                    <h6 class="text-center"><?php //echo $getContest->contest_grand_price; ?></h6>
                                </div>
                            </div>

                        <?php endforeach ?>
                    <?php endif ?>



                    <?php if($postType =='contest'): ?>

                        <?php

                        $this->db->where("contest_id = '$postMediaID'");
                        $getContestFile = $this->db->get("contests")->result();

                        foreach($getContestFile as $getContest):

                        ?>
                        <!-- open contest -->
                         <div class="photos_row" style="margin:0px !important !important;background: #f3f3f3 !important; ">
                            <div class="photo_title" style="height: 60px;background: #f3f3f3;width: 100%; padding: 10px;">
                                <div class="logoPhoto" style="padding-top: 5px">
                                    <img src="<?php echo base_url()?>img/logo.png" width="30" height="30">
                                    <span> Recommend for you <a href="<?php echo base_url("contests/check/".$getContest->contest_id)?>"><?php echo $getContest->contest_name; ?> Contest</a></span>
                                </div>
                            </div>

                            <div class="photos_content photo_contest" style="">
                                <a href="<?php echo base_url("contests/check/".$getContest->contest_id)?>">
                                    <img src="<?php echo base_url("uploads/contests/".$getContest->contest_picture)?>" width="100%" style="">
                                </a>

                                <div class="photo_contest_info" style="margin-bottom: 100px !important;">
                                    <h2 class="text-center"><?php echo $getContest->contest_name; ?> Contest</h2>
                                    <h6 class="text-center"><?php echo $getContest->contest_grand_price; ?></h6>
                                </div>
                            </div>

                        </div>


                        <?php endforeach ?>
                    <?php endif ?>

                <?php endforeach ?>

            </div>


        </div>

        <div class="col-sm-4 hidden-xs" style="min-height: 650px;">
            <div class="right_var" id="" style="z-index: -1;">
                <div class="border-bottom" style="margin-bottom: -30px; margin-top: 55px;border-bottom: 1px solid #d2d2d2">

                    <small>Open Contests</small>
                </div>
                <div class="divider-horizontal"></div>
                <?php foreach($getContestAvail as $getContest):?>
                    <?php
                    $timestampStart = strtotime($getContest['contest_start_date']);
                    $formattedStartDate = date('F d', $timestampStart);

                    //vote end
                    $timestampClose = strtotime($getContest['contest_close_date']);
                    $formattedCloseDate = date('F d, Y', $timestampClose);

                    //remaining date
                    $d1=strtotime($getContest['contest_start_date']);
                    $d2=ceil(($d1-time())/60/60/24);

                    ?>
                    <div class="row_contest" style="background: ">
                    <a class="text-black" href="<?php echo base_url("contests/check/".$getContest['contest_id'])?>">
                        <div class="contest_thumb_image">
                            <img src="<?php echo base_url('uploads/contests/'.$getContest['contest_picture'])?>" class="img-circle" width="35" height="35">
                        </div>
                        <div class="contest_info_row">
                            <h5 class="contest_heading" style="line-height: 19.7px;"><?php echo $getContest['contest_name']?> Contest</h5>
                            <p class="m-t-5 text-black">
                                <?php echo $getContest['contest_grand_price']?>
                                <small class="pull-right m-t-30"><?php echo $d2 ?> Days left</small>
                            </p>

                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <?php endforeach ?>


                <div id="right_var">

                    <div>
                        <div class=""style="margin-bottom: -30px; margin-top: 40px;border-bottom: 1px solid #d2d2d2">

                            <small>Who to Follow</small>
                        </div>
                        <div class="divider-horizontal"></div>

                        <?php

                            $userIDD = $_SESSION['userLogginID'];
                            foreach($getMoreFollow as $getMoreF):

                                $userzID = $getMoreF['user_id'];

                            //check if the user is following already

                                $this->db->where("follower_id = '$userIDD' AND user_id ='$userzID'");
                                $countFollowBack = $this->db->count_all_results('followingx');

                        ?>


                        <div class="follow_row" style="background: #f2f2f2; border-bottom: 1px solid #d2d2d2" <?php if ($countFollowBack >=1){echo 'hidden';} ?>>
                            <img src="<?php if(empty($getMoreF['picture'])){ echo base_url('users_photo/avatar.png');}else{echo base_url('users_photo/'.$getMoreF['picture']);}?>" width="30" height="30">
                            <a class="text-black" href="<?php echo base_url('profile/check/'.$getMoreF['user_id']) ?>" target="_new"><?php echo $getMoreF['username']?></a>
                            <span class="body-right right">
                            <?php if ($countFollowBack <=0){?>


                                                    <span class="buttons" id="button_<?php echo $getMoreF['user_id'].'-'. $getMoreF['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                    <a class="btn follow" href="javascript: void(0)" id="<?php echo $getMoreF['user_id'] ?>" rel="<?php echo $getMoreF['user_id'] ?>">
                                                        <i class="fa fa-user-plus text-red"></i>
                                                        Follow
                                                    </a>
                                                </span>

                            <?php } ?>

                                <?php if($countFollowBack >=1 ){?>

                                <span class="buttons" id="button_<?php echo $getMoreF['user_id'].'-'. $getMoreF['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                    <a class="btn follow following" href="javascript: void(0)" id="<?php echo $getMoreF['user_id'] ?>" rel="<?php echo $getMoreF['user_id'] ?>">
                                                        <i class="fa text-red"></i>
                                                        Following
                                                    </a>
                                                </span>

                            <?php }?>
                                 </span>

                        </div>
                        <?php endforeach ?>

                    </div>


                    <div>
                        <div class="" style="margin-bottom: -30px; margin-top: 40px;border-bottom: 1px solid #d2d2d2">

                            <small>Ongoing Voting</small>
                        </div>

                        <div class="divider-horizontal"></div>

                        <?php foreach ($getOngoingVoting as $votingList): ?>


                        <div class="ongoing_voting_row">
                            <a class="text-black" href="<?php echo base_url("vote/info/".$votingList['contest_id'])?>">
                                <img src="<?php echo base_url('uploads/contests/'.$votingList['contest_picture'])?>" width="30" height="30">
                                <?php echo $votingList['contest_name']?> contest Voting
                            </a>
                        </div>

                        <?php endforeach ?>

                    </div>


                    <div hidden>
                        <div class=""  style="margin-bottom: -30px; margin-top: 40px">
                            <small class="">Invite more Friends</small>
                        </div>

                        <div class="divider-horizontal"></div>

                        <div class="invite_row p-b-10 f-ubuntu">
                            <img src="<?php echo base_url()?>img/icons/Facebook.png" class="m-r-5">
                            Invite using Facebook
                        </div>


                        <div class="invite_row p-b-10 f-ubuntu">
                            <img src="<?php echo base_url()?>img/icons/Twitter.png" class="m-r-5">
                            Invite using Twitter
                        </div>

                    <div class="invite_row">
                        <img src="<?php echo base_url()?>img/icons/Google-+.png">
                        Invite using Google+
                    </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- mobile search modal begins here -->

<div id="mobileSearch" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px">

        <!-- Modal content-->
        <div class="modal-content no-border-radius">

            <div class="modal-body">
                <div class="searchZippr">
                    <h4>Type your search and hit enter</h4>
                    <div class="form-group no-margin-xs">
                        <input class="width-100 search-control" placeholder="Username, Competition, Photo title here" type="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!--<script type="text/javascript" src="--><?php //echo base_url()?><!--js/jquery-1.2.6.min.js"></script>-->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script type="text/javascript" src="<?php echo base_url()?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.livequery.js"></script>
<script type="text/javascript">

    function clearjQueryCache(){
        for (var x in jQuery.cache){
            delete jQuery.cache[x];
        }
    }


    $(document).ready(function() {

        $('.buttons > a').livequery("click",function(e){

            var parent  = $(this).parent();
            var getID   =  parent.attr('id').replace('button_','');


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



        $('.fav2 > a').livequery("click",function(e){

            var parent  = $(this).parent();
            var getID   =  parent.attr('id').replace('fav_','');

            //$.post("<?php echo base_url()?>follow/following/"+getID, {
            $.post("<?php echo base_url()?>ajax_link/fav/"+getID, {

            }, function(response){

                $('#fav_'+getID).html($(response).fadeIn('slow'));
            });
        });
    });




    window.onscroll = function() {myFunction()};

    var right_var = document.getElementById("right_var");
    var sticky_var = right_var.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky_var) {
            right_var.classList.add("sticky_var")
        } else {
            right_var.classList.remove("sticky_var");
        }
    }
</script>



</body>
</html>