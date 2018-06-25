<?php

foreach($getSingleUser as $userInfo);


?>

<style type="text/css">
    .borderNone{
        border: none !important;
    }
</style>

<div class="main_body">
    <!-- add user modal start -->
    <!-- user content section -->
    <div class="theme_wrapper">
        <div class="container-fluid">

            <div class="theme_section">
                <div class="row">


                    <div class="col-sm-3">
                        <div class="profile_view leftWhite">
                            <div class="row">
                                <div class="col-xs-5 col-sm-12 col-md-4">
                                    <div class="picture">

                                        <img width="100%" height="100%" class="img-circle" src="<?php if(!empty($userInfo['picture'])){echo base_url('users_photo/'.$userInfo['picture']);}else{ echo base_url('users_photo/avatar.png');} ?>">
                                    </div>
                                </div>


                                <div class="col-xs-7 col-sm-12 col-md-8">
                                    <div class="pRating" style="padding-right: 10px">
                                        <h5 style="margin-top: 15px;font-size: 18px"><?php if(!empty($userInfo['firstname'])){echo $userInfo['firstname'] .' '. $userInfo['lastname'];}else{ echo $userInfo['username'];}?></h5>


                                        <!-- <p>Total Task Performed <br> <strong>0%</strong></p>-->

                                        <div class="online_status" style="width: 100%; margin-right: 10px;"><b></b> <?php if($userInfo['status'] =='0'){echo 'Verified';}else{ echo "Unverified"; } ?>  </div>
                                    </div>
                                </div>
                            </div>

                            <div class="workStatusList" style=" margin-top: 0px; border-top: none">

                                <ul>
                                    <li><a href="#" data-toggle="modal" data-target="#addCredit" class="label label-primary pull-left text-white m-t-10">Add Credit</a> <span class="text-center"><a href="<?php echo base_url('profile/check/'.$userInfo['user_id'])?>" class="text-red" target="_blank"> Check full page </a></span><span></span></li>
                                    <li><strong>Date of Birth </strong><span><?php echo str_replace('ago','',time_elapsed_string($userInfo['birthday'])); ?></span></li>
                                    <li><strong>Location</strong> <span>,<?php echo $userInfo['city'].', '. $userInfo['state'].', '. $userInfo['country'] ?></span></li>
                                    <li><strong>Email </strong><span><?php echo $userInfo['email']?></span></li>
                                    <li><strong>Member Since </strong><span><?php echo time_elapsed_string($userInfo['date'])?></span></li>
                                    <li><strong><i class="fa fa-facebook"></i> Facebook </strong><span><a href="https://facebook.com/<?php echo $userInfo['facebook']?>" target="_new"><?php echo $userInfo['facebook']?></a></span></li>
                                    <li><strong><i class="fa fa-twitter text-blue"></i> Twitter </strong><span><a href="https://twitter.com/<?php echo $userInfo['twitter']?>" target="_new"><?php echo $userInfo['twitter'] ?></a></span></span></li>
                                    <li><strong><i class="fa fa-instagram text-red"></i> Instagram </strong><span class="clearfix"><a href="https://instagram.com/<?php echo $userInfo['instagram']?>" class="text-right" target="_new"> <?php echo $userInfo['instagram']?></a></span></li>
                                </ul>
                            </div>

                            <a class="btn btn-primary" style="width: 98%; margin-left: 1%; margin-top: 12px;border-radius: 0" href="#" data-toggle="modal" data-target="#changeUser"> <?php if($userInfo['status'] ==0){echo 'Suspend '. $userInfo['username'] ;}else{echo 'Activate ' . $userInfo['username'];}?>'s account</a>
                        </div>
                    </div>



                    <div class="modal fade  theme_modal" id="addCredit" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="margin-top: 100px">

                                <div class="modal-header">
                                    <button class="close" aria-label="close" type="button" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title"> Add credit to <?php echo $userInfo['username']?>'s Account </h4>
                                </div>
                                <div class="modal-body">

                                    <?php echo form_open('admin/add_credit/'.$userInfo['user_id'])?>

                                        <div class="form-group">
                                            <label class="">Credit Unit Point</label>
                                            <input type="text" class="form-control" name="credit" placeholder="e.g 30">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-danger">
                                        </div>

                                    <?php echo form_close() ?>


                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade  theme_modal" id="changeUser" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">


                                <div class="modal-header">
                                    <button class="close" aria-label="close" type="button" data-dismiss="modal"><span aria-hidden="true">×</span></button>

                                    <?php if($userInfo['status'] == 0){?>
                                    <h4 class="modal-title" id="myModalLabel">Are you sure you want to suspend <?php echo $userInfo['username'] ?> ?</h4>

                                    <a class="btn btn-primary" href="<?php echo base_url('admin/suspend_user/'.$userInfo['user_id'])?>">Yes</a>
                                    <a class="btn btn-warning" aria-label="Close" href="#" data-dismiss="modal">No</a>
                                    <?php } else{?>


                                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to Activate <?php echo $userInfo['username'] ?> ?</h4>

                                        <a class="btn btn-primary" href="<?php echo base_url('admin/active_user/'.$userInfo['user_id'])?>">Yes</a>
                                        <a class="btn btn-warning" aria-label="Close" href="#" data-dismiss="modal">No</a>


                                    <?php }?>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-9">

                        <div class="rightWhiteBlock" style="z-index: 2; margin-top: 20px;position:relative;min-height: 120px">
                            <div class="col-sm-3">
                                <div class="blockMenu">
                                    <a class="borderNone" href="">
                                        <small class="text-center">
                                            Media Uploaded
                                            <div class="countCircle teal">
                                                <i class="fa-user fa"></i>
                                            </div>
                                        </small>

                                        <?php
                                            $id = $userInfo['user_id'];
                                            $this->db->where("user_id = '$id'");
                                           echo $countMedia = $this->db->count_all_results("uploads");


                                        ?>


                                    </a>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="blockMenu">
                                    <a href="">
                                        <small class="text-center">
                                            Followers
                                            <div class="countCircle dark-magenta">
                                                <i class="fa-users fa"></i>
                                            </div>
                                        </small>
                                    <?php
                                    $id = $userInfo['user_id'];
                                    $this->db->where("user_id = '$id'");
                                   echo $countFollowera = $this->db->count_all_results('followingx');
                                    ?>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="blockMenu">
                                    <a href="">
                                        <small class="text-center">
                                            Following
                                            <div class="countCircle orange">
                                                <i class="fa-users fa"></i>
                                            </div>
                                        </small>
                                        <?php
                                        $id = $userInfo['user_id'];
                                        $this->db->where("follower_id = '$id'");
                                        echo $countFollowing = $this->db->count_all_results('followingx');
                                        ?>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="blockMenu">
                                    <a href="">
                                        <small class="text-center">
                                            Credit Point
                                            <div class="countCircle green">
                                                <i class="fa-dollar fa"></i>
                                            </div>
                                        </small>
                                        <?php
                                        $id = $userInfo['user_id'];
                                        $this->db->where("user_id = '$id'");
                                        $countCredit = $this->db->count_all_results('credit_subscription');

                                        $this->db->where("user_id = '$id'");
                                        $getCredit = $this->db->get('credit_subscription')->result();
                                        foreach($getCredit as $credit);

                                        //$credit->credit;

                                        if(!empty($countCredit) || $countCredit = false){


                                            echo $credit->credit;
                                        }
                                        else{ echo 0;}
                                        ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php echo $success ?>

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="rightWhiteBlock">
                                    <h4 class="f-s-18 m-t-0">
                                        Challenges Created
                                    </h4>
                                        <div class="text-center">
                                            <?php

                                           {
                                            echo "<div style='font-size: 70px' class='text-center text-red m-t-30 p-t-40 p-b-30'>". $countChallenge ."</div> <div class='text-center f-s-18 m-b-30'>Challenge Created</div> ";
                                            }
                                            if($countChallenge == true){

                                            foreach($getChallenge as $challenge):

                                            ?>


                                            <ul class="tag-style text-center">
                                                <li class="pull-left"><a href="<?php echo base_url('challenges/check/'.$challenge['challenge_id'])?>"><?php echo $challenge['challenge_name'] ?></a> </li>
                                            </ul>


                                            <?php

                                            endforeach;
                                            }
                                            ?>

                                        </div>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="rightWhiteBlock">
                                    <h4 class="f-s-18 m-t-0">Price Won</h4>


                                    <?php
                                    if($countPrizeWon == false){


                                        echo "<div style='font-size: 70px' class='text-center text-red m-t-30 p-t-40 p-b-20'>0</div> <div class='text-center f-s-18'>Prize Won</div> ";
                                    }
                                    else{

                                        foreach($getPrizeWon as $prize):

                                            ?>

                                            <ul class="tag-style">
                                                <li><a href="<?php echo base_url('winner/check/'.$prize['entry_id'])?>"><?php echo $prize['prize_won'] ?></a> </li>
                                            </ul>
                                            <?php

                                        endforeach;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="rightWhiteBlock">
                                    <h4 class="f-s-18 m-t-0">Activities</h4>

                                </div>
                            </div>

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>
</div>