<style type="text/css">

    .policy{
        background: #fff;
        min-height:700px;
        margin-top: 70px

    }

    .policy h3{
        margin-top: 0;
        margin-bottom: 30px;
        font-size: 20px;
        border-bottom: 1px solid #d2d2d2;
    }

    .policy h6{
        margin: 0px;
        font-family: 'Ubuntu', sans-serif;
    }

    .ordered{
        padding-right: 10px


    }

    .ordered ul li{
        list-style-type: square;
        list-style-position: outside;
        margin-bottom: 10px;


    }


</style>


<section class="content">
    <div class="container-fluid" style="min-height: 755px;background: linear-gradient(rgba(50,0,0,0.4), rgba(20,0,0,0.7)),  url(<?php echo base_url('img/bg/pg5.JPG')?>); padding-bottom: 20px">


        <div class="col-sm-8 col-sm-offset-">
            <div class="p-20 policy" style="">

                <h3 class="text-red">Sponsor Contest Page</h3>
                <?php echo $success ?>

                <?php echo form_open()?>

                <div class="form-group" style="border-bottom: 1px solid #d2d2d2; padding-bottom: 10px">
                    <label class="text-dark">Fullname*</label>
                    <input class="form-control no-border-radius" placeholder="Fullname" value="<?php echo set_value('fullname')?>"  name="fullname" required>
                </div>

                <div class="form-group" style="border-bottom: 1px solid #d2d2d2; padding-bottom: 10px">
                    <?php echo form_error('fullname')?>
                    <label>Brand*</label>
                    <input class="form-control no-border-radius" placeholder="Brand name here" value="<?php echo set_value('brand')?>"  name="brand" required>
                </div>

                <div class="form-group" style="border-bottom: 1px solid #d2d2d2; padding-bottom: 10px">
                    <?php echo form_error('email')?>
                    <label>Email*</label>
                    <input class="form-control no-border-radius" type="email" placeholder="(e.g. xxde@webaite.com)" value="<?php echo set_value('email')?>"  name="email" required>
                </div>

                <div class="form-group" style="border-bottom: 1px solid #d2d2d2; padding-bottom: 10px">
                    <?php echo form_error('tel')?>
                    <label>Tel*</label>
                    <input class="form-control no-border-radius" type="tel" placeholder="" value="<?php echo set_value('tel')?>"  name="tel" required>
                </div>

                <div class="form-group" style="border-bottom: 1px solid #d2d2d2; padding-bottom: 10px">
                    <?php echo form_error('message')?>
                    <label>Message*</label>
                    <textarea class="form-control no-border-radius" placeholder="Your Message Here"  name="message" required><?php echo set_value('message')?></textarea>
                </div>

                <button type="submit" class="btn btn-lg bg-red text-white no-border-radius">Submit</button>




                <?php echo form_close()?>

            </div>


        </div>

    </div>