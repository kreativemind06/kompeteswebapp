<?php




if (isset($_GET["id"])) {


}
?>



<section class="content" style="margin-top: 40px;padding: 0; background: url(<?php echo base_url('img/bg/payment_bg.jpg')?>) no-repeat; background-size: cover;min-height: 500px">
    <div class="container-fluidx">
        <div class="col-sm-8 col-sm- m-0 p-0">
            <div class="p-20" style="background: #FFF; min-height: 550px;">
                <div class="icon">
                    <?php echo $header ?>
                </div>
                <section>
                    <p><?php echo($message)?></p>
                </section>


                <div style="">




                </div>

                <table cellpadding="0" cellspacing="0" width="300px" align="center"  style="width: 300px; margin: auto">
                    <tbody>
                    <tr class="f-s-20">
                        <td class="text-">Amount</td>
                        <td class="text-blue f-s-22"> <?php echo('£'.$transaction->amount)?></td>
                    </tr>
                    <tr class="f-s-20">
                        <td class="text-">Status</td>
                        <td><?php if($transaction->status == 'processor_declined'){echo "<label class='label label-danger f-s14'>Declined</label>";}else{echo "<label class='label label-success'>Success</label>";}?></td>
                    </tr>
                    <tr class="f-s-20">
                        <td class="text-">Created Date</td>
                        <td><?php echo(time_elapsed_string($transaction->updatedAt->format('Y-m-d H:i:s'))) ?></td>
                    </tr>

                    </tbody>
                </table>


                <section class="m-t-30">

                    <div class="text-center m-b-40">

                        <a href="<?php echo base_url('user/home')?>" class="btn no-border-radius text-white bg-lg f-s-20" style="background: #f00"> Go to User Page</a>

                    </div>

                    <a class="label label-default pull-right" href="<?php echo base_url('upgrade')?>">
                        <span>Buy more credit</span>
                    </a>

                    <a class="label label-primary bg-black text-white" href="<?php echo base_url('user/home')?>">
                        <span>See User Profile</span>
                    </a>

                </section>
            </div>
        </div>
        <div class="col-sm-4"></div>
        <div class="clearfix"></div>
    </div>
</section>

