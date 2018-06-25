<section class="content" style="margin-top: 55px">
    <div class="container-fluid m-0 p-0">
        <?php foreach($getContest as $contests):?>
            <?php

            //get username

            $contestID = $contests['contest_id'];

            $this->db->where("entry_id='$contestID'");
            $this->db->from("prize_won");
            $this->db->join("userz","userz.user_id = prize_won.user_id");
            //$this->db->count_all_results();
            $getPrize = $this->db->get()->result_array();



            ?>

            <div class="grid-contest">
                <div class="box-crop">
                    <img src="<?php echo base_url('uploads/contests/'.$contests['contest_picture'])?>">
                </div>
                <a href="<?php echo base_url('winner/check/'.$contests['contest_id'])?>">
                    <div class="contest-name">
                        <h4 class="text-center"><?php echo $contests['contest_name']."'s ". $contests['type']. " Winners"?></h4>
                        <p class="text-center"><?php ?></p>
                        <div class="p-10" style="width: 270px;margin: auto;background: linear-gradient(rgba(44,44,44,0.3), rgba(44,44,44,0.7)); min-height: 90px">
                            <div class="pull-left m-r-10">
                                <img src="<?php if(!empty($getPrize[0]['picture'])){echo base_url('users_photo/'.$getPrize[0]['picture']);}else{echo base_url('users_photo/avatar.png');} ?>" width="75" height="75" class="img-circle border border-white">

                            </div>
                            <div class="pull-left m-r-10">
                                <img src="<?php if(!empty($getPrize[1]['picture'])){echo base_url('users_photo/'.$getPrize[1]['picture']);}else{echo base_url('users_photo/avatar.png');} ?>" width="75" height="75" class="img-circle border border-white">
                            </div>

                            <div class="pull-left">
                                <img src="<?php if(!empty($getPrize[2]['picture'])){echo base_url('users_photo/'.$getPrize[2]['picture']);}else{echo base_url('users_photo/avatar.png');} ?>" width="75" height="75" class="img-circle border border-white">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>







    </div>


</section>