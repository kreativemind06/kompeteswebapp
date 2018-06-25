<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/circle.css')?>">
<style>
    .c100:after {
        background: none !important;
    }
</style>
<section class="content" style="margin-top: 50px;padding: 0;">

    <div class="bg-white">



        <div class="bg-white" style="background: #fff">
            <h4 class="text-center f-Roboto-Condensed m-0 bg-white">Choose a contest and start voting</h4>

            <div class="pull-right hidden-xs" style="min-height: 50px; margin-top: -52px">
                <ul class="nav nav-tabs" style="width:;">
                    <li><a href="<?php echo base_url('vote')?>" class="text-black"> Contest </a> </li>
                    <li class="no-border-radius text-black" style="width:;border-bottom: 2px solid #f00"><a class="text-black" href="<?php echo base_url('vote/challenge')?>"> Member Contest </a> </li>
                </ul>
            </div>
        </div>


        <div class="visible-xs" style="min-height: 50px;">
            <ul class="nav nav-tabs text-center" style="width:; border-bottom: 2px solid #f00">
                <li style="width: 50%"><a href="<?php echo base_url('vote')?>" class="text-black"> Contest </a> </li>
                <li class="no-border-radius bg- text-black" style="width:50%;border-bottom: 2px solid #f00"><a class="text-black" href="<?php echo base_url('vote/challenge')?>"> Member Contest </a> </li>
            </ul>
        </div>

        <?php foreach($getVote as $votelist):?>
            <?php
            $timestampStart = strtotime($votelist['challenge_start_date']);
            $formattedStartDate = date('F d', $timestampStart);

            //vote end
            $timestampClose = strtotime($votelist['challenge_close_date']);
            $formattedCloseDate = date('F d, Y', $timestampClose);

            //remaining date
            $d1=strtotime($votelist['challenge_close_date']);
            $d2=ceil(($d1-time())/60/60/24);

            ?>
            <!-- Contest Row for voting Starts From Here -->
            <div class="contest-vote-row m-b-1 p-0 col-sm-6" style="margin: 0px 0px 1px 0px !important;">
                <div class="show-image" style="min-height: 200px">
                    <a class="" href="<?php echo base_url('vote/info/'.$votelist['challenge_id'])?>">
                        <div class="text-center image-gradient" style="height: 400px;background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.4)), url('<?php echo base_url('uploads/challenges/'. $votelist['challenge_banner'])?>');background-size: cover;background-position: center;">
                            <!--
                                Please note that the p100 Below represent the percentage rate for the progress level
                                 The maximum day left that should be showing should be 10 Days
                              -->
                            <?php

                            $countPercent = $d2*10;
                            if($countPercent >=100){
                                $percentageLevel = 100;
                            }
                            else{
                                $percentageLevel = $countPercent;
                            }
                            ?>

                            <div class="c100 p<?php echo $percentageLevel ?> pull-left m-l-20 m-t-20" style="background: none !important;">
                            <span class="text-center p-t-30 " style="line-height: 1em">
                                <b class="f-s-30 t-c-white"><?php echo $d2 ?></b>
                                <br>
                                <b class="f-s-12 t-c-white" style="margin-top: ">Days left</b>
                            </span>

                                <div class="slice" style="background: none !important;">
                                    <div class="bar" style="background: none !important;"></div>
                                    <div class="fill" style="background: none !important;"></div>
                                </div>
                            </div>
                            <h3 class="t-c-white text-center " style="">
                                <?php echo $votelist['challenge_name']?>
                            </h3>
                        </div>

                        <div class="m-0" >
                            <label class="linkBorder label" style="position: relative;margin-bottom: -40px;">
                                Vote Now
                            </label>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Contest Row for voting Ends Here -->
        <?php endforeach ?>


    </div>



</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src="<?php echo base_url()?>js/jquery.masonry.js"></script>

<script>
    $(function(){

        var $container = $('#photo_wrapper');

        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : '.photo_row'
            });
        });

    });


</script>
</body>
</html>
