<?php


$this->db->where("status ='0'");
$countCredit = $this->db->count_all_results('credit_price');
/*
$this->db->where("status ='0'");
$this->db->order_by('credit_price','ASC');
$getCredit = $this->db->get("credit_price")->result_array();
*/
$query = $this->db->query("SELECT * FROM credit_price WHERE status ='0' ORDER BY CAST(credit_unit AS UNSIGNED) ASC ");

$getCredit = $query->result_array();


?>

<script type="text/javascript">



    //add the product price with hosting price

    var hostingPrice = new Array();
    <?php foreach ($getCredit as $creditList) {?>
    hostingPrice['<?php echo $creditList['credit_unit']?>'] = <?php echo $creditList['credit_unit']?>;
    <?php } ?>

    function getHostingPlanPrice (){

        var hosting_price = 0;
        var theForm = document.forms['upgrade'];
        var hosting_plan = theForm.elements['unit'];

        for(var i =0; i < hosting_plan.length; i++){

            if(hosting_plan[i].checked){
                hosting_price = hostingPrice[hosting_plan[i].value];
                break;
            }
        }
        return hosting_price;
    }

    function calculateTotalPrice(){
        var total = getHostingPlanPrice()+ 0
        //display result

        var divobj = document.getElementById('totalPrice');
        divobj.style.display='';
        divobj.innerHTML = ""+total;

    }



    function revealMore(){
       document.getElementById('reveal').removeAttribute('hidden');
       document.getElementById('hide').setAttribute('hidden', 'hidden');

    }

</script>


<style type="text/css">
    *{font-family: 'Roboto', sans-serif;}

    @keyframes click-wave {
        0% {
            height: 20px;
            width: 20px;
            opacity: 0.35;
            position: relative;
        }
        100% {
            height: 20px;
            width: 20px;
            margin-left: -5px;
            margin-top: -5px;
            opacity: 0;
        }
    }

    .option-input {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        -o-appearance: none;
        appearance: none;
        position: relative;
        top: 5.5px;
        right: 0;
        bottom: 0;
        left: 0;
        height: 23px;
        width: 23px;
        transition: all 0.15s ease-out 0s;
        background: #cbd1d8;
        border: none;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        margin-right: 0.5rem;
        outline: none;
        position: relative;
        z-index: 1000;
    }
    .option-input:hover {
        background: #9faab7;
    }
    .option-input:checked {
        background: #0461A7;
        padding: 2px;
    }
    .option-input:checked::before {
        height: 20px;
        width: 20px;
        position: absolute;
        content: '✔';
        display: inline-block;
        font-size: 20.66667px;
        text-align: center;
        line-height: 20px;
    }
    .option-input:checked::after {
        -webkit-animation: click-wave 0.65s;
        -moz-animation: click-wave 0.65s;
        animation: click-wave 0.65s;
        background: #40e0d0;
        content: '';
        display: block;
        position: relative;
        z-index: 100;
    }
    .option-input.radio {
        border-radius: 50%;
    }
    .option-input.radio::after {
        border-radius: 50%;
    }

</style>






<section class="content" style="margin-top: 55px;padding: 0; background: url(<?php echo base_url('img/bg/credit_bg.jpg')?>) no-repeat; background-size: cover">

    <div class="container-fluid" style="min-height: 710px">



        <div class="col-sm-6 m-t-40 no-padding-xs text-left" hidden>
            <div style="min-height: 300px; background: rgba(223,223,233, 0.7)">
                <h3 class="text-center text-red f-bitter"> <img src="<?php echo base_url('img/icons/credit-card-red.png')?>">  Why Credits </h3>

                <p class="f-s-18 p-20 f-ubuntu"> It’s up to you how you want to use credits – buy just enough for the photo contests and challenges you want to enter – the more you buy, the less they cost.  </p>
            </div>
        </div>

        <div class="col-sm-5 col-sm-offset-1 m-t-5  no-padding-xs">

            <div class="" style="min-height: 500px;background: #fff">
                <div class="bg-black-gradient text-center" style="height: 70px;">
                    <h6 class="text-white m-b-0 p-b-0 f-s-20 f-bitter" style="margin-bottom: -10px !important;">Credits</h6>
                    <p class="text-white m-t-0 p-t-0 f-bitter">Purchase credits here to use for entry to the premium contests.</p>
                </div>

                <?php echo form_open("upgrade/checkout", array('id'=>'upgrade'))?>


                <div class="p-l-10 p-r-10">


                  <?php

                    $i=1;
                    foreach($getCredit as $creditList):

                  ?>


                    <div class="unit_price">
                        <label class="p-t-10">
                            <div class="col-xs-6">
                                <input type="radio" onclick="calculateTotalPrice()" class="option-input radio" name="unit" value="<?php echo $creditList['credit_unit'] ?>">
                                <?php echo $creditList['credit_unit'] ?> <span> credits </span>
                            </div>
                            <div class="col-xs-6 text-right">
                                £<?php echo $creditList['credit_price'] ?> <span>GBP</span>
                                <br>
                                <div style="margin-top:-13px">
                                    <small>£<?php echo $creditList['price_per_credit'] ?>/credit</small>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </label>
                    </div>
                        <?php if($i++ == 6)
                        break;
                        ?>
                    <?php endforeach ?>

                    <div class="text-center m-t-20" id="hide">
                        <a onclick="revealMore()" >Check for more</a>
                    </div>


                    <div class="" hidden id="reveal">
                        <?php

                        for($i=6; $i<$countCredit; $i++):
                        ?>
                        <div class="unit_price">
                            <label class="p-t-10">
                                <div class="col-xs-6">
                                    <input type="radio" onclick="calculateTotalPrice()" class="option-input radio" name="unit" value="<?php echo $getCredit[$i]['credit_unit'] ?>">
                                    <?php echo $getCredit[$i]['credit_unit'] ?> <span> credits </span>
                                </div>
                                <div class="col-xs-6 text-right">
                                    £<?php echo $getCredit[$i]['credit_price'] ?> <span>GBP</span>
                                    <br>
                                    <div style="margin-top:-13px">
                                        <small>£<?php echo $getCredit[$i]['price_per_credit'] ?>/credit</small>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </label>
                        </div>
                        <?php endfor ?>

                    </div>


                    <div class="form-group text-center m-t-25 p-b-20">
                        <button type="submit"   class="btn btn-default btn-lg no-border-radius" style="width: 100%; border: 3px solid #007BC4;border-radius: 20px;">  Buy <span id="totalPrice"></span>  Credits </button>
                    </div>
                </div>
                <?php echo form_close()?>


            </div>
        </div>


    </div>
</section>