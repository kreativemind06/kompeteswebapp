<script type='text/javascript'>

    window.seconds = 45;
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
            window.location = "<?php echo base_url('vote')?>";
        }
    }
</script>


<?php //echo $_SESSION['realSession']; ?>


<section class="content" style="margin-top: 53px;padding: 0;">

    <div class="" style="background: linear-gradient(135deg, rgba(0,0,0,0.4), rgba(0,0,0,0.7)), url('<?php echo base_url('uploads/contests/'.$contestInfo->contest_picture)?>'); background-position: center; background-size: contain; min-height: 580px">

        <div class="container">
            <div class="col-sm-8 col-sm-offset-">
                <div class="text- p-t-40">
                    <h3 class="t-c-white f-bitter p-t-40">
                        Thank you for voting for your favourite <?php echo $contestInfo->contest_name ?> Photo Contest
                    </h3>
                    <p class="t-c-white f-s-18 f-ubuntu text-left" style="line-height: 25px">
                       We really appreciate you for spending your precious time to vote for your favourite <?php echo $contestInfo->contest_name ?> Photo Contest.
                    </p>

                    <p class="t-c-white f-s-18 text-left f-ubuntu" style="line-height: 25px">
                        You will be redirected to vote contest page in <span id="secondsDisplay" class="text-red">45</span> to begin another session of vote for another contest of your choice
                    </p>

                    <div>
                        <a href="<?php echo base_url('vote')?>" class="btn btn-lg no-border-radius" style="background: #fff;height: 60px; min-width: 180px;color: #000;padding-top: 15px">Go to Vote Page</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="p-t-40 m-t-40 pull-right" style="margin-top: 120px !important;">
                    <img src="<?php echo base_url('img/icons/ballot.png')?>">
                </div>

            </div>

        </div>


    </div>



</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src="<?php echo base_url()?>js/jquery.masonry.js"></script>

<script>
    $(function(){

        var $container = $('#photo_wrapper');

        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : '.photo_row'
            });
        });

    });


</script>
</body>
</html>
