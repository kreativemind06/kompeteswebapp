<style type="text/css">
    .borderNone{
        border: none !important;
    }
</style>
<script type='text/javascript'>

    window.seconds = 15;
    window.onload = function()
    {
        if(window.seconds != 0)
        {
            document.getElementById('secondsDisplay').innerHTML = '' +
                window.seconds + ' second' + ((window.seconds > 1) ? 's' : '');
            window.seconds--;
            setTimeout(window.onload, 1000);
        }
        else
        {
            window.location = "<?php echo base_url('admin/vote')?>";
        }
    }
</script>

<div class="main_body">
    <!-- add user modal start -->
    <!-- user content section -->
    <div class="theme_wrapper">
        <div class="container-fluid">
            <?php echo $success ?>
            <div class="col-sm-6">
                <div class="rightWhiteBlock p-0" style="background: #f9f9f9; overflow-y: scroll; max-height: 700px">
                    <h4 class="f-s-16 m-t-0 m-b-10 p-l-10 p-t-5">Voting Rank</h4>
                <?php

                $no =1;

                foreach ($query->result() as $row):?>
                <?php
                $picture_id = $row->picture_id;

                $this->db->select('*');
                $this->db->where("picture_id = '$picture_id'");
                $this->db->from('uploads');
                $this->db->join("userz", "userz.username = uploads.username");
                $getPhotoInfo =  $this->db->get()->result();
                foreach($getPhotoInfo as $info)

                ?>
                <div class="col-sm-6">
                    <div class="profile-grid-block">
                        <a href="<?php echo base_url('photos/check/'.$info->picture_id)?>" target="_blank">
                            <div class="grid-image">
                                <img src="<?php echo base_url('uploads/medium_thumb/'.$info->picture_medium_name)?>" width="100%" style="height: 200px">
                            </div>
                        </a>
                    <div class="text-right text-white f-s-30 p-l-10 p-r-10" style="margin-top: -150px; margin-bottom: 100px ; z-index: 999"><?php echo ceil(($row->c / $totalVotex->vote)*100).'%'; ?></div>
                    <div class="grid-user-content">
                        <a href="<?php echo base_url('profile/check/'.$info->user_id)?>" target="_blank">
                                <div class="grid-user-picture">
                                    <img src="<?php if(!empty($info->picture)){echo base_url('users_photo/'.$info->picture);}else{echo base_url('users_photo/avatar.png');}?>" class="img-thumbnail" width="100">
                                </div>

                                <h5 class="text-center">Photo ID (<?php echo $row->picture_id?>)<br> by <br> <?php echo $info->username ?></h5>
                        </a>
                        <div class="text-center"><a href="<?php echo base_url('profile/check/'.$info->user_id)?>">

                                </a>
                            <a class="btn btn-danger no-border-radius">
                                <?php echo $row->c .' Votes'?>
                            </a>

                            </div>

                        </div>

                    </div>
                </div>

                <?php endforeach ?>
                    <div class="clearfix"></div>
                    </div>
            </div>

            <div class="col-sm-6">
                <div class="rightWhiteBlock">
                    <h4 class="f-s-16 m-t-0 m-b-10">Contest Information</h4>
                    <div style="min-height:300px ; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url(<?php echo base_url('uploads/contests/'.$contestInfo->contest_picture) ?>); background-size: cover">
                        <h5 class="text-white text-center m-0 p-t-40 "><?php echo $contestInfo->contest_name .' Contest'?></h5>
                        <h6><?php //$contestInfo-> ?></h6>
                    </div>

                    <div class="table-responsive">
                        <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">

                            <tr>
                                <td>Contest Name</td>
                                <td><?php echo $contestInfo->contest_name ?></td>
                            </tr>
                            <tr>
                                <td>No of Entries</td>
                                <td><?php echo $countEntry?></td>
                            </tr>
                            <tr>
                                <td>No of Vote</td>
                                <td><?php echo $totalVotex->vote ?></td>
                            </tr>

                            <tr>
                                <td>Category</td>
                                <td><?php echo $contestInfo->category ?></td>
                            </tr>

                            <tr>
                                <td><?php echo $contestInfo->contest_1st_price ?></td>
                                <td><?php echo $contestInfo->first_reward ?></td>
                            </tr>

                            <tr>
                                <td><?php echo $contestInfo->contest_2nd_price ?></td>
                                <td><?php echo $contestInfo->second_reward ?></td>
                            </tr>

                            <tr>
                                <td><?php echo $contestInfo->contest_3rd_price ?></td>
                                <td><?php echo $contestInfo->third_reward ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="rightWhiteBlock">
                    <h4 class="f-s-16 m-t-0 m-b-10">Voting Rank</h4>
                    <div class="table-responsive">
                        <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                            <thead>
                            <th>#</th>
                            <th>Picture ID</th>
                            <th>Picture Owner</th>
                            <th>Vote</th>
                            </thead>
                            <tfoot>
                            <th>#</th>
                            <th>Picture ID</th>
                            <th>Picture Owner</th>
                            <th>Vote</th>
                            </tfoot>
                            <tbody>
                            <?php

                            $no =1;

                            foreach ($query->result() as $row):?>
                                <?php
                                $picture_id = $row->picture_id;

                                $this->db->select('*');
                                $this->db->where("picture_id = '$picture_id'");
                                $this->db->from('uploads');
                                $this->db->join("userz", "userz.username = uploads.username");
                                $getPhotoInfo =  $this->db->get()->result();
                                foreach($getPhotoInfo as $info)

                                    ?>
                                    <tr>
                                    <td><?php echo $no++ ?></td>
                                <td><?php echo $info->picture_id ?></td>
                                <td><?php echo  $info->username ?></td>
                                <td><?php echo $row->c ?></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="rightWhiteBlock">
                    <h4 class="f-s-16 m-t-0 m-b-10">Award Prize to the Winners</h4>
                    <?php echo form_open()?>

                    <?php echo $success ?>
                    <div class="form-group">
                        <?php echo form_error('award1')?>
                        <label><?php echo $contestInfo->contest_1st_price .' Award' ?></label>
                        <input type="text" class="form-control" name="award1" value="<?php echo set_value('award1')?>" placeholder="Enter Picture ID for <?php echo $contestInfo->contest_1st_price ?>" required>
                    </div>

                    <div class="form-group">
                        <?php echo form_error('award2')?>
                        <label><?php echo $contestInfo->contest_2nd_price .' Award' ?></label>
                        <input type="text" class="form-control" name="award2" value="<?php echo set_value('award2')?>"  placeholder="Enter Picture ID for <?php  echo $contestInfo->contest_2nd_price ?>" required>
                    </div>

                    <div class="form-group">
                        <?php echo form_error('award3')?>
                        <label><?php echo $contestInfo->contest_3rd_price .' Award' ?></label>
                        <input type="text" class="form-control" name="award3" value="<?php echo set_value('award3')?>" placeholder="Enter Picture ID for <?php echo $contestInfo->contest_3rd_price ?>" required>
                    </div>

                    <div class="form-group">

                        <input type="hidden" name="entry_id" value="<?php echo $this->uri->segment(3)?>" required>
                        <input type="hidden" name="entry_name" value="<?php echo $contestInfo->contest_name ?>" required>

                        <input type="submit" class="btn btn-danger no-border-radius" style="width:100%" value="Award Winners">
                    </div>


                    <?php echo form_close()?>

                </div>
            </div>





        </div>
    </div>
</div>
