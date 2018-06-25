    <div class="container-fluid" id="contest" style="min-height: 550px; margin-top:">
        <div class="row">

            <?php foreach($contestEntry as $challenges):?>

            <?php
            $EntryID= $challenges['entry_id'];
            $this->db->where("challenge_id='$EntryID'");
            $getEntryDetail = $this->db->get('challenges')->result();

            foreach($getEntryDetail as $entryUSer);

            ?>



            <div class="col-sm-3">
                <div class="profile-grid-block">
                    <a href="<?php echo base_url('challenges/check/'.$EntryID)?>" target="_new">
                        <div class="grid-image">
                            <img src="<?php echo base_url('uploads/challenges/'.$entryUSer->challenge_banner)?>" width="100%">
                        </div>
                        <div class="grid-user-content">
                            <div class="grid-user-picture">
                                <img src="<?php echo base_url("uploads/medium_thumb/".$challenges['picture_name'])?>" class="img-thumbnail" width="100">
                            </div>

                            <h5 class="text-center"><?php echo $entryUSer->challenge_name ?></h5>
                            <div class="text-center">
                                <?php
                                $voteStart = $entryUSer->challenge_start_date;
                                $voteEnd = $entryUSer->challenge_close_date;
                                if($voteStart >= date('Y-m-d') && $voteEnd <= date('Y-m-d')){?>
                                <a class="btn btn-warning no-border-radius">
                                    Vote
                                </a>

                                <?php }elseif($voteStart >= date('Y-m-d') && $voteEnd >= date('Y-m-d') ){?>

                                    <a class="btn btn-success no-border-radius">
                                        Enter for Free <?php //echo $entryUSer-> ?>
                                    </a>

                                <?php }else{?>
                                    <a class="btn btn-danger no-border-radius">
                                        Closed
                                    </a>

                                <?php }?>
                            </div>


                        </div>
                    </a>
                </div>
            </div>



            <?php endforeach ?>


        </div>

        <div class="row">
            <!-- pagination start here
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <ul class="pagination pagination-centered no-border-radius">
                    <li class="no-border-radius"><a href="#">First</a></li>
                    <li><a href="#">Previous</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">Next</a></li>
                    <li><a href="#">Last</a></li>
                    <li class="no-border-radius"><a href="#">Goto</a></li>
                </ul>
            </div>-->

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

