<link rel="stylesheet" type="text/css" href="<?php //echo base_url('css/bootstrap-datepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap-datepicker3.css')?>">

<section class="content m-b-40 p-b-40" style="margin-top: 40px; margin-bottom: 40px ; padding: 0;">
    <?php echo form_open_multipart()?>
        <div class="challenge_start">

        <div class="col-sm-8 col-sm-offset-2">
            <?php echo $success ?>
            <h3 class="f-raleway text-white f-w-700 text-center p-b-20">Start your own new Contest!</h3>


            <div class="form-group col-sm-6 col-sm-offset-3">
                <?php echo form_error('challenge_name')?>
                <label class="text-white">
                    Name for the Contest
                </label>
                <input type="text" name="challenge_name" value="<?php echo set_value('challenge_name')?>" class="form-control no-border-radius">
            </div>

            <div class="form-group col-sm-6 col-sm-offset-3">
                <?php echo form_error('category')?>
                <label class="text-white">
                    Select Contest Category
                </label>
                <select name="category" class="form-control m-b-15 no-border-radius">
                    <option value="">-- Select Category --</option>
                   <?php
                        $this->db->where("status='0'");
                        $getCat = $this->db->get('category')->result_array();

                        foreach($getCat as $cat){

                    ?>
                            <option value="<?php echo $cat['category_name']?>"><?php echo $cat['category_name']?></option>


                    <?php } ?>
                </select>
            </div>


            <div class="form-group col-sm-6 col-sm-offset-3">
                <?php echo form_error('voting_start')?>
                <label class="text-white">Submission ends Date</label>
                <div class="input-group">
                    <div class="input-group-addon" style="">
                        <span class="fa fa-th" style=""></span>
                    </div>
                    <input type="text" class="form-control no-border-radius datepicker" name="voting_start" value="<?php echo set_value('voting_start','2018-05-12')?>">
                </div>
            </div>
            <div class="form-group col-sm-6 col-sm-offset-3">
                <?php echo form_error('voting_ends')?>
                <label class="text-white">Voting start and ends Date</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <span class="fa fa-th"></span>
                    </div>
                    <input type="text" class="form-control no-border-radius datepicker" name="voting_ends" value="<?php echo set_value('voting_ends','2018-20-12')?>">

                </div>
            </div>


            <div class="form-group col-sm-6 col-sm-offset-3">
                <?php echo form_error('allow_no')?>
                <label class="text-white">
                    How many Photo/Video allow per participant for this contest
                </label>
                <select name="allow_no" class="form-control no-border-radius">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="form-group col-sm-6 col-sm-offset-3">
                <?php echo form_error('challenge_type')?>
                <label class="text-white">
                    Type of Contest
                </label>
                <select name="challenge_type" class="form-control no-border-radius">
                    <option value="">Select Type</option>
                    <option value="Photo">Photo</option>
                    <option value="Video">Video</option>
                </select>
            </div>




        </div>

        <div class="clearfix"></div>
    </div>

        <div class="challenge-row-text">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="p-l-10 p-r-10 m-t-15 form-row-challenge">
                <div class="form-group m-t-40">
                    <?php echo form_error('file')?>
                    <label>Choose a Contest Banner <small>(JPG for photo or MP4 for video)</small></label><br>
                    <input type="file" name="file" class="form-control no-border-radius">
                </div>
            </div>


            <div class="p-l-10 p-r-10 m-t-15 form-row-challenge">
                <div class="form-group m-t-40">
                    <?php echo form_error('description')?>
                    <label>Write a description about your Contest</label><br>
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>


            <div class="p-l-10 p-r-10 m-t-15 form-row-challenge">
                <div class="form-group m-t-40">
                    <?php echo form_error('winner_point')?>
                    <label>Select the award for your Winner's Selection<small> (You choose the winner)</small></label><br>

                    <div class="row p-l-10">
                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center p-t-40" style="background: none;">
                                <label class="p-b-30">Badges</label>
                                <div class="rewardPrice">Reward Credit </div>
                            </div>
                        </div>
                        <!-- end col-sm-2 -->

                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                             <div class="selectBadge text-center">
                                    <input type="radio" name="winner_point" value="30" id="cb1" />
                                    <label for="cb1"><img src="<?php echo base_url()?>img/badges/png256/014-badge-7.png" /></label>

                                    <div class="rewardPrice"> 30 RC </div>
                             </div>
                        </div>



                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="winner_point" value="60" id="cb2" />
                                <label for="cb2"><img src="<?php echo base_url()?>img/badges/png256/015-badge-6.png" /></label>
                                <div class="rewardPrice"> 60 RC </div>
                            </div>
                        </div>




                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="winner_point" value="100" id="cb3" />
                                <label for="cb3"><img src="<?php echo base_url()?>img/badges/png256/016-badge-5.png" /></label>
                                <div class="rewardPrice"> 100 RC </div>
                            </div>
                        </div>


                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="winner_point" value="150" id="cb4" />
                                <label for="cb4"><img src="<?php echo base_url()?>img/badges/png256/017-medal-2.png" /></label>

                                <div class="rewardPrice"> 150 RC</div>
                            </div>

                        </div>



                        <div class="col-sm-2 col-xs-6 p-r-10 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="winner_point" value="200" id="cb5" />
                                <label for="cb5"><img src="<?php echo base_url()?>img/badges/png256/023-badge-1.png" /></label>


                                <div class="rewardPrice"> 200 RC </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>


            <div class="p-l-10 p-r-10 m-t-15 form-row-challenge">
                <div class="form-group m-t-40">
                    <?php echo form_error('people_choice')?>
                    <label>Select the award for the People's Choice <small> (The winner is selected by voting)</small></label><br>
                    <div class="row p-l-10">
                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center p-t-40" style="background: none;">

                                <label class="p-b-30">Badges</label>


                                <div class="rewardPrice">Reward Credit </div>
                            </div>
                        </div>
                        <!-- end col-sm-2 -->

                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="people_choice" value="30" id="cb6" />
                                <label for="cb6"><img src="<?php echo base_url()?>img/badges/png256/014-badge-7.png" /></label>
                                <div class="rewardPrice"> 30 RC </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="people_choice" value="60" id="cb7" />
                                <label for="cb7"><img src="<?php echo base_url()?>img/badges/png256/015-badge-6.png" /></label>
                                <div class="rewardPrice"> 60 RC </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="people_choice" value="100" id="cb8" />
                                <label for="cb8"><img src="<?php echo base_url()?>img/badges/png256/016-badge-5.png" /></label>
                                <div class="rewardPrice"> 100 RC </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-6 p-r-5 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="people_choice" value="150" id="cb9" />
                                <label for="cb9"><img src="<?php echo base_url()?>img/badges/png256/017-medal-2.png" /></label>
                                <div class="rewardPrice"> 150 RC</div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-6 p-r-10 p-l-0">
                            <div class="selectBadge text-center">
                                <input type="radio" name="people_choice" value="200" id="cb10" />
                                <label for="cb10"><img src="<?php echo base_url()?>img/badges/png256/023-badge-1.png" /></label>
                                <div class="rewardPrice"> 200 RC </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="form-row-challenge p-l-10 p-r-10 m-t-15">
                <div classs="form-group">
                    <?php echo form_error('biography')?>
                    <label class="p-t-20 p-b-10">Fill your Biography </label>
                    <textarea class="form-control" name="biography"><?php echo $userAbout?></textarea>

                </div>
            </div>


            <div class="text-center">
                <div class="m-t-30 m-b-40 text-center" style="margin-top: 50px">
                    <button class="btn btn-danger no-border-radius" type="submit">Submit and Upload</button>
                    <button class="btn btn-default no-border-radius" type="submit">Preview</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close()?>
    <div class="challenge-row-text" style="background: #fafafa">



    </div>



</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="<?php echo base_url()?>js/bootstrap-datepicker.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

<script>
    /*$('.input-daterange input').each(function() {
        $(this).datepicker('');


    });*/

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
</body>
</html>