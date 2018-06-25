<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 13-May-18
 * Time: 3:25 PM
 */



class Winner extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
    }

    public function index(){


        if(isset($_SESSION['userLogginID'])){
            require_once('action/fetch_user.php');

        }


        $date = date('Y-m-d');

        $this->db->select('*');
        $this->db->where("vote_end_date <'$date' AND status='2'");
        $this->db->from('vote_information');
        //$this->db->join('contest_price_picture', 'contest_price_picture.contest_id = vote_information.contest_challenge_id');
        $this->db->join('contests', 'contests.contest_id = vote_information.contest_challenge_id');

        //$this->db->join("entries_submited","entries_submited.entry_id = vote_information.contest_challenge_id");
        $data['getContest'] = $this->db->get()->result_array();

        //$this->db->join("entries_submited","entries_submited.entry_id = vote_information.contest_challenge_id");

       //echo $this->db->count_all_results();

       //$data['getContest'] = $this->db->get()->result_array();


        $data['title']='Contest Winner';
        $this->load->view('template/header', $data);
        $this->load->view('winner_index', $data);


    }


    public function check($id){




        if(isset($_SESSION['userLogginID'])){
            require_once('action/fetch_user.php');

        }

        $this->db->where("contest_challenge_id = '$id' AND status='2'");
        $countAll = $this->db->count_all_results('vote_information');

        if($countAll <=0 ){


            die("error");
        }
        else {


            $this->db->select('*');
            $this->db->where("contest_challenge_id='$id'");
            $this->db->from('vote_information');
            $this->db->join('contest_price_picture', 'contest_price_picture.contest_id = vote_information.contest_challenge_id');
            $this->db->join('contests', 'contests.contest_id = vote_information.contest_challenge_id');
            $this->db->join("entries_submited","entries_submited.entry_id = vote_information.contest_challenge_id");
            $data['getContest'] = $this->db->get()->result_array();




            $data['title']='';
            //get information about the contest or challenges
            $this->load->view('template/header', $data);
            $this->load->view('winner', $data);
        }



    }





}