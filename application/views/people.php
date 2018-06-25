
<section class="content" style="margin-top: 40px;padding: 0;">
    <div class="container-fluid no-margin-xs">

        <div class="row">

            <div class="col-sm-11" style="min-height: 400px;">
            <h6 class="f-s-18 text-black m-l-25" style="margin-bottom:0px;border-bottom:1px solid #fff;border-bottom: 1px solid #d2d2d2">People You May Follow</h6>





            <?php

            $userIDD = $_SESSION['userLogginID'];

            foreach($getMoreFollow as $moreFollower):?>

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

                //check if the user is following already

                $this->db->where("follower_id = '$userIDD' AND user_id ='$userzID'");
                $countFollowBack = $this->db->count_all_results('followingx');
                ?>


                <div class="col-sm-4 m-0 p-20" <?php if ($countFollowBack >=1){echo 'hidden';} ?>>
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

                                    <a href="" hidden onclick="clearjQueryCache()">Clear Cache</a>

                                    <div class="body-right">

                                        <?php if ($countFollowBack <=0){?>

                                            <span class="buttons" id="button_<?php echo $moreFollower['user_id'].'-'. $moreFollower['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                <a class="btn follow" href="javascript: void(0)" id="<?php echo $moreFollower['user_id'] ?>" rel="<?php echo $moreFollower['user_id'] ?>">
                                                    <i class="fa fa-user-plus text-red"></i>
                                                    Follow
                                                </a>
                                            </span>

                                        <?php }else{ ?>

                                            <span class="buttons" id="button_<?php echo $moreFollower['user_id'].'-'. $moreFollower['username'].'-'.$_SESSION['userLogginID'].'-'.$username ?>">
                                                <a class="btn follow following" href="javascript: void(0)" id="<?php echo $moreFollower['user_id'] ?>" rel="<?php echo $moreFollower['user_id'] ?>">
                                                    <i class="fa fa-user-plus text-red"></i>
                                                    Following
                                                </a>
                                            </span>

                                        <?php }?>
                                    </div>

                                    <!--                                            <a class="btn btn-success btn-xs m-b-10 bg-red no-border-radius" href="">Follow</a>-->
                                </h5>

                                <div class="text-center col-xs-offset-1 contest-cat-line p-l-10">
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

            <div class="col-sm-1 hidden-xs" style="height: 750px;background: #f2f2f2;position: fixed; right: 0; "></div>
            </div>




        </div>
    </div>





    <div class="visible">
        <nav class="navbar navbar-default navbar-fixed-bottom voteBottomView" style="background: #fff">
            <div class="container p-b-20">
                <div id="MobileHMenuStick" style="background: #fff">
                    <div class="m-b-10" style="">
                        <div class="userPhotoDP pull-left m-t-5" style="width: 50px;height: 50px;">
                            <img src="<?php if(!empty($userPhoto)){echo base_url("users_photo/".$userPhoto);}else{ echo base_url("users_photo/avatar.png");}?>" class="" style="height: 48px">
                        </div>
                        <div class="pull-left m-l-10 p-t-5">
                            <?php echo $username ?>
                            <div class="">
                                <a href="<?php echo base_url('profile')?>" class="btn bg-black text-white btn-xs no-border-radius">Check Profile</a>
                            </div>
                        </div>


                        <div class="pull-right p-t-25">
                            <a href="<?php echo base_url('user/home')?>" class="btn-danger btn btn-xs no-border-radius m-t-m_20">Go to the User Home Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</section>


<!-- Trigger the modal with a button -->

<div id="myModal" class="modal fade no-border-radius" role="dialog">
    <div class="modal-dialog" style=" margin-top: 150px">

        <!-- Modal content-->
        <div class="modal-content no-border-radius m-t-40" style="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="margin-top: -30px">

                    <div class="userPhotoDP pull-right m-t-5" style="width: 50px;height: 50px;">
                        <img src="<?php if(!empty($userPhoto)){echo base_url("users_photo/".$userPhoto);}else{ echo base_url("users_photo/avatar.png");}?>" class="" style="height: 48px">
                    </div>
                    <br>

                    Welcome <?php echo $username ?> .....

                </h4>
            </div>
            <div class="modal-body">
                <p>We have list of People you can follow, check and follow the best people</p>
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
    $("#myModal").modal();



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


            $.post("<?php echo base_url()?>like.php?id="+getID, {

            }, function(response){

                $('#button_'+getID).html($(response).fadeIn('slow'));
            });
        });
    });
</script>

<script>
    $(function(){

        var $container = $('#photo_wrapper');

        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : '.photo_row_voting'
            });
        });

    });

    /* var limit = 2;
     $('input.single-checkbox').on('change', function(evt) {
         if($(this).siblings(':checked').length >= limit) {
             this.checked = false;
         }
     });*/

    function formAutoSubmit(){

        var frm = document.getElementById("form_submit");

        frm.submit();
    }

    $('input[type=checkbox]').change(function(e){
        if ($('input[type=checkbox]:checked').length == 2) {
            $(this).prop('checked', true);

            //$("#myform").submit();
            $("#myModal").modal();

            //document.forms[0].action="vote/submit";
            //document.getElementById("myform").action = "";

            //alert('Welcome');

            //document.getElementById("myform").submit();

            //window.location.href = '<?php //echo base_url('vote/start/'.$contestInfo->contest_id)?>';
            //window.location('vote_start.html')
        }
    });



    $(document).ajaxStart(function() {
//only add progress bar if added yet.
        if ($("#progress").length === 0) {
            $("body").append($("<div><dt/><dd/></div>").attr("id", "progress"));
            $("#progress").width((50 + Math.random() * 30) + "%");
        }
    });

    $(document).ajaxComplete(function() {
//End loading animation
        $("#progress").width("101%").delay(200).fadeOut(400, function() {
            $(this).remove();
        });
    });

</script>



</body>
</html>