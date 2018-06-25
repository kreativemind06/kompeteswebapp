<?php foreach($getContest as $contest)

?>

<section class="content" style="margin-top: 55px">

    <style type="text/css">
        .contest-bg{
            background: linear-gradient(60deg, rgba(100,0,0,0.5), rgba(0,0,70,.3)), url("<?php echo base_url('uploads/contests/'.$contest['contest_picture'])?>");
            background-attachment: fixed;
            min-height: 300px;
            background-position: center;
            background-size: cover;
            padding-top: 40px;
            font-family: 'Ubuntu', sans-serif;
        }
        .contest-foot{
            background: linear-gradient(60deg, rgba(100,0,0,0.5), rgba(0,0,70,.3)), url("<?php echo base_url('uploads/contests/'.$contest['contest_picture'])?>");
            min-height: 300px;
            background-position: center;
            background-size: cover;
            padding-top: 40px;
            font-family: 'Ubuntu', sans-serif;

        }
    </style>


    <div class="contest-bg" style="">

        <div class="container-fluid">
            <h1 class="text-center" style="color: #fff; font-family: sans-serif;font-weight: 700;">Winners of <?php echo $contest['contest_name'] ?> <br> Photo Contest</h1>
            <!--<h5 class="text-center text-white"><?php /* echo $contest->contest_grand_price */?> and more</h5>-->
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
                    <li style="" class="pull-right"><a href="<?php echo base_url('contests/entries/'.$contest['contest_id'])?>"> Entries </a> </li>
                    <li style="" class="pull-right active-bottom"><a href="#"> Winners </a> </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="container-fluid" style="margin-bottom: 30px;margin-top: 20px; padding: 0">


        <?php
        $contestID = $contest["contest_id"];
        $this->db->where("contest_id='$contestID'");
        $getContestComp = $this->db->get("contest_price_picture")->result();

        foreach($getContestComp as $contestComp)?>

        <?php

            //get username

        $this->db->where("entry_id='$contestID'");
        $this->db->from("prize_won");
        $this->db->join("userz","userz.user_id = prize_won.user_id");
        //$this->db->count_all_results();
        $getPrize = $this->db->get()->result_array();

        ?>


        <div class="col-sm-4" style="margin: 0;">

            <div class="" style="height:300px;background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url(<?php echo base_url('uploads/medium_thumb/'.$getContest[0]['picture_name'])?>);background-size: cover">


                <div class="text-center p-t-40">

                    <img src="<?php if(!empty($getPrize[0]['picture'])){echo base_url('users_photo/'.$getPrize[0]['picture']);}else{ echo base_url('users_photo/avatar.png');}?>" width="100" class="img-circle ">

                    <p class="text-white f-s-18 p-t-10">

                        <a class="text-white" href="<?php echo base_url('profile/check/'.$getPrize[0]['user_id'])?>"> <?php echo $getPrize[0]['username'] ?></a>
                        <br>
                        <span class="f-ubuntu">Won <?php echo $contestComp->contest_1st_price ?></span>
                    </p>
                </div>
            </div>


            <div class="contest-grid-price contest-price-row bg-aqua-gradient" style="">
                <div class="contest-pics" style="">
                    <img src="<?php echo base_url('uploads/contests/'.$contestComp->contest_1st_picture)?>" width="100%" class="img-circle">
                </div>
                <div class="contest-price text-center">
                    <h3 class="text-center text-white"><?php echo $contestComp->contest_1st_price ?></h3>

                    <ul>
                        <?php
                        //$firstReward = $contestComp->first_reward;
                        $expReward = explode(',', $contestComp->first_reward);

                        for($f=0; $f<count($expReward); $f++):
                            ?>
                            <li><?php echo $expReward[$f]?></li>
                        <?php endfor ?>
                    </ul>
                </div>
            </div>
        </div>



        <div class="col-sm-4" style="margin: 0;">
            <div class="" style="height:300px;background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url(<?php echo base_url('uploads/medium_thumb/'.$getContest[1]['picture_name'])?>);background-size: cover">
                <div class="text-center p-t-40">
                    <img src="<?php if(!empty($getPrize[1]['picture'])){echo base_url('users_photo/'.$getPrize[1]['picture']);}else{ echo base_url('users_photo/avatar.png');}?>" width="100" class="img-circle ">

                    <p class="text-white f-s-18 p-t-10">

                        <a class="text-white" href="<?php echo base_url('profile/check/'.$getPrize[1]['user_id'])?>"> <?php echo $getPrize[1]['username'] ?></a>
                        <br>
                        <span class="f-ubuntu">Won <?php echo $contestComp->contest_2nd_price ?></span>
                    </p>
                </div>
            </div>
            <div class="contest-grid-price contest-price-row bg-maroon-gradient">
                <div class="contest-pics">
                    <img src="<?php echo base_url('uploads/contests/'.$contestComp->contest_2nd_picture)?>" width="100%" class="img-circle">
                </div>

                <div class="contest-price text-center">
                    <h3 class="text-center text-white"><?php echo $contestComp->contest_2nd_price ?> </h3>
                    <ul>
                        <?php
                        //$firstReward = $contestComp->first_reward;
                        $expSReward = explode(',', $contestComp->second_reward);

                        for($s=0; $s<count($expSReward); $s++):

                            ?>
                            <li><?php echo $expSReward[$s]?></li>

                        <?php endfor ?>
                    </ul>
                </div>
            </div>
        </div>



        <div class="col-sm-4">
            <div class="" style="height:300px;background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url(<?php echo base_url('uploads/medium_thumb/'.$getContest[2]['picture_name'])?>);background-size: cover">


                <div class="text-center p-t-40">

                    <img src="<?php if(!empty($getPrize[2]['picture'])){echo base_url('users_photo/'.$getPrize[2]['picture']);}else{ echo base_url('users_photo/avatar.png');}?>" width="100" height="100" class="img-circle">

                    <p class="text-white f-s-18 p-t-10">

                       <a class="text-white" href="<?php echo base_url('profile/check/'.$getPrize[2]['user_id'])?>"> <?php echo $getPrize[2]['username'] ?></a>
                        <br>
                        <span class="f-ubuntu">Won <?php echo $contestComp->contest_3rd_price ?></span>
                    </p>
                </div>

            </div>
            <div class="contest-grid-price contest-price-row bg-purple-gradient" style="">
                <div class="contest-pics">
                    <img src="<?php echo base_url('uploads/contests/'.$contestComp->contest_3d_picture)?>" class="img-circle" width="100%">
                </div>
                <div class="contest-price text-center">
                    <h3 class="text-center text-white"><?php echo $contestComp->contest_3rd_price ?></h3>
                    <ul>
                        <?php
                        //$firstReward = $contestComp->first_reward;
                        $expTReward = explode(',', $contestComp->third_reward);

                        for($t=0; $t<count($expTReward); $t++):

                            ?>
                            <li><?php echo $expTReward[$t]?></li>

                        <?php endfor ?>
                    </ul>
                </div>
            </div>
        </div>


    </div>








    <div class="contest-foot">

        <h4 class="text-center text-white">Partners & Brands</h4>
        <p class="text-center text-white" style="font-size: 20px"> Collaborate with millions of creative photographers to increase your reach and find awesome & original content. <a href="">Learn more!</a> </p>

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
                <p>Click the photo(s) you'd like to submit or <a href="<?php echo base_url('upload')?>" class="btn btn-xs btn-success">Upload</a> </p>
            </div>

            <div class="p-l-2-" style="min-height: 50px;background: #d5d5d5"></div>
            <?php echo form_open_multipart('contests/submit_entry/'.$this->uri->segment(3))?>
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
                                    <input type="hidden" name="entry_type" value="contest">
                                    <input type="submit" value="Submit" class="btn btn-success btn-sm no-border-radius">Submit</input>

                                    By entering this challenge you accept Komptes's Terms of Use
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