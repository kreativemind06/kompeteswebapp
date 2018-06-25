<?php

$USER_ID = $this->uri->segment(3);


if(empty($USER_ID)){

    $USER_ID = $_SESSION['userLogginID'];

}

$this->db->where("user_id = '$USER_ID'");
$countUploadPicture = $this->db->count_all_results('uploads');

$this->db->where("user_id = '$USER_ID'");
$getUploadedPhotos = $this->db->get('uploads')->result_array();

?>


        <div class="container-fluid" style="min-height: 550px; margin-top: -40px">

            <div id="photo_wrapper" class="photo_wrapper" style="">

                <?php if($countUploadPicture >=1):?>

                    <?php foreach($getUploadedPhotos as $getUpload):?>
                        <div class="photo_row">
                            <div class="show-image">
                                <a href="<?php echo base_url('photos/check/'.$getUpload['picture_id'])?>">
                                    <img src="<?php echo base_url('uploads/medium_thumb/'.$getUpload['picture_medium_name']) ?>">
                                </a>

                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>

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

