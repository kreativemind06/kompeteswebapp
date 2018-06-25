
    <div class="container-fluid" id="award" style="min-height: 550px; margin-top: -40px">

        <div id="photo_wrapper" class="photo_wrapper" style="">

            <div class="photo_row">
                <a href="photo_page.html">
                    <div class="show-image">
                           <img src="<?php echo base_url() ?>photo/60722357_large1300.jpg">
                    </div>

                    <div class="awardNumber text-center" style="">
                        <span>5 awards</span>
                    </div>
                </a>
            </div>

            <div class="photo_row">
                <a href="">
                    <div class="show-image" >
                        <img src="<?php echo base_url() ?>photo/70402170_widepreview400.jpg" width="400" class="img-responsive">
                    </div>
                    <div class="awardNumber text-center" style="">
                        <span>2 awards</span>
                    </div>
                </a>

            </div>

            <div class="photo_row">
                <a href="#">
                    <div class="show-image">
                        <img src="<?php echo base_url() ?>photo/62491531_widepreview400.jpg">
                    </div>
                    <div class="awardNumber text-center" style="">
                        <span>2 awards</span>
                    </div>
                </a>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</section>



<!-- mobile search modal begins here -->

<div id="mobileSearch" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px">

        <!-- Modal content-->
        <div class="modal-content no-border-radius">

            <div class="modal-body">
                <div class="searchZippr">
                    <h4>Type your search and hit enter</h4>
                    <div class="form-group no-margin-xs">
                        <input class="width-100 search-control" placeholder="Username, Competition, Photo title here" type="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src="<?php echo base_url() ?>js/jquery.masonry.js"></script>
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

