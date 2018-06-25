<style type="text/css">
    .borderNone{
        border: none !important;
    }
</style>

<script type="text/javascript">



</script>

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
                        <a class="borderNone">
                            <small class="text-center">
                                Active Challenges
                                <div class="countCircle teal">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php
                            $today = date('Y-m-d');
                            $this->db->where("challenge_close_date > '$today'");
                            echo $this->db->count_all_results('challenges');

                            ?>
                        </a>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a>
                            <small class="text-center">
                                Closed Challenges
                                <div class="countCircle dark-magenta">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php
                            $today = date('Y-m-d');
                            $this->db->where("challenge_close_date < '$today'");
                            echo $this->db->count_all_results('challenges');

                            ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a>
                            <small class="text-center">
                                Challenges Entries
                                <div class="countCircle orange">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php
                            $this->db->where("entry_type='challenge'");
                            echo $this->db->count_all_results('entries_submited');

                            ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a>
                            <small class="text-center">
                                Total Challenges
                                <div class="countCircle green">
                                    <i class="fa- fa"></i>
                                </div>
                            </small>
                            <?php echo $this->db->count_all_results('challenges'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="theme_section">
                <div class="row">
                    <div class="col-lg-12 col-md-12">



                        <div class="th_manage_user">
                            <h3 class="th_title">Challenges Lists</h3>

                            <?php if(isset($_GET['action'])){


                                echo "<div class='alert alert-danger text-white'><a class='close' data-dismiss='alert'>X</a> Member contest deleted successfully </div>";

                            }?>


                            <div class="table-responsive">
                                <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Challenges Name</th>
                                        <th>Grand Winner Price</th>
                                        <th>People's Choice Price</th>
                                        <th>Submission Close Date</th>
                                        <th>Voting Start Date</th>
                                        <th>Status</th>
                                        <th class="action">Action</th>
                                    </tr>
                                    <thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Challenges Name</th>
                                        <th>Grand Winner Price</th>
                                        <th>People's Choice Price</th>
                                        <th>Submission Close Date</th>
                                        <th>Voting Start Date</th>
                                        <th>Status</th>
                                        <th class="action">Action</th>
                                    </tr>
                                    <tfoot>
                                    <tbody>

                                    <?php
                                    $no =1;
                                    foreach($getChallenge as $challenge):?>
                                        <?php
                                        $timestampStart = strtotime($challenge['challenge_start_date']);
                                        $formattedStartDate = date('F d, Y', $timestampStart);

                                        $e1 = strtotime($challenge['challenge_start_date']);
                                        $e2 = ceil(($e1 - time())/60/60/24);

                                        //vote end
                                        $timestampClose = strtotime($challenge['challenge_close_date']);
                                        $formattedCloseDate = date('F d, Y', $timestampClose);

                                        //remaining date
                                        $d1=strtotime($challenge['challenge_close_date']);
                                        $d2=ceil(($d1-time())/60/60/24);

                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td class="text-left" style="text-align: left !important;"><img src="<?php echo base_url('uploads/challenges/'.$challenge['challenge_banner'])?>" width="30"> <?php echo $challenge['challenge_name'] ?></td>
                                            <td><?php echo $challenge['winner_selection'] ?> </td>
                                            <td><?php echo $challenge['people_choice'] ?> </td>
                                            <td><?php echo $formattedStartDate; ?> <span class="text-red"><?php if($e2 <=0){echo ' (0 day left)';}else{ echo ' ('.$e2.' days left)';} ?></span></td>
                                            <td><?php echo $formattedCloseDate; ?> <span class="text-red"><?php if($d2 <=0){echo ' (0 day left)';}else{ echo ' ('.$d2.' days left)';} ?></span> </td>
                                            <td><?php if($e2 <= 0 && $d2 <=0){ echo '<div class="btn btn-danger f-s-12 btn-xs no-border-radius">Closed</div>';} elseif($e2>=1){ echo '<div class="btn btn-success f-s-12 btn-xs no-border-radius">Entry Open</div>';}elseif($d2>=1){echo '<div class="btn btn-warning btn-xs f-s-12 no-border-radius">Voting Open</div>'; } ?> </td>
                                            <td>
                                                <a href="<?php echo base_url('admin/remove_challenge/'.$challenge['challenge_id']) ?>" title="<?php echo $challenge['challenge_id']?>" class="btn btn-danger btn-xs f-s-12 no-border-radius">Suspend </a>
                                                <a target="_blank" href="<?php echo base_url('challenges/check/'.$challenge['challenge_id']) ?>" class="btn btn-primary btn-xs f-s-12 no-border-radius">view</a>
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
