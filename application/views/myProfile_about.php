<?php
if(isset($_SESSION['userLogginID']) && empty($this->uri->segment(3))){

    $userID = $_SESSION['userLogginID'];

}
elseif(!empty($this->uri->segment(3))){

    $userID = $this->uri->segment(3);
}


$this->db->where("user_id = '$userID'");
$getUserPro = $this->db->get('userz')->result();

foreach($getUserPro as $userPro);



?>


<div class="container" id="about" style="min-height: 300px;">

        <div class="row">

            <div class="col-sm-3">
                <div class="m-t-20" style="min-height: 200px;background: #fff;">
                    <h6 class="f-s-14 text-center" style="border-bottom: 1px solid #d2d2d2">Info</h6>
                    <div class="p-20">
                        <b>Username:</b> <?php if(!empty($userPro->firstname)){echo $userPro->firstname .' '. $userPro->lastname;}else{echo $userPro->username;}?> <br>
                        <b>Country:</b> <?php echo $userPro->city.', '.$userPro->state.', '. $userPro->country;?> <br>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="m-t-20" style="min-height: 200px;background: #fff">
                    <h6 class="f-s-14 text-center" style="border-bottom: 1px solid #d2d2d2">About</h6>


                    <p class="p-20 f-s-15 t-c-ash f-Roboto-Condensed">
                       <?php echo $userPro->about; ?>
                    </p>

                    <div class="socialList">

                    </div>

                </div>

            </div>

            <div class="col-sm-3">
                <div class="m-t-20" style="background: #fff; min-height: 200px">
                    <h6 class="f-s-14 text-center" style="border-bottom: 1px solid #d2d2d2">Membership</h6>
                    <h6 class="f-s-15 text-center">Joined <?php echo time_elapsed_string($userPro->date) ?></h6>

                </div>

            </div>
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
<script src="js/jquery.masonry.js"></script>
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

