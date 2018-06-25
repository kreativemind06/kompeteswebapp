<style type="text/css">
    .label :hover{

        background: #f00 ;
        padding: .2em .6em .3em;
        margin: 0 !important;
        text-decoration: none;
        display: ;
        min-width: 80px !important;
        position: ;
    }

    .label2 {

        padding: 10px;
        font-weight: 600;
    }
</style>



<section class="content" style="margin-top: 40px;padding: 0;">

    <div class="p-t-20 m-b-15" style="background: #fff">
        <div class="contest-cat-line " style="border-bottom: 1px dotted #fff;padding-top: 10px">
            <div class="col-sm-8 col-sm-offset-2">
                <ul>
                    <li class="label label- bg-black no-border-radius"><a href="<?php echo base_url('challenges/explore/all')?>"> Explore All</a> </li>
                    <li class="label bg-black bg-black no-border-radius"><a href="<?php echo base_url('challenges/cat/art')?>"> Art</a> </li>
                    <li class="label bg-black no-border-radius"><a href="<?php echo base_url('challenges/cat/photography')?>"> Photography</a> </li>
                    <li class="label label- bg-black no-border-radius"><a href="<?php //echo base_url('challenges/cat/video')?>"> Video </a> </li>
                    <!--<li class="label label-success hidden-xs no-border-radius"><a href="<?php /*echo base_url('contests/cat/discover')*/?>"> Discover </a> </li>
                        <li class="label label-warning hidden-xs no-border-radius"><a href="<?php /*echo base_url('contests/cat/new')*/?>"> New </a> </li>
                        <li class="label bg-aqua-gradient hidden-xs"><a href="<?php /*echo base_url('contests/cat/action')*/?>"> Action </a> </li>
                        <li class="label bg-purple hidden-xs no-border-radius"><a href="<?php /*echo base_url('winner')*/?>"> Winner </a> </li>
                        <li class="label bg-teal-gradient hidden-xs no-border-radius"><a href="<?php /*echo base_url('contests/cat/city')*/?>"> City </a> </li>
-->

                    <li class="bg-black pull-right no-border-radius dropdown" style="margin-right: -10px"><a href="" class="dropdown-toggle label2" data-toggle="dropdown" aria-expanded="false"> Categories ▾ </a>

                        <ul class="dropdown-menu no-border-radius" role="menu" aria-labelledby="dLabel" style="width: 300px;height: 400px">

                            <div class="row">
                                <div class="dropLinks">
                                    <ul class="" style="color: #000;">

                                        <?php foreach($getCategory as $cat):?>
                                            <li><a href="<?php echo base_url('challenges/cat/').$cat['category_name']?>" class=""><?php echo $cat['category_name']?></a></li>
                                        <?php endforeach?>
                                    </ul>
                                </div>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>


    <div class="challenge-row-text" style="background: #fafafa">


        <div class="container-fluid">
            <div class="row">


                <?php foreach ($getChallenge as $challengeItem):?>


                    <?php
                    //get the users picture
                    $user_upload_id = $challengeItem['user_id'];
                    $this->db->where("user_id='$user_upload_id'");
                    $getUserPic = $this->db->get("userz")->result();

                    foreach($getUserPic as $userPic)


                    ?>

                    <?php
                    $timestampStart = strtotime($challengeItem['challenge_start_date']);
                    $formattedStartDate = date('F d', $timestampStart);


                    //vote end
                    $timestampClose = strtotime($challengeItem['challenge_close_date']);
                    $formattedCloseDate = date('F d, Y', $timestampClose);

                    //echo $formattedCloseDate.'<br>';


                    //voting starting date
                    $d1=strtotime($challengeItem['challenge_start_date']);
                    $d2=ceil(($d1-time())/60/60/24);

                    //entry submission end date

                    $s1=strtotime($challengeItem['challenge_close_date']);
                    $s2=ceil(($s1-time())/60/60/24);





                    ?>

                        <div class="col-sm-3">
                    <div class="profile-grid-block">
                        <a href="<?php echo base_url("challenges/check/".$challengeItem['challenge_id'])?>">
                            <div class="grid-image">
                                <img src="<?php echo base_url("uploads/challenges/".$challengeItem['challenge_banner'])?>" width="100%">
                            </div>
                        </a>
                        <div class="grid-user-content">
                            <a href="<?php echo base_url("challenges/check/".$challengeItem['challenge_id'])?>">
                                <div class="grid-user-picture">
                                    <img src="<?php if(!empty($userPic->picture)){echo base_url("users_photo/".$userPic->picture);}else{ echo base_url("users_photo/avatar.png");}?>" class="img-circle img-thumbnail" width="100">
                                </div>
                                <h5 class="text-center"> <?php echo $challengeItem['challenge_name']?> </h5>
                                <p class="m-0 text-center" style="color: #919191">
                                    <small>By <?php echo $userPic->username?> </small>
                                </p>
                                <p class="m-0 text-center" style="color: #929292">
                                    <small><?php if($d2 < 0 and $s2 > 0 ){echo "Click to Vote ";}elseif($s2 < 0 && $d2 < 0 || $challengeItem['status'] =='2'){echo "<div class='text-red text-center'>Closed</div>";}else{ echo "<div class='text-red text-center'>Open</div>";} ?></small>
                                </p>
                            </a>
                            <div class="text-center">
                                <a href="<?php echo base_url("challenges/check/".$challengeItem['challenge_id'])?>"></a>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach ?>

                <?php if($countChallenges <=0):?>

                    <h5 class="f-ubuntu text-center">
                        No Contest Available for Now
                    </h5>
                <?php endif ?>
            </div>
        </div>
    </div>




    <?php if($countChallenges >=1):?>
        <div class="text-center" style="margin-top: 120px;margin-bottom: 40px">
            <a href="#" class="btn btn-default btn-lg" style="width: 270px;border: 3px solid #f00;border-radius: 20px">Load more</a>
        </div>
    <?php endif ?>

        </div>
    </div>



</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
</body>
</html>