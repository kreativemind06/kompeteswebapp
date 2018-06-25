<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 13-Apr-18
 * Time: 2:09 PM
 */



class Contests extends CI_Controller{
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
        $data['title'] = "Contests";

        if(isset($_SESSION['userLogginID'])) {
            //get user information if logged in
            require_once('action/fetch_user.php');
        }


        $current_date = date("Y-m-d H:i:s");

        $this->db->where("status='0'");
        $data['getCategory'] = $this->db->get('category')->result_array();


        $this->db->where('contest_start_date >= ',date('Y-m-d', strtotime($current_date)));
        $this->db->where("contest_status='0'");

        $this->db->order_by('contest_start_date','ASC');
        $data['getContest'] = $this->db->get('contests')->result_array();

        //count picture
        $this->db->where("contest_status='0' AND contest_start_date<='$current_date'");
        //$this->db->like("category",$id,'both');
        $data['countContest'] = $this->db->count_all_results('contests');

        $this->load->view('template/header', $data);
        $this->load->view('contests', $data);
        $this->load->view('template/footer', $data);

    }


    public function cat($id){

        $data['success'] = "";
        $data['title'] = $id;

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
        $this->db->where("contest_status='0'");
        $this->db->like("category",$id,'both');
        $this->db->order_by('id', 'DESC');
        $data['getContest'] = $this->db->get('contests')->result_array();


        //count picture
        $this->db->where("contest_status='0'");
        $this->db->like("category",$id,'both');
        $data['countContest'] = $this->db->count_all_results('contests');


        $this->load->view('template/header', $data);
        $this->load->view('contests', $data);
        $this->load->view('template/footer', $data);
    }


    public function check($id){

        $data['title'] = 'Contest name';

        //get user information if loggedin

        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');

        }


        $this->db->where("contest_id='$id'");
        $countContest = $this->db->count_all_results('contests');


        if($countContest >=1){


            //count the contest entries

            $this->db->where("entry_id='$id'");
            $data['countEntries'] = $this->db->count_all_results('entries_submited');


            //get the contest information out
            $this->db->where("contest_id='$id'");
            $data['getContest'] = $this->db->get("contests")->result();

            $this->load->view('template/header', $data);
            $this->load->view('contests_view', $data);
        }
        else{

            die('Contest not found');

        }


    }


    public  function entries($id){


        $data['title'] = 'Contest name';
        $data['success'] = '';

        //get user information if loggedin

        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');

        }


        $this->db->where("contest_id='$id'");
        $countContest = $this->db->count_all_results('contests');


        if($countContest >=1){

            //count the contest entries

            $this->db->where("entry_id='$id'");
            $data['countEntries'] = $this->db->count_all_results('entries_submited');

            //get the contest information out
            $this->db->where("contest_id='$id'");
            $data['getContest'] = $this->db->get("contests")->result();

            //get all the pictures submited for the contest entry
            $this->db->where("entry_id='$id' AND entry_type='contest'");
            $data['getContestEntry'] = $this->db->get("entries_submited")->result_array();



            $this->load->view('template/header', $data);
            $this->load->view('contest_entry', $data);
        }
        else{

            die('Oops');

        }
    }

    public function submit_entry($id){

        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['userLogginID'])){
            require_once('action/fetch_user.php');

            $userID = $_SESSION['userLogginID'];
            $photoID = $this->input->post("photo");
            $entryType = $this->input->post("entry_type");

            $data['success']="";
            $data['title'] ='Contest entries ';

            //get contest information
            $this->db->where("contest_id='$id'");
            $countContest = $this->db->count_all_results('contests');


            //get all the pictures submited for the contest entry
            $this->db->where("entry_id='$id' AND entry_type='contest'");
            $data['getContestEntry'] = $this->db->get("entries_submited")->result_array();

            if($countContest >=1){

                //count the contest entries

                $this->db->where("entry_id='$id'");
                $data['countEntries'] = $this->db->count_all_results('entries_submited');

                //get the contest information out
                $this->db->where("contest_id='$id'");
                $data['getContest'] = $this->db->get("contests")->result();

                //get all the pictures submited for the contest entry
                $this->db->where("entry_id='$id' AND entry_type='contest'");
                $data['getContestEntry'] = $this->db->get("entries_submited")->result_array();







                //get the contest information out
                $this->db->where("contest_id='$id'");
                $data['getContest'] = $this->db->get("contests")->result();


                //count the contest entries check if the user has already submitted photo for this entry
                $this->db->where("entry_id='$id' AND user_id='$userID'");
                $countEntries = $this->db->count_all_results('entries_submited');


                //get the contest information out
                $this->db->where("contest_id='$id'");
                $getContest = $this->db->get("contests")->result();
                $contestEntryPrice =  $getContest[0]->entry_price;
                $contestAllowUpload =  $getContest[0]->allow_upload;

                if($countEntries > $contestAllowUpload){
                    //user already submitted the
                    //die('You have already submitted photo for this contest ');

                    $data['success'] = "<div class='alert alert-danger text-white'><a class='close' data-dismiss='alert'>x</a> You have reached the maximum upload limit for this contest.. Sorry, you can try another contest  </div>";
                    $this->load->view('template/header', $data);
                    $this->load->view('contest_entry', $data);


                }

                else{
                    //get the picture details for submission
                    $this->db->where("picture_id='$photoID'");
                    $getPictureD = $this->db->get("uploads")->result();
                    foreach($getPictureD as $pictureD);

                    $insertPhoto = array(

                        'entry_type'=>$entryType,
                        'entry_id'=>$id,
                        'picture_id'=>$photoID,
                        'picture_name'=>$pictureD->picture_medium_name,
                        'user_id' => $userID,
                        'status'=>0,
                        'submited_date'=>date('Y-m-d H:i:s')
                    );

                    //die("uploaded successful");

                    if($contestEntryPrice !=='Free'){

                        //check if the user have enough
                        //echo $contestEntryPrice;
                        if($data['creditUnit'] >= $contestEntryPrice){

                            $insertCreditSpent = array(

                                "credit_unit"=> $contestEntryPrice,
                                "username"=> $data['username'],
                                "user_id"=> $_SESSION['userLogginID'],
                                "entry_id"=> $id,
                                "entry_type"=> $entryType,
                                "date"=> date("Y-m-d H:i:s"),
                            );

                            $this->db->insert('credit_used', $insertCreditSpent);

                            //update user credit from the table
                            $this->db->where("user_id='$userID'");
                            $this->db->update('credit_subscription', array('credit'=> $data['creditUnit'] - $contestEntryPrice ));

                            //insert into entry table
                            $this->db->insert('entries_submited', $insertPhoto);

                            //insert into notification

                            $insertNotification = array(
                                array(
                                "message"=> "You have successfully enter the ". $getContest[0]->contest_name. ' contest for ' .$contestEntryPrice,
                                "user_id"=> $userID,
                                "link"=> base_url('contests/check/'.$id),
                                'date'=> date('Y-m-d H:i:s'),
                            ),
                                array(
                                    "message"=> $data['username'] ." has successfully enter the ". $getContest[0]->contest_name. ' contest for ' .$contestEntryPrice,
                                    "user_id"=> 'Admin',
                                    "link"=> base_url('contests/check/'.$id),
                                    'date'=> date('Y-m-d H:i:s'),
                                )
                            );

                            $this->db->insert_batch('notificationx', $insertNotification);


                            $data['success'] = "<div class='alert alert-success text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Contest Entry Submitted Successfully!</div>";

                            $this->load->view('template/header', $data);
                            $this->load->view('contest_entry', $data);


                        }
                        else{

                            //Insufficient Credit

                            $data['success'] = "<div class='alert alert-danger text-white'><a class='close' data-dismiss='alert'>x</a> Insufficient Balance!.. You do not have a sufficient credit to enter this contest, <a href='".base_url('upgrade')."'>Click  here</a> to Upgrade your wallet  </div>";
                            $this->load->view('template/header', $data);
                            $this->load->view('contest_entry', $data);
                        }
                    }
                    else{

                        //insert into notification

                        $insertNotification = array(
                            array(
                                "message"=> "You have successfully enter the ". $getContest[0]->contest_name. ' contest for Free',
                                "user_id"=> $userID,
                                "link"=> base_url('contests/check/'.$id),
                                'date'=> date('Y-m-d H:i:s'),
                            ),
                            array(
                                "message"=> $data['username'] ." has successfully enter the ". $getContest[0]->contest_name. ' contest for Free',
                                "user_id"=> 'Admin',
                                "link"=> base_url('contests/check/'.$id),
                                'date'=> date('Y-m-d H:i:s'),
                            )
                        );

                        $this->db->insert_batch('notificationx', $insertNotification);

                        //insert if the contest is free
                        $this->db->insert('entries_submited', $insertPhoto);

                        $data['success'] = "<div class='alert alert-success text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Contest Entry Submitted Successfully!</div>";

                        $this->load->view('template/header', $data);
                        $this->load->view('contest_entry', $data);

                    }
                }
            }
            else{
                //contests not found
                die("Oops Contest not found");
            }
        }

        else{

            die("You are not allowed to access this page directly");
        }
    }
}