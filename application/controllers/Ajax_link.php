<?php
/**
 * Created by PhpStorm.
 * User: nestor
 * Date: 17/06/2018
 * Time: 12:47 PM
 */


class Ajax_link extends CI_Controller{


    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
    }

    public function index(){

        redirect(base_url());




    }

    public function like($id){


        require_once('action/user_ip.php');

        $userIP = get_client_ip();

        if (isset($this->session->userLogginID)) {

            $user_id = $this->session->userLogginID;
        } else {

            $user_id = '';
        }


        $this->db->where("upload_id = '$id' AND like_ip ='$userIP'");
        $countLike = $this->db->count_all_results('upload_like');

        //count all likes
        $this->db->where("upload_id = '$id'");
        $like_count = $this->db->count_all_results('upload_like');

        $like_count_plus = $like_count + 1;
        $like_count_minus = $like_count - 1;


        if($countLike <= 0) {


            $insertLike = array(

                'upload_id' => $id,
                'like_ip' => $userIP,
                'user_id' => $user_id,
                'status' => 1,
                'date' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('upload_like', $insertLike);
            echo '<a href="#" class="" style="width: 100%; padding: ; color: #fff;"><i class="fa fa-thumbs-up"></i>'. $like_count_plus  . ' </a>';
        }

        else{

            //dislike the picture



            $this->db->where("upload_id = '$id' AND like_ip ='$userIP'");
            $this->db->delete('upload_like');

            echo '<a href="#" class="" style="width: 100%; padding:; color: #fff;"><i class="fa fa-thumbs-down"></i>'. $like_count_minus . ' </a>';

        }









    }


    public function fav($id)
    {


        $this->db->where("upload_id", $id);
        $countFav = $this->db->count_all_results("favourite_upload");


        require_once('action/user_ip.php');

        $userIP = get_client_ip();
        if (isset($_SESSION['userLogginID'])) {

            $userID = $_SESSION['userLogginID'];

        } else {
            $userID = "";
        }


        if($countFav <=0) {

            $insertFav = array(

                'user_id' => $userID,
                'upload_id' => $id,
                'status' => 1,
                'user_ip' => $userIP,
                'date' => date("Y-m-d H:i:s"),

            );

            $this->db->insert('favourite_upload', $insertFav);

            echo '<a class="" style="width: 100%; display: block" href="#"><i class="fa fa-star text-red"></i></a>';
        }

        else{


            $this->db->where("user_ip ='$userIP' AND upload_id ='$id' AND user_id ='$userID'");
            $this->db->delete("favourite_upload");

            echo '<a class="" style="width: 100%; display: block" href="#"><i class="fa fa-star text-yellow"></i></a>';



        }


    }

}