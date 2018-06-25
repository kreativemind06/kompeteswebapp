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
                        <a class="borderNone" href="0">
                            <small class="text-center">
                                Total Subscriber
                                <div class="countCircle teal">
                                    <i class="fa-user fa"></i>
                                </div>
                            </small>
                            <?php echo $count_subscriber ?>
                        </a>
                    </div>
                </div>


                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="">
                            <small class="text-center">
                                Total Transaction
                                <div class="countCircle dark-magenta">
                                    <i class="fa-home fa"></i>
                                </div>
                            </small>
                            <?php echo $countSuccessTrans ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="2">
                            <small class="text-center">
                                Total Credit Sold
                                <div class="countCircle orange">
                                    <i class="fa-suitcase fa"></i>
                                </div>
                            </small>
                            <?php if(empty($getSumCredit->amount)){echo 0.00;}else{echo $getSumCredit->amount;} ?>
                        </a>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="blockMenu">
                        <a href="0">
                            <small class="text-center">
                                Total Credit Used
                                <div class="countCircle green">
                                    <i class="fa-save fa"></i>
                                </div>
                            </small>
                            <?php echo $getSumUsedCredit->credit_unit ?>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-sm-6">
                    <div class="rightWhiteBlock">
                        <div class="text-center">
                            <?php
                            $this->db->where("transaction_status !='processor_declined'");
                            $countSuccessTran = $this->db->count_all_results("transactionx");

                            $this->db->where("transaction_status ='processor_declined'");
                            $countUnsuccessTran = $this->db->count_all_results("transactionx");

                            ?>
                            <div style="font-size: 70px" class="text-center text-red m-t-30 p-t-40 p-b-30"><?php echo $countSuccessTran ?></div> <div class="text-center f-s-18 m-b-30">
                                Successful Transaction
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="rightWhiteBlock">
                        <div class="text-center">
                            <div style="font-size: 70px" class="text-center text-red m-t-30 p-t-40 p-b-30"><?php echo $countUnsuccessTran ?></div> <div class="text-center f-s-18 m-b-30">
                                Unsuccessful Transaction
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="theme_section">

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="th_manage_user">
                            <h3 class="th_title">Transaction History</h3>
                            <div class="table-responsive">
                                <table class="commonTable table table-striped table-bordered manage_user" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Credit Unit</th>
                                        <th class="">Status</th>
                                        <th class="">Date</th>
                                    </tr>
                                    <thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Credit Unit</th>
                                        <th class="">Status</th>
                                        <th class="">Date</th>
                                    </tr>
                                    <tfoot>
                                    <tbody>
                                    <?php $no =1; foreach($getAllTrans as $allTrans):?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td> <?php echo $allTrans['username'] ?> </td>
                                        <td><?php echo $allTrans['transaction_id']?></td>
                                        <td><?php echo $allTrans['amount']?> </td>
                                        <td><?php echo $allTrans['total_unit']?> </td>
                                        <td><?php if($allTrans['transaction_status'] =='processor_declined'){ echo "<div class='label label-danger'>Declined</div>";}else{echo "<div class='label label-success'>Success</div>";}?></td>
                                        <td><?php echo time_elapsed_string($allTrans['date'])?></td>
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
