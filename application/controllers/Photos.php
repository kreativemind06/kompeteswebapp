<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 13-Apr-18
 * Time: 10:24 AM
 */


class Photos extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url','form'));
        $this->load->library(array('session','form_validation'));
        $this->load->database();
    }


    public function index()
    {
        $data['success'] = "";
        $data['title'] = "Photos";



        if(isset($_SESSION['userLogginID'])) {
            //get user information if logged in
            require_once('action/fetch_user.php');
        }
        //get category

        $this->db->where("status='0'");
        $data['getCategory'] = $this->db->get('category')->result_array();


        //get photos uploaded
        $this->db->select('*');
        $this->db->where("status='0'");
        $this->db->order_by('id', 'DESC');
        $data['getPhotos'] = $this->db->get('uploads')->result_array();


        //count picture
        $this->db->where("status='0'");
        $data['countPhoto'] = $this->db->count_all_results('uploads');

        $this->load->view('template/header', $data);
        $this->load->view('photos', $data);
        $this->load->view('template/footer', $data);

    }

    public function cat($id){

        $data['success'] = "";
        $data['title'] = "Photos";

        //get user information if logged in

        if(isset($_SESSION['userLogginID'])) {
            //get user information if logged in
            require_once('action/fetch_user.php');
        }

        //get category

        $this->db->where("status='0'");
        $data['getCategory'] = $this->db->get('category')->result_array();


        //get photos uploaded
        $this->db->select('*');
        $this->db->where("status='0'");
        $this->db->like("category",$id,'both');
        $this->db->order_by('id', 'DESC');
        $data['getPhotos'] = $this->db->get('uploads')->result_array();


        //count picture
        $this->db->where("status='0'");
        $this->db->like("category",$id,'both');
        $data['countPhoto'] = $this->db->count_all_results('uploads');


        $this->load->view('template/header', $data);
        $this->load->view('photos', $data);
    }



    public function check($id){

        $data['success'] = "";
        $data['title'] = "Photos";

        require_once('action/time_function.php');

        //get user information if logged in

        if(isset($_SESSION['userLogginID'])) {
            //get user information if logged in
            require_once('action/fetch_user.php');
        }


        //get the picture information

        $this->db->where("picture_id='$id'");
        $countPID = $this->db->count_all_results('uploads');

        if($countPID <=0){

            die('Error!!!.. Page Not Found');

        }
        else {
            $this->db->where("picture_id='$id'");
            $data['getPhoto'] = $this->db->get("uploads")->result();
            foreach($data['getPhoto'] as $get_photo);

            $getView = $get_photo->view;
            if(empty($getView)){
                $getView = 0;
            }

            //update number of view
            $plus_1 = $getView + 1;
            $this->db->where("picture_id ='$id'");
            $this->db->update('uploads', array('view'=>$plus_1));




            //get the entry picture has been submitted for
            $this->db->where("picture_id ='$id'");
            $data['countEntry'] = $this->db->count_all_results("entries_submited");

            //get all comment on the photo

            $this->db->where("content_uid='$id'");
            $data['countComment'] = $this->db->count_all_results('commentx');

            $this->db->where("content_uid='$id'");
            $data['getComment'] = $this->db->get('commentx')->result_array();



            $this->db->select('*');
            $this->db->from('entries_submited');
            $this->db->where("entries_submited.picture_id ='$id'");
            $this->db->join('contests',"contests.contest_id = entries_submited.entry_id");
            $data['getEntry'] = $this->db->get()->result_array();

            $this->db->select('*');
            $this->db->from('entries_submited');
            $this->db->where("entries_submited.picture_id ='$id'");
            $this->db->join('challenges',"challenges.challenge_id = entries_submited.entry_id");
            $data['getEntry2'] = $this->db->get()->result_array();

            //validate comment
            $this->form_validation->set_rules('comment','Comment','required','required|trim|max_length[250]');
            $this->form_validation->set_error_delimiters("<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>&times;</a>", "</div>");

            if($this->form_validation->run() == false){

                $this->load->view('template/header', $data);
                $this->load->view('photo_page', $data);

            }

            else{

                //get insert input

                $insertComment = array(
                    'content_uid'=>$id,
                    'comment'=> $this->input->post('comment'),
                    'comment_id'=> substr(str_shuffle("0123456789"), 0, 10),
                    'picture'=> $data['userPhoto'],
                    'username'=> $data['username'],
                    'user_id'=> $_SESSION['userLogginID'],
                    'date'=> date("Y-m-d H:i:s"),
                );

                $this->db->insert('commentx', $insertComment);

                redirect(base_url('photos/check/'.$id.'#comment'));

            }


            //$this->load->view('template/footer', $data);
        }
    }
}