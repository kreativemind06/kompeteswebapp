<style type="text/css">
    .borderNone{
        border: none !important;
    }
</style>

<div class="main_body">
    <!-- add user modal start -->
    <!-- user content section -->
    <div class="theme_wrapper">
        <div class="container-fluid">


            <?php
            //count all active users
            $this->db->where("status ='0'");
            $active_picture = $this->db->count_all_results('uploads');

            //count all pending users
            $this->db->where("status ='1'");
            $pending_picture = $this->db->count_all_results('uploads');

            //count all disqualified users
            $this->db->where("status ='2'");
            $disq_picture = $this->db->count_all_results('uploads');
            ?>

            <div class="rightWhiteBlock" style="z-index: 2; margin-top: 0px;position:relative;min-height: 120px;">
                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a class="borderNone" href="0">
                            <small class="text-center">
                                Active Photos
                                <div class="countCircle teal">
                                    <i class="fa-user fa"></i>
                                </div>
                            </small>
                            <?php echo $active_picture ?>
                        </a>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="1">
                            <small class="text-center">
                                Pending Photos
                                <div class="countCircle dark-magenta">
                                    <i class="fa-home fa"></i>
                                </div>
                            </small>
                            <?php echo $pending_picture ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="2">
                            <small class="text-center">
                                Disqualified Photos
                                <div class="countCircle orange">
                                    <i class="fa-suitcase fa"></i>
                                </div>
                            </small>
                            <?php echo $disq_picture ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="0">
                            <small class="text-center">
                                Total Users
                                <div class="countCircle green">
                                    <i class="fa-save fa"></i>
                                </div>
                            </small>
                            <?php echo $this->db->count_all_results('uploads') ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="theme_section">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="th_manage_user">
                            <h3 class="th_title">Photo Lists</h3>
                            <div class="table-responsive">
                                <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>category</th>
                                        <th>no of view</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="action">Action</th>
                                    </tr>
                                    <thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>category</th>
                                        <th>no of view</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="action">Action</th>
                                    </tr>
                                    <tfoot>
                                    <tbody>

                                    <?php
                                    $no =1;
                                    foreach($getAllPicture as $picture_list):?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td class="text-left" style="text-align: left !important;"><img src="<?php echo base_url('uploads/small_thumb/'.$picture_list['picture_small_name'])?>" width="25"> by <?php echo $picture_list['username']?></td>
                                            <td><?php echo $picture_list['category']; ?></td>
                                            <td><?php echo $picture_list['view'];?> </td>
                                            <td><?php echo time_elapsed_string($picture_list['date']);?> </td>
                                            <td><?php if($picture_list['status'] =='0'){ echo "<div class='btn btn-success btn-xs'>Active</div>";} elseif($picture_list['status'] =='1'){ echo "<div class='btn btn-warning btn-xs'>Pending</div>";}else{echo "<div class='btn btn-danger btn-xs'>Cancel</div>";}?></td>
                                            <td><a href="<?php echo base_url('photos/check/'.$picture_list['picture_id']) ?>"  target="_new" class="delete" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        </tr>

                                    <?php endforeach ?>
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
