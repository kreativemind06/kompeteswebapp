<?php
$chanllengex = $getChallenge;
$timestampStart = strtotime($chanllengex->challenge_start_date);
$formattedStartDate = date('F d', $timestampStart);

//vote end
$timestampClose = strtotime($chanllengex->challenge_close_date);
$formattedCloseDate = date('F d, Y', $timestampClose);

//voting starting date
$d1=strtotime($chanllengex->challenge_start_date);
$d2=ceil(($d1-time())/60/60/24);

//entry submission end date

$s1=strtotime($chanllengex->challenge_close_date);
$s2=ceil(($s1-time())/60/60/24);


?>

<section class="content" style="margin-top: 50px">

    <style type="text/css">
        .contest-bg{
            background: linear-gradient(60deg, rgba(100,0,0,0.5), rgba(0,0,70,.3)), url("<?php echo base_url('uploads/challenges/'.$getChallenge->challenge_banner); ?>");
            background-attachment: fixed;
            height: 100px;
            background-position: center;
            background-size: cover;
            font-family: 'Ubuntu', sans-serif;

        }
        .contest-foot{
            background: linear-gradient(60deg, rgba(100,0,0,0.5), rgba(0,0,70,.3)), url("<?php echo base_url('uploads/challenges/'.$getChallenge->challenge_banner); ?>");
            min-height: 300px;
            background-position: center;
            background-size: cover;
            padding-top: 40px;
            font-family: 'Ubuntu', sans-serif;

        }
    </style>


    <div class="contest-bg" style="height: 180px !important;">

        <div class="container-fluid text-center">
            <h6 class="" style="color: #fff; font-family: sans-serif;font-weight: 700;"> <?php echo $getChallenge->challenge_name ?></h6>
            <!--<h5 class="text-center text-white">Share your best photos showing vegetable and fruit</h5>-->


            <div class="text-center">

                <?php
                //$contestStart = strtotime($contest->contest_start_date);
                //$currentDate = strtotime(date('Y-m-d'));
                //$contestClose = strtotime($contest->contest_close_date);


                if($d2 >0 && isset($_SESSION['userLogginID'])){?>

                    <a href="#" data-toggle="modal" data-target="#myModal" class="btn bg-red text-white btn-lg no-border-radius">
                        Enter Now
                    </a>

                <?php }elseif(!isset($_SESSION['userLogginID']) && $d2 > 0){?>
                    <a href="<?php echo base_url('login?redirect=challenges/check/'.$chanllengex->challenge_id)?>" class="btn btn- bg-black text-white btn-lg no-border-radius">
                        Login to Enter this contest
                    </a>
                <?php }?>

                <?php if($d2 < 0 and $s2 > 0 || $chanllengex->status =='1'){?>

                    <a href="<?php echo base_url('vote/info/'.$chanllengex->challenge_id)?>" class="btn btn- bg-red btn-lg text-white no-border-radius">
                        Click to Vote
                    </a>

                <?php } elseif($s2 < 0 && $d2 < 0 || $chanllengex->status =='2'){?>

                    <a class="btn btn-danger btn-lg no-border-radius">
                        Contest Closed
                    </a>
                <?php }?>
            </div>



        </div>


    </div>

    <?php echo $success ?>

    <!--<div class="" style="background-color: #fff;">
        <div class="contest-cat-line" style="border-bottom: 1px dotted #fff;padding-top: 10px">
            <strong class="p-l-20"> Entries </strong>

            &lt;!&ndash;<div class="col-sm-6 col-sm-offset-3 text-center">
                <ul class="" style="margin-left: 100px">

                    <li class="label label-warning"><a href=""> New </a> </li>
                    <li class="label label-success"><a href=""> Oldest </a> </li>

                </ul>
            </div>&ndash;&gt;
        </div>
    </div>-->


    <div class="container-fluid" style="min-height: 550px; padding: 0;margin-top: -45px">

        <div id="photo_wrapper" class="photo_wrapper">
            <?php
            foreach($getChallengeEntry as $getEntry):

            ?>
            <div class="photo_row">
                <div class="show-image">
                    <a href="<?php echo base_url("photos/check/".$getEntry['picture_id'])?>">
                        <img src="<?php echo base_url("uploads/small_thumb/".str_replace('_medium','_small',$getEntry['picture_name'])); ?>">
                    </a>

                    <!--<div>
                        <label class="award label label-primary">
                            <i class="fa fa-thumbs-up"></i>
                        </label>
                        <label class="star label label-danger">
                            <i class="fa fa-star"></i>
                        </label>
                    </div>-->
                </div>
            </div>


            <?php endforeach ?>



            <div class="clearfix"></div>

        </div>




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
            <?php echo form_open_multipart('challenges/submit_entry/'.$this->uri->segment(3))?>
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
                                    <input type="hidden" name="entry_type" value="challenge">
                                    <input type="submit" value="Submit" class="btn btn-success btn-sm no-border-radius">Submit</input>

                                    By entering this challenge you accept Kompetes's Terms of Use
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