<?php //echo $_SESSION['realSession'] ?>

<section class="content" style="margin-top: 55px;padding: 0;">
    <style>
        .c100:after {
            background: none !important;
        }

        /*body {
            position: relative;
        }*/
        .affix {
            top: 20px;
            z-index: 9999 !important;
        }


        @media only screen and (max-width: 650px){
            .col-xs-6{
                width: 49.5% !important;
            }

        }

        @media (min-width: 768px) {
            .col-sm-4{
                width: 30.8% !important;
            }
        }

    </style>
    <?php echo form_open_multipart('vote/submit/'.$this->uri->segment(3),array('id'=>'myform', 'name'=>'myform'))?>
        <div class="container-fluid no-padding-xs" style="min-height: 550px; padding: 0;">


            <div class="col-sm-12 p-r-10 no-padding-xs" style="margin: 0;background: #fff">

                <h4 class="m-5 f-raleway">Choose your first favorite and your second favorite</h4>
                <!--<form action="" id="myform" class="form" enctype="multipart/form-data">-->

                    <div id="photo_wrapper" class="photo_wrapper m-t-10" style="border:">
                        <?php
                            $countV1 = 1; $countV2 =1;
                            foreach($getPhotoVote as $getVote):?>
                                <div class="vote_picture no-padding-xs" style="">
                                    <div class="photo_row_voting no-padding-xs">
                                        <input type="checkbox" class="single-checkbox" name="photos[]" value="<?php echo $getVote['picture_id']?>" id="cb<?php echo $countV1++?>" />
                                        <label for="cb<?php echo $countV2++ ?>" class="no-padding-xs" data-vote="" style="">
                                            <img src="<?php echo base_url('uploads/medium_thumb/'.$getVote['picture_name'])?>" class="no-padding-xs" width="926" />
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach
                        ?>

                    </div>

                <div id="myModal" class="modal fade" role="dialog" style="z-index: 999999999999999999 !important;background: #000;opacity: .9">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content no-border-radius" style="margin-top: 280px">
                            <div class="modal-body text-center p-t-0">
                                <button type="submit" value="Submit and Proceed" class="btn btn-danger no-border-radius m-t-20">Submit and Proceed</button>
                                <button type="reset" data-dismiss="modal" class="btn btn- bg-black no-border-radius m-t-20">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

            <div class="col-sm-1 p-0 hidden" style="margin-top: -1px" hidden>
                <nav class="pull-right p-t-20 voteRightView navbar navbar-default navbar-fixed-top" style="position: relative" id="">
                    <div class="userPhotoDP" style="width: 60px;height: 60px;">
                        <img src="<?php if(!empty($userPhoto)){echo base_url("users_photo/".$userPhoto);}else{ echo base_url("users_photo/avatar.png");}?>" class="no-padding-xs">
                    </div>

                    <div class="m-t-25">
                        <?php echo $contestInfo->title ?> Photo Contest
                    </div>


                    <div class="" style="margin-left: -10px;margin-top: 100px">
                        <a href="" class="btn btn bg-black text-white btn-xs no-border-radius">Skip to Next</a>
                    </div>
                </nav>
            </div>
        </div>
    <?php form_close()?>




    <div class="visible">
        <nav class="navbar navbar-default navbar-fixed-bottom voteBottomView" style="background: #fff">
            <div class="container p-b-20">
                <div id="MobileHMenuStick" style="background: #fff">
                    <div class="m-b-10" style="">
                        <div class="userPhotoDP pull-left m-t-5" style="width: 50px;height: 50px;">
                            <img src="<?php if(!empty($userPhoto)){echo base_url("users_photo/".$userPhoto);}else{ echo base_url("users_photo/avatar.png");}?>" class="">
                        </div>
                        <div class="pull-left m-l-10">
                            <?php echo $contestInfo->title ?> Contest
                            <div class="">
                                <a href="<?php echo base_url('contests/entries/'.$contestInfo->contest_challenge_id)?>" class="btn bg-black text-white btn-xs no-border-radius">Browse Gallery</a>
                            </div>
                        </div>


                        <div class="pull-right">
                            <a href="<?php echo base_url('vote/start/'.$contestInfo->contest_challenge_id)?>" class="btn-danger btn btn-xs no-border-radius m-t-m_20">Go to the next image set</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
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