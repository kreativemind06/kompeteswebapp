<section class="content" style="min-height: 750px;">

    <div class="container p-t-40" style="margin-top: 40px">

        <div class="col-sm-6" style="background: #f2f2f2">
            <div class="rightWhiteBlock">
                <div class="text-center">
                    <div style="font-size: 70px" class="text-center text-red m-t-30 p-t-40 p-b-30"> <?php echo $creditUnit ?> </div> <div class="text-center f-s-18 m-b-30">
                        Total Credit Balance
                    </div>
                </div>

            </div>
        </div>

        <div class="col-sm-6" style="background: #f06653">
            <div class="rightWhiteBlock">
                <div class="text-center">
                    <div style="font-size: 70px" class="text-center text-black m-t-30 p-t-40 p-b-30">0</div> <div class="text-center f-s-18 m-b-30">
                        Total Credit Used
                    </div>
                </div>

            </div>
        </div>




        <div class="row">
            <div class="col-sm-12 m-t-40">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Credit</th>
                            <th>Price</th>
                            <th>date</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php
                        $UserID = $this->session->userLogginID;
                            $this->db->where("user_id ='$UserID'");
                           $countTransaction =  $this->db->count_all_results("transactionx");

                           $this->db->where("user_id = '$UserID'");
                           $getTransaction = $this->db->get("transactionx")->result_array();


                           if($countTransaction >0){
                               $sn = 1;
                               foreach($getTransaction as $transactionx):
                        ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $transactionx['total_unit'] ?></td>
                            <td><?php echo $transactionx['amount'] ?></td>
                            <td><?php echo time_elapsed_string($transactionx['date']) ?></td>
                            <td><?php if($transactionx['transaction_status'] == 'processor_declined'){ echo "<div class='label label-danger'>Declined</div>";}else{ echo "<div class='label bg-black-gradient'>Successful</div>";} ?></td>
                        </tr>
                               <?php endforeach; }else{echo 'NO transaction history found';} ?>
                        </tbody>
                    </table>

                </div>



            </div>



        </div>






    </div>
</section>