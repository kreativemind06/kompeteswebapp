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
            window.location = "<?php echo base_url('challenges/start')?>";
        }
    }
</script>


<section  class="content" style="margin-top: 90px;padding: 0;margin-bottom: 140px">

    <div class="container-fluid no-margin-xs no-padding-xs" style="">

        <div class="col-sm-8 col-sm-offset-2 no-margin-xs no-padding-xs">

            <div class="m-t-40" style="background: #fff;min-height: 300px">
                <div class="p-30">
                    <h6 class="m-5" style="border-bottom: 1px solid #f00"> Success Upload</h6>
                </div>

                <div class="text-center m-b-20">
                    <img src="<?php echo base_url('img/icons/Ok.png')?>">

                </div>
                <p class="text-center f-w-600">
                    Challenge uploaded successfully!!!. You can add more challenges by clicking the <a href="<?php echo base_url('challenges/start')?>"> upload link...</a>
                </p>

                <p class="text-center f-w-400">
                    You will be redirected to your profile page in <span id='secondsDisplay' style='color:#f00'>15 Seconds</span>; Click <a href="<?php echo base_url('challenges/start')?>"> here </a> if nothing happens
                </p>

            </div>
        </div>
    </div>
</section>