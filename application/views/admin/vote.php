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


            $this->db->select_sum('vote');
            $this->db->from('votex');
            $this->db->where("entry_id=''");
            $countVote = $this->db->get()->result();
            foreach($countVote as $countVoteNo)

            echo $countVoteNo->vote;

            ?>

            <div class="theme_panel_section">
                <h4 class="th_title">
                    Voting Information
                </h4>
            </div>
            <div class="col-sm-10">

                <div class="rightWhiteBlock" style="z-index: 2; margin-top: 0px;position:relative;min-height: 120px;">
                    <div class="col-sm-3">
                        <div class="blockMenu">
                            <a class="borderNone" href="#">
                                <small class="text-center">
                                    Open Contest Vote
                                    <div class="countCircle teal">
                                        <i class="fa-user fa"></i>
                                    </div>
                                </small>
                                <?php echo $contestVoteOpen ?>
                            </a>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="blockMenu">
                            <a href="#">
                                <small class="text-center">
                                    Closed Contest Vote
                                    <div class="countCircle dark-magenta">
                                        <i class="fa-home fa"></i>
                                    </div>
                                </small>
                                <?php echo $contestVoteClose ?>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="blockMenu">
                            <a href="#">
                                <small class="text-center">
                                    Open Challenge Vote
                                    <div class="countCircle orange">
                                        <i class="fa-suitcase fa"></i>
                                    </div>
                                </small>
                                <?php echo $challengeVoteOpen ?>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="blockMenu">
                            <a href="#">
                                <small class="text-center">
                                    Close Challenge Vote
                                    <div class="countCircle green">
                                        <i class="fa-save fa"></i>
                                    </div>
                                </small>
                                <?php echo $challengeVoteClose ?>
                            </a>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="rightWhiteBlock">
                            <h4 class="f-s-18 m-t-0">Cast Vote <small class="text-right"> (i.e Vote ready to award the winner)</small></h4>


                            <?php

                            $this->db->where('status="1" AND type="contest"');
                            $countCastVote = $this->db->count_all_results('vote_information');
                            ?>

                            <div style='font-size: 70px' class='text-center text-red m-t-30 p-t-40 p-b-20'><?php echo $countCastVote ?> </div> <div class='text-center f-s-18'>Contest Vote ready to be Awarded</div>

                            <?php

                            if($countCastVote >=1):
                                $this->db->where('status="1" AND type="contest"');
                                $getRipeVote = $this->db->get("vote_information")->result_array();

                                ?>
                                <div class="m-t-10">
                                    <small>Click the contest below to approve the winner</small>
                                    <ul class="tag-style m-t-10">
                                    <?php
                                    foreach($getRipeVote as $ripeVote):

                            ?>
                               <li><a href="<?php echo base_url('admin/prize_approve/'.$ripeVote['contest_challenge_id'])?>"><?php echo $ripeVote['title'] ?></a> </li>


                            <?php endforeach;?>
                                </ul>
                             </div>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="rightWhiteBlock">
                            <h4 class="f-s-18 m-t-0">Prize Awarded</h4>


                            <?php

                                $this->db->where('status="2"');
                                $countPrizeAwarded = $this->db->count_all_results('vote_information');
                            ?>

                            <div style='font-size: 70px' class='text-center text-red m-t-30 p-t-40 p-b-20'><?php echo $countPrizeAwarded ?></div> <div class='text-center f-s-18'>Prize Won</div>


                            <?php if($countPrizeAwarded >=1){?>


                            <div class="m-t-10">
                                <small>See the Prize Awarded</small>
                                <ul class="tag-style m-t-10">
                                    <?php
                                    $this->db->where("status='2'");
                                    $prizeWn = $this->db->get('vote_information')->result_array();

                                        foreach($prizeWn as $prizeWon):
                                    ?>

                                            <li><a href="<?php echo base_url("winner/check/".$prizeWon['contest_challenge_id'])?>"> <?php echo $prizeWon['title'].' Contest' ?></a></li>

                                    <?php endforeach ?>

                                </ul>

                                </div>
                            <?php  }?>
                        </div>
                    </div>
                </div>

            </div>



            <div class="col-sm-2 hidden-xs m-0 p-0" style="">
                <div class="admin_notification" style="min-height: 450px">
                    <h6 class="text-center text-red" style="font-size: 14px; margin-top: 0;font-weight: 700;"><i class="glyphicon glyphicon-bell text-red"></i> Total Number of Vote</h6>


                   <div class="text-center m-t-40 p-t-20 f-s-30 text-green">
                       <?php echo $this->db->count_all_results('votex') ?> <br>
                       <small class="f-s-17">Votes</small>
                   </div>


                </div>
            </div>

            <div class="">

                <div class="theme_section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="th_manage_user">
                                <h3 class="th_title">Voting Table</h3>
                                <div class="table-responsive">
                                    <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Contest Name</th>
                                            <th>No of Entry</th>
                                            <th>No of vote</th>
                                            <th>Closing Date</th>
                                            <th class="action" hidden>Action</th>
                                        </tr>
                                        <thead>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Contest Name</th>
                                            <th>No of Entry</th>
                                            <th>No of vote</th>
                                            <th>Closing Date</th>
                                            <th class="action" hidden>Action</th>
                                        </tr>
                                        <tfoot>
                                        <tbody>
                                        <?php $no=1; ?>
                                        <?php if($contestVoteOpen >= 1){

                                            foreach($getOpenContestVote as $openContest):

                                                //vote end
                                                $timestampClose = strtotime($openContest['vote_end_date']);
                                                $formattedCloseDate = date('F d, Y', $timestampClose);

                                                //remaining date
                                                $d1=strtotime($openContest['vote_end_date']);
                                                $d2=ceil(($d1-time())/60/60/24);

                                                $xxID = $openContest['contest_challenge_id'];
                                                //count no of entry
                                                $this->db->where("entry_id='$xxID'");
                                                $countEntry = $this->db->count_all_results('entries_submited');

                                                //count all vote

                                                $this->db->select_sum('vote');
                                                $this->db->from('votex');
                                                $this->db->where("entry_id='$xxID'");
                                                $countVote = $this->db->get()->result();
                                                foreach($countVote as $countVoteNo);
                                               ?>


                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $openContest['title'] ?></td>
                                                    <td><?php echo $countEntry ?></td>

                                                    <td><?php if(empty($countVoteNo->vote)){echo 'No vote yet';}else{echo $countVoteNo->vote;} ?></td>
                                                    <td><?php echo $formattedCloseDate .' <span class="text-red"> ('. $d2 .' days left)</span>' ?></td>

                                                    <td hidden>

                                                        <a href="<?php echo base_url('vote/info/'.$openContest['contest_challenge_id'])?>" class="btn btn-danger btn-xs f-s-11 no-border-radius">Checkout</a>
                                                    </td>
                                                </tr>





                                        <?php endforeach; }?>


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
</div>
