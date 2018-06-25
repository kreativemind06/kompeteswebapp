<style>
<?php
//$USER_ID = $_SESSION['userLogginID'];
$USER_ID = $this->uri->segment(3);
if(empty($USER_ID)){
$USER_ID = $_SESSION['userLogginID'];
}
//get the number of prize won
$this->db->where("user_id = '$USER_ID'");
$countPrizeWon = $this->db->count_all_results('prize_won');
$this->db->where("user_id = '$USER_ID' and entry_type='challenge'");
$countChallenge = $this->db->count_all_results("entries_submited");
$this->db->where("user_id='$USER_ID' AND entry_type='contest'");
$countContest = $this->db->count_all_results("entries_submited");
//get the no of follower
$this->db->where("user_id = '$USER_ID'");
$countFollowers = $this->db->count_all_results('followingx');
//get the no of following
$this->db->where("follower_id = '$USER_ID'");
$countFollowings = $this->db->count_all_results('followingx');
//get all the followings
$this->db->where("user_id = '$USER_ID'");
$getFollowings = $this->db->get("followingx")->result_array();
$countBanner = 1;
$this->db->where("user_id = '$USER_ID'");
$countUploadPicture = $this->db->count_all_results('uploads');
$this->db->where("user_id = '$USER_ID'");
$countUSERID = $this->db->count_all_results('uploads');
if($countUSERID >=1):
$this->db->where("user_id = '$USER_ID'");
$this->db->limit(3);
$this->db->order_by('id','RANDOM');
$getBanner = $this->db->get("uploads")->result_array();
foreach($getBanner as $banner):
?>
.cb-slideshow li:nth-child(<?php echo $countBanner++ ?>) span {
background:linear-gradient(270deg, rgba(0,0,0, 0.7), rgba(0,0,0,0.3)), url("<?php echo base_url('uploads/'.str_replace('_medium','',$banner['picture_medium_name']))?>") !important;
background-image:linear-gradient(270deg, rgba(0,0,0, 0.7), rgba(0,0,0,0.3)), url("<?php echo base_url('uploads/'.str_replace('_medium','',$banner['picture_medium_name']))?>") !important;
background-repeat: no-repeat !important;
background-size: cover !important;
background-position: center !important;
}
<?php endforeach; endif; ?>
.userProile-row2{
border-top: 1px solid #e3e3e3;
-webkit-box-shadow: 0 -7px 1px -3px #f8f8f8 inset;
box-shadow: 0 -7px 1px -3px #f8f8f8 inset;
border: 1px solid #e3e3e3;
border-bottom: 1px solid #bbb;
background: #fff;
}
</style>
<section class="content" style="margin-top: 40px;padding: 0;">
    <?php if($countUSERID >=1){?>
    <div class="container-fluid" style="height: 700px !important;position: relative">
        <div class="userProfileBg p-t-30">
            <ul class="cb-slideshow" style="">
                <li style="display: block"><span></span><div> </div></li>
                <li style="display: block"><span></span><div> </div></li>
                <li style="display: block"><span></span><div> </div></li>
            </ul>
        </div>
    </div>
    <div class="userProfileBlock p-t-40 m-b-30" style="margin-top: -600px">
        <div class="text-center" style="margin-top: 50px;">
            <img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$profileUser->picture);}else{ echo base_url('users_photo/avatar.png');}?>" height="120" style="height: 120px" class="img-circle img-responsive img-thumbnail">
        </div>
        <h4 class="text-center userName text-white" style="color: #49e906">
        <?php if(!empty($profileUser->firstname)){ echo $profileUser->firstname. ' '. $profileUser->lastname;}else{ echo $profileUser->username; }?>
        </h4>
        <?php if(isset($_SESSION['userLogginID']) && $USER_ID == $_SESSION['userLogginID']):?>
        <div class="profile-edit-link text-center" style="border-color: red">
            <a href="<?php echo base_url('profile/update')?>" class="text-center text-white" style="border-color: red">
                Profile Settings
            </a>
        </div>
        <?php endif ?>
    </div>
    <?php }else{?>
    <div class="userProfileBg p-t-30" style="background: linear-gradient(80deg, rgba(0,0,0, 0.7), rgba(0,0,0,0.3)), url('<?php echo base_url()?>photo/baby.jpg')">
        <div class="userProfileBlock p-t-40">
            <div class="text-center" style="margin-top: 50px;">
                <img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$profileUser->picture);}else{ echo base_url('users_photo/avatar.png');}?>" height="120" style="height: 120px" class="img-circle img-responsive img-thumbnail">
            </div>
            <h4 class="text-center userName text-white" style="color: #49e906">
            <?php if(!empty($profileUser->firstname)){ echo $profileUser->firstname. ' '. $profileUser->lastname;}else{ echo $profileUser->username; }?>
            </h4>
            <?php if(isset($_SESSION['userLogginID']) && $USER_ID == $_SESSION['userLogginID']):?>
            <div class="profile-edit-link text-center" style="border-color: red">
                <a href="<?php echo base_url('profile/update')?>" class="text-center text-white" style="border-color: red">
                    Profile Settings
                </a>
            </div>
            <?php endif ?>
        </div>
    </div>
    <?php }?>
    <div class="userProile-row2" style="min-height: 20px">
        <div class="container-fluid">
            <div class="col-sm-8 col-sm-offset-2 no-padding-xs no-margin-xs">
                <?php
                if(!empty($this->uri->segment(3))){
                $pageUserID = '/'.$this->uri->segment(3);
                $pageUserID2 = 'check/'.$this->uri->segment(3);
                }
                else{
                $pageUserID ='';
                $pageUserID2 ='';
                }
                ?>
                <div class="user_profile_menu text-center no-padding-xs no-padding-sm" style="padding-top: 0;margin-top: 10px; margin-bottom: -5px">
                    <ul>
                        <li><a href="<?php echo base_url('profile/'.$pageUserID2) ?>" class="<?php if ($this->uri->segment(2)==''){echo 'active';}?>"><?php echo $countUploadPicture ?> Photos</a></li>
                        <li><a href="<?php //echo base_url('profile/vote'.$pageUserID) ?>?page=#award" class="<?php if ($this->uri->segment(2)=='vote'){echo 'active';}?>"><?php echo $countPrizeWon; ?> Prize Won</a></li>
                        <li><a href="<?php echo base_url('profile/contest'.$pageUserID) ?>?page=#contest" class="<?php if ($this->uri->segment(2)=='contest'){echo 'active';}?>"><?php echo $countContest ?> Contest</a></li>
                        <li class="hidden-xs"><a href="<?php echo base_url('profile/challenges'.$pageUserID) ?>?page=#challenges" class="<?php if ($this->uri->segment(2)=='challenges'){echo 'active';}?>"><?php echo $countChallenge ?> Challenges</a></li>
                        <li class="hidden-xs"><a href="<?php echo base_url('profile/followers'.$pageUserID) ?>?page=#followers" class="<?php if ($this->uri->segment(2)=='followers'){echo 'active';}?>"><?php echo $countFollowers ?> Followers</a></li>
                        <li class="hidden-xs"><a href="<?php echo base_url('profile/following'.$pageUserID) ?>?page=#following" class="<?php if ($this->uri->segment(2)=='following'){echo 'active';}?>">Following <?php echo $countFollowings; ?></a></li>
                        <li class="hidden-xs"><a href="<?php echo base_url('profile/about'.$pageUserID) ?>?page=#about" class="<?php if ($this->uri->segment(2)=='about'){echo 'active';}?>">About</a></li>
                        <li class="dropdown visible-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-ellipsis-h fa-1x"></i></a>
                            <ul class="dropdown-menu no-border-radius" style="margin-left: -120px">
                                <li class="width-100" style=""><a class="" href="<?php echo base_url('profile/challenges'.$pageUserID) ?>?page=#challenges">0 Challenges</a></li>
                                <li class="width-100"><a href="<?php echo base_url('profile/followers'.$pageUserID) ?>?page=#followers"><?php echo $countFollowers ?> Followers</a></li>
                                <li class="width-100"><a href="<?php echo base_url('profile/following'.$pageUserID) ?>?page=#following">Following <?php echo $countFollowings ?></a></li>
                                <li class="width-100"><a href="<?php echo base_url('profile/about'.$pageUserID) ?>?page=#about">About</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="" style="height: 270px; background: #F2F2F2;margin-bottom: -300px !important;"></div>