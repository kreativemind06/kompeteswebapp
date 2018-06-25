<section class="content" style="margin-top: 55px;padding: 0;">

    <div class="challenge-static-bg">
        <div class="col-sm-8 col-sm-offset-2 text-center ">
            <h3 class="f-raleway text-white f-w-600">Launch your own contest!</h3>
            <p class="text-white f-s-22 f-raleway">Got an interesting idea?</p>
            <a href="<?php echo base_url('challenges/start')?>" class="btn btn-lg btn-default no-border-radius">Create Contest</a>
        </div>
    </div>


    <div class="challenge-row-text">
        <div class="col-sm-8 col-sm-offset-2">
            <h5 class="text-center f-ubuntu f-w-200">
                Each contest is created by a member of the Kompetes community
                Choose a contest to enter


                <!--Each peer photo challenge was created by a fellow photographer with a creative spark.
                Join a challenge, dive in and share your creativity!-->
            </h5>
        </div>
    </div>

    <div class="challenge-row-text" style="background: #fafafa">

        <div class="container-fluid">
            <div class="row">

                <?php foreach($getChallenge as $challenges):?>


                <div class="col-sm-3">
                    <div class="profile-grid-block">
                        <a href="<?php echo base_url('challenges/check/'.$challenges['challenge_id'])?>">
                            <div class="grid-image">
                                <img src="<?php echo base_url('uploads/challenges/'.$challenges['challenge_banner'])?>" width="100%">
                            </div>
                        </a>
                        <div class="grid-user-content">
                            <a href="<?php echo base_url('challenges/check/'.$challenges['challenge_id'])?>">

                                <?php

                                $uploadUserID= $challenges['user_id'];
                                $this->db->where("user_id='$uploadUserID'");
                                $userInfo = $this->db->get('userz')->result_array();

                                foreach($userInfo as $userInfo):

                                ?>

                                <div class="grid-user-picture">
                                    <img src="<?php if(!empty($userInfo['picture'])){echo base_url('users_photo/'.$userInfo['picture']);}else{ echo base_url('users_photo/avatar.png'); }?>" class="img-circle img-thumbnail" width="100">
                                </div>
                                <h5 class="text-center"><?php echo $challenges['challenge_name']?></h5>
                                <p class="m-0 text-center" style="color: #919191">
                                    <small>By <?php echo $userInfo['username']; ?> </small>
                                </p>

                                    <?php endforeach ?>


                                <p class="m-0 text-center" style="color: #929292">
                                    <?php
                                    $timestampStart = strtotime($challenges['challenge_start_date']);
                                    $formattedStartDate = date('F d', $timestampStart);

                                    //vote end
                                    $timestampClose = strtotime($challenges['challenge_close_date']);
                                    $formattedCloseDate = date('F d, Y', $timestampClose);

                                    //remaining date
                                    $d1=strtotime($challenges['challenge_start_date']);
                                    $d2=ceil(($d1-time())/60/60/24);

                                    ?>
                                    <small>Closes in <?php echo $d2 ?>days</small>
                                </p>
                            </a>
                            <div class="text-center">
                                <a href="<?php echo base_url('challenges/check/'.$challenges['challenge_id'])?>"></a>
                             </div>
                        </div>
                    </div>
                </div>

                <?php endforeach?>

            </div>

            <?php if($countChallenges >= 1):?>

                <div class="text-center" style="margin-top: 120px;margin-bottom: 40px">
                    <a href="<?php echo base_url('challenges/explore/all')?>" class="btn btn-default btn-lg" style="width: 270px;border: 3px solid #f00;border-radius: 20px">View all Member Contests</a>
                </div>
            <?php endif ?>
        </div>


    </div>



</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
</body>
</html>