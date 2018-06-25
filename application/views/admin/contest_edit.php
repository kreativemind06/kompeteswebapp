<style type="text/css">
    .borderNone{
        border: none !important;
    }

    .tagsinput {
        border: 1px solid #ccc;
        background: #fff;
        padding: 6px 6px 0;
        width: 300px;
        overflow-y: auto;
    }
    span.tag {

        display: block;
        float: left;
        padding: 0px 5px 0px 5px;
        text-decoration: none;
        /*background: #1abb9c;*/
        background: #c02f21;
        color: #f1f6f7;
        margin-right: 5px;
        font-weight: 500;
        margin-bottom: 5px;
        font-family: helvetica;
    }
    span.tag a {
        color: #f1f6f7 !important;
    }
    .tagsinput span.tag a {
        font-weight: bold;
        color: #82ad2b;
        text-decoration: none;
        font-size: 11px;
    }
    .tagsinput input {
        width: 80px;
        margin: 0px;
        font-family: helvetica;
        font-size: 12px;
        border: 1px solid transparent;
        padding: 3px;
        background: transparent;
        color: #000;
        outline: 0px;
    }
    .tagsinput div {
        display: block;
        float: left;
    }
    .tags_clear {
        clear: both;
        width: 100%;
        height: 0px;
    }
    .not_valid {
        background: #fbd8db !important;
        color: #90111a !important;
    }
</style>



<?php

foreach($getContest as $contestx);
foreach($getContestPicture as $contestPix);



?>
<div class="main_body">
    <!-- add user modal start -->
    <!-- user content section -->
    <div class="theme_wrapper">
        <div class="container-fluid">
            <div class="" style="z-index: 2; margin-top: 0px;position:relative;">

                <?php echo $success ?>

                <?php echo form_open_multipart() ?>

                <div class="col-sm-6" style="min-height: 400px;">
                    <div class="rightWhiteBlock">
                        <h4 class="f-s-16 m-b-5 m-b-20"> Contest Information </h4>
                        <?php echo form_error('contest_name')?>
                        <div class="form-group">
                            <label>Contest Name</label>
                            <input class="form-control" name="contest_name" value="<?php echo set_value('contest_name',$contestx->contest_name)?>" placeholder="e.g Old Age Picture" required>
                        </div>

                        <?php echo form_error('entry_point')?>
                        <div class="form-group">
                            <label>Entry Point</label>
                            <input class="form-control" value="<?php echo set_value('entry_point', $contestx->entry_price)?>" name="entry_point" placeholder="e.g 300, Free" required>
                        </div>



                        <div class="form-group">
                            <?php echo form_error('submission_ends')?>
                            <label class="">Entry Submission Close Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-th"></span>
                                </div>
                                <input type="date" class="form-control no-border-radius" name="submission_ends" value="<?php echo set_value('submission_ends', $contestx->contest_start_date)?>" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_error('voting_ends')?>
                            <label class="">Voting Close Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-th"></span>
                                </div>
                                <input type="date" class="form-control no-border-radius " name="voting_ends" value="<?php echo set_value('voting_ends', $contestx->contest_close_date)?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_error('category')?>
                            <label class="">
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

                        <div class="form-group">
                            <?php echo form_error('allow_upload')?>
                            <label class="">How many Photo allow per participant for this Contest</label>
                            <select class="form-control" name="allow_upload">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>



                        <div class="control-group">
                            <?php echo form_error('tags')?>
                            <label class="">Tags</label>
                            <div class="">
                                <input id="tags_1" type="text" class="tags form-control" name="tags" value="<?php echo set_value('tags',$contestx->tags)?>"/>
                                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                            </div>
                        </div>

                        <div class="form-group m-t-20">
                            <?php echo form_error('banner')?>
                            <label class="">Add Contest Banner Photo</label>
                            <input type="file" class="form-control" name="banner">
                        </div>

                        <div class="form-group">
                            <?php echo form_error('introduction')?>
                            <label>Contest Introduction</label>
                            <textarea name="introduction" class="form-control" required><?php echo set_value('introduction', $contestx->description)?></textarea>
                        </div>

                        <div class="p-b-40 m-b-40">
                            <input type="submit" class="btn bg-black bg-lg text-white no-border-radius" style="width: 100%" name="contest_update" value="Update Contest Information">
                        </div>



                        <div class="clearfix"></div>

                    </div>
                </div>

                <?php echo form_close()?>

                <div class="col-sm-6" style="min-height: 400px;">

                    <?php echo form_open_multipart()?>
                    <div class="rightWhiteBlock">
                        <h4 class="f-s-16 m-b-5 m-b-20"> Prize Information </h4>

                        <div class="p-10 m-b-20" style="border-top: 3px solid #d70000;border-left: 1px solid #d2d2d2;border-right: 1px solid #d2d2d2;border-bottom: 1px solid #d2d2d2;">
                            <h6 class="m-0 f-s-14 p-l-5" style="border: 1px solid #d2d2d2;background: #f2f2f2"> First Prize Information </h6>
                            <div class="form-group m-t-20">
                                <?php echo form_error('first_prize')?>
                                <label>First Prize Name</label>
                                <input class="form-control" name="first_prize" value="<?php echo set_value('first_prize',$contestPix->contest_1st_price)?>" required>
                            </div>

                            <div class="form-group">
                                <?php echo form_error('first_reward')?>
                                <label>First Reward Information list <small>(separated with comma)</small></label>
                                <input class="form-control" required name="first_reward" value="<?php echo set_value('first_reward', $contestPix->first_reward)?>" placeholder="Type reward information seprated with comma e.g. Cannon Camera, 300 Reward Points, ">
                            </div>

                            <div class="form-group">
                                <?php echo form_error('first_pic')?>
                                <label>Jury Prize Photo</label>
                                <input type="file" class="form-control" name="first_pic">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="first_prize_info" class="btn bg-red text-white no-border-radius m-t-30" style="width: 100%" value="Update First Prize Information">
                            </div>
                        </div>
                    </div>

                    <?php echo form_close()?>


                    <?php echo form_open_multipart()?>
                    <div class="rightWhiteBlock">


                        <div class="p-10 m-b-20" style="border-top: 3px solid #2158a0;border-left: 1px solid #d2d2d2;border-right: 1px solid #d2d2d2;border-bottom: 1px solid #d2d2d2;">
                            <h6 class="m-0 f-s-14 p-l-5" style="border: 1px solid #d2d2d2;background: #f2f2f2"> Second Prize Information </h6>

                            <div class="form-group m-t-20">
                                <?php echo form_error('second_prize')?>
                                <label>Second Prize Name</label>
                                <input class="form-control" name="second_prize" value="<?php echo set_value('second_prize', $contestPix->contest_2nd_price)?>" required>
                            </div>

                            <div class="form-group">
                                <?php echo form_error('second_reward')?>
                                <label>Second Reward Information list <small>(separated with comma)</small></label>
                                <input class="form-control" name="second_reward" value="<?php echo set_value('second_reward', $contestPix->second_reward)?>" placeholder="Type reward information seprated with comma e.g. Cannon Camera, 300 Reward Points," required>
                            </div>

                            <div class="form-group">
                                <label>Second Prize Photo</label>
                                <input type="file" class="form-control" name="second_pic" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="second_prize_info" class="btn bg-blue text-white no-border-radius m-t-30" style="width: 100%" value="Update Second Prize Information">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>


                    <?php echo form_open_multipart()?>
                        <div class="rightWhiteBlock">

                            <div class="p-10 m-b-20" style="border-top: 3px solid #835f9e;border-left: 1px solid #d2d2d2;border-right: 1px solid #d2d2d2;border-bottom: 1px solid #d2d2d2;">
                                <h6 class="m-0 f-s-14 p-l-5" style="border: 1px solid #d2d2d2;background: #f2f2f2"> Third Prize Information </h6>

                                <div class="form-group m-t-20">
                                    <?php echo form_error('third_prize')?>
                                    <label>Third Prize Name</label>
                                    <input class="form-control" name="third_prize" value="<?php echo set_value('third_prize', $contestPix->contest_3rd_price)?>" required>
                                </div>

                                <div class="form-group">
                                    <?php echo form_error('third_reward')?>
                                    <label>Third Reward Information list <small>(separated with comma)</small></label>
                                    <input class="form-control" name="third_reward" value="<?php echo set_value('third_reward', $contestPix->third_reward)?>" placeholder="Type reward information seprated with comma e.g. Cannon Camera, 300 Reward Points," required>
                                </div>

                                <div class="form-group">
                                    <label>Third Prize Photo</label>
                                    <input type="file" class="form-control" name="third_pic" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="third_prize_info" class="btn bg-purple text-white no-border-radius m-t-30" style="width: 100%" value="Update Third Prize Information">
                                </div>
                            </div>
                        </div>
                    <?php echo form_close()?>
                </div>
                <?php echo form_close()?>
            </div>
        </div>
    </div>
</div>

