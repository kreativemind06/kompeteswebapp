<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 26-Apr-18
 * Time: 12:48 PM
 */


class Follow extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('form','url'));
        $this->load->database();

    }

    public function index(){


        redirect(base_url('index.php'));

        //header("Location: index.php");
    }


    public function following($id){


        $data['success']="";
        $data['title'] = "";



        $this->db->insert('followingx', array('username'=>'test','user_id'=>'$id','follower_name'=>'73873df'));

        echo '<a class="btn-following" href="#"></a>';

    }


    public function unfollow(){


        if(isset($_POST['Unfollow'])){
            $follow_id = $_POST['Unfollow'];
            //run function from main class

            $this->db->where("follower_id = '$follow_id'");
            $this->db->delete('followingx');

            die('deleted');


            /// /$submit->unFollow($user_id,$follow_id);
        }

    }


    public function like($id){



    }

    public function favourite($id){




    }

}