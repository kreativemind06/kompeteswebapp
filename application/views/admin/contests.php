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

            ?>

            <div class="rightWhiteBlock" style="z-index: 2; margin-top: 0px;position:relative;min-height: 120px;">
                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a class="borderNone" href="">
                            <small class="text-center">
                                Active Contest
                                <div class="countCircle teal">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php
                            $today = date('Y-m-d');
                            $this->db->where("contest_close_date > '$today'");
                            echo $this->db->count_all_results('contests');

                            ?>
                        </a>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="1">
                            <small class="text-center">
                                Closed Contest
                                <div class="countCircle dark-magenta">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php
                            $today = date('Y-m-d');
                            $this->db->where("contest_close_date < '$today'");
                            echo $this->db->count_all_results('contests');

                            ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="2">
                            <small class="text-center">
                                Contest Entries
                                <div class="countCircle orange">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php
                            $this->db->where("entry_type='contest'");
                            echo $this->db->count_all_results('entries_submited');

                            ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="0">
                            <small class="text-center">
                                Total Contest
                                <div class="countCircle green">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php echo $this->db->count_all_results('contests'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="theme_section">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="th_manage_user">
                            <h3 class="th_title">Contest List</h3>


                            <?php echo $success ?>

                            <div class="table-responsive">
                                <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contest Name</th>
                                        <th>Grand Price</th>
                                        <th>Entry Price</th>
                                        <th>Submission Close Date</th>
                                        <th>Voting Start Date</th>
                                        <th>Status</th>
                                        <th class="action">Action</th>
                                    </tr>
                                    <thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Contest Name</th>
                                        <th>Grand Price</th>
                                        <th>Entry Price</th>
                                        <th>Submission Close Date</th>
                                        <th>Voting Start Date</th>
                                        <th>Status</th>
                                        <th class="action">Action</th>
                                    </tr>
                                    <tfoot>
                                    <tbody>

                                    <?php
                                    $no =1;
                                    foreach($getContests as $contest):?>
                                        <?php
                                        $timestampStart = strtotime($contest['contest_start_date']);
                                        $formattedStartDate = date('F d, Y', $timestampStart);

                                        $e1 = strtotime($contest['contest_start_date']);
                                        $e2 = ceil(($e1 - time())/60/60/24);

                                        //vote end
                                        $timestampClose = strtotime($contest['contest_close_date']);
                                        $formattedCloseDate = date('F d, Y', $timestampClose);

                                        //remaining date
                                        $d1=strtotime($contest['contest_close_date']);
                                        $d2=ceil(($d1-time())/60/60/24);

                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td class="text-left" style="text-align: left !important;"><img src="<?php echo base_url('uploads/contests/'.$contest['contest_picture'])?>" width="30"> <?php echo $contest['contest_name'] ?></td>
                                            <td><?php echo $contest['contest_grand_price'] ?> </td>
                                            <td><?php echo $contest['entry_price'] ?> </td>
                                            <td><?php echo $formattedStartDate; ?> <span class="text-red"><?php if($e2 <=0){echo ' (0 day left)';}else{ echo ' ('.$e2.' days left)';} ?></span></td>
                                            <td><?php echo $formattedCloseDate; ?> <span class="text-red"><?php if($d2 <=0){echo ' (0 day left)';}else{ echo ' ('.$d2.' days left)';} ?></span> </td>
                                            <td><?php if($e2 <= 0 && $d2 <=0){ echo '<div class="btn btn-danger f-s-12 btn-xs no-border-radius">Closed</div>';} elseif($e2>=1){ echo '<div class="btn btn-success f-s-12 btn-xs no-border-radius">Entry Open</div>';}elseif($d2>=1){echo '<div class="btn btn-warning btn-xs f-s-12 no-border-radius">Voting Open</div>'; } ?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/contest_suspend/'.$contest['contest_id']) ?>" class="btn btn-danger btn-xs f-s-12 no-border-radius">Suspend</a>
                                                <a href="<?php echo base_url('admin/contest_edit/'.$contest['contest_id']) ?>" class="btn btn-warning btn-xs f-s-12 no-border-radius">Edit</a>
                                                <a target="_blank" href="<?php echo base_url('contests/check/'.$contest['contest_id']) ?>" class="btn btn-primary btn-xs f-s-12 no-border-radius">view</a>
                                            </td>
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
