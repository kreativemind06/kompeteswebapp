<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 15-Apr-18
 * Time: 3:59 AM
 */



class Challenges extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
    }


    public function index()
    {
        $data['success'] = "";
        $data['title'] = "Challenges";
        $current_date = date('Y-m-d');

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        } else {

            require_once('action/fetch_user.php');

            //get oppen challenge

            $this->db->where("status='0'");
            $this->db->where('challenge_start_date >= ',date('Y-m-d', strtotime($current_date)));
            $data['countChallenges'] = $this->db->count_all_results('challenges');

            $this->db->where("status='0'");
            $this->db->where('challenge_start_date >= ',date('Y-m-d', strtotime($current_date)));
            $this->db->limit(8);
            $data['getChallenge'] = $this->db->get('challenges')->result_array();



            $this->load->view('template/header', $data);
            $this->load->view('challenges', $data);
        }
    }



    public function start(){
        $data['success'] = "";
        $data['title'] = "Start Challenges";

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        }
        else {

            $userID = $_SESSION['userLogginID'];

            $this->form_validation->set_rules('challenge_name','Challenge Name','required|trim');
            $this->form_validation->set_rules('category','Category','required|trim');
            $this->form_validation->set_rules('allow_no','Allow Number','required|trim');
            $this->form_validation->set_rules('challenge_type','Challenge Type','required|trim');
            $this->form_validation->set_rules('description','Description','required|trim');
            $this->form_validation->set_rules('winner_point','Winner Point','required|trim');
            $this->form_validation->set_rules('people_choice','Peoples Choice','required|trim');
            $this->form_validation->set_rules('biography','Your Biography','required|trim');
            $this->form_validation->set_rules('voting_start','Voting Starting Date','required|trim');
            $this->form_validation->set_rules('voting_ends','Voting Ending Date','required|trim');
            $this->form_validation->set_error_delimiters("<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>&times;</a>", "</div>");


            $challengeID = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);

            require_once('action/fetch_user.php');


            if($this->form_validation->run()==false){
                $this->load->view('template/header', $data);
                $this->load->view('challenges_start', $data);

            }

            else{

                $challengeName = $this->input->post('challenge_name');
                $challengeCat = $this->input->post('category');
                $allowNumber = $this->input->post('allow_no');
                $votingStart = $this->input->post('voting_start');
                $votingEnd = $this->input->post('voting_ends');;
                $challengeType = $this->input->post('challenge_type');
                $description = $this->input->post('description');
                $winnerPrice = $this->input->post('winner_point');
                $peopleChoice = $this->input->post('people_choice');
                $biography = $this->input->post('biography');


                //check if the credit is going to be enough

                $offerCredit = $winnerPrice + $peopleChoice;

                //get out the user's credit

                $this->db->where("user_id='$userID'");
                $countCredit = $this->db->count_all_results('credit_subscription');


                if($countCredit <=0 || $data['creditUnit'] <$offerCredit){

                    $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>X</a>Insufficient Credit!!!: You do not have a sufficient credit to open this challenge.. Please <a href='". base_url('upgrade'). "' class='text-white'> Subscribe Here </a> </div>";
                    $this->load->view('template/header', $data);
                    $this->load->view('challenges_start', $data);

                }
                else{

                    if (!empty($_FILES['file']['name'])) {

                        $uploadPath = './uploads/challenges/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'gif|jpg|png|mp4';
                        $config['max_size'] = 10048;
                        $config['encrypt_name'] = TRUE;
                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('file')) {
                            //die('it works here');

                            $fileData = $this->upload->data();

                            $insertData = array(
                                'challenge_name' => $challengeName,
                                'challenge_id' => $challengeID,
                                'allow_upload' => $allowNumber,
                                'category' => $challengeCat,
                                'type' => $challengeType,
                                'description' => $description,
                                'challenge_start_date'=>$votingStart,
                                'challenge_close_date'=>$votingEnd,
                                'challenge_banner' => $fileData['file_name'],
                                'winner_selection' => $winnerPrice,
                                'people_choice' => $peopleChoice,
                                'username'=>$data['username'],
                                'user_id'=>$_SESSION['userLogginID'],
                                'date' => date('Y-m-d H:i:s'),
                            );

                            $this->db->insert('challenges', $insertData);

                            $balanceCredit = $data['creditUnit']-$offerCredit;

                            //update the credit
                            $this->db->where("user_id='$userID'");
                            $this->db->update("credit_submitted", array('credit_amount'=>$balanceCredit));

                            //update user records
                            $this->db->where("user_id='$userID'");
                            $this->db->update('userz',array('about'=>$biography));

                            //save the credit offer

                            $submitCredit = array(
                                'user_id'=>$userID,
                                'username'=> $data['username'],
                                'credit_amount'=> $offerCredit,
                                'entry_id' => $challengeID,
                                'date'=> date('Y-m-d H:i:s'),

                            );
                            $this->db->insert("credit_submitted", $submitCredit);


                            //insert into timeline post

                            //insert into post table
                            $insertPost = array(

                                'post_id' => substr(str_shuffle("0123456789"), 0, 10),
                                'poster_name' => $data['username'],
                                'poster_id' => $this->session->userLogginID,
                                'post_type' => 'challenge',
                                'media_id' => $challengeID,
                                'status' => 0,
                                'date'=> date('Y-m-d H:i:s'),
                            );

                            $this->db->insert("post_timeline", $insertPost);




                            redirect(base_url("success_upload/success_challenge"));
                        }

                        else{

                            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>X</a> " . $this->upload->display_errors() . "</div>";
                            $this->load->view('template/header', $data);
                            $this->load->view('challenges_start', $data);
                        }
                    }

                    else{

                        $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>X</a> Please upload the cover picture"."</div>";
                        $this->load->view('template/header', $data);
                        $this->load->view('challenges_start', $data);
                    }
                }

            }

        }
    }



    public function check($id){

        $data['success'] = "";


        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";

            redirect(base_url('login?redirect=challenges/check/'.$id));

            /*$this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);*/
        }
        else {

            $userID = $_SESSION['userLogginID'];

            require_once('action/fetch_user.php');

            $this->db->where("challenge_id ='$id'");
            $countChallenge = $this->db->count_all_results('challenges');

            if($countChallenge <=0){
                redirect(base_url('challenges'));
            }
            else{
                $this->db->where("challenge_id ='$id'");
                $getChallenge = $this->db->get('challenges')->result();

                foreach($getChallenge as $data['chanllengex']);

                $data['title'] = $data['chanllengex']->challenge_name;

                if($data['chanllengex']->winner_selection == '30'){
                    $data['banner'] ="014-badge-7.png";
                }
                elseif($data['chanllengex']->winner_selection == '60'){

                    $data['banner'] ="015-badge-6.png";
                }
                elseif($data['chanllengex']->winner_selection == '100'){

                    $data['banner'] ="016-badge-5.png";
                }
                elseif($data['chanllengex']->winner_selection == '150'){

                    $data['banner'] ="017-medal-2.png";
                }

                elseif($data['chanllengex']->winner_selection == '200'){

                    $data['banner'] ="023-badges-1.png";
                }




                if($data['chanllengex']->people_choice == '30'){
                    $data['choiceBanner'] ="014-badge-7.png";
                }
                elseif($data['chanllengex']->people_choice == '60'){

                    $data['choiceBanner'] ="015-badge-6.png";
                }
                elseif($data['chanllengex']->people_choice == '100'){

                    $data['choiceBanner'] ="016-badge-5.png";
                }
                elseif($data['chanllengex']->people_choice == '150'){

                    $data['choiceBanner'] ="017-medal-2.png";
                }

                elseif($data['chanllengex']->people_choice == '200'){

                    $data['choiceBanner'] ="023-badges-1.png";
                }


                //count entry
                $this->db->where("entry_id='$id'");
                $data['countEntries'] = $this->db->count_all_results('entries_submited');

                $this->load->view('template/header',$data);
                $this->load->view('challenge_page',$data);
            }



        }




    }


    public function explore($id){


        if(!isset($_SESSION['userLogginID'])){

            redirect(base_url('login?redirect=challenges/explore/'.$id));


        } else{
            $data['success'] = "";
            $data['title'] = $id;


            //get category
            $current_date = date('Y-m-d');

            $this->db->where("status='0'");
            $data['getCategory'] = $this->db->get('category')->result_array();

            $this->db->where('challenge_start_date >= ',date('Y-m-d', strtotime($current_date)));
            $this->db->where("status = '0'");
            $data['countChallenges'] = $this->db->count_all_results('challenges');

            //get all the challenges out
            $this->db->where('challenge_start_date >= ',date('Y-m-d', strtotime($current_date)));
            $this->db->where("status = '0'");
            $data['getChallenge'] = $this->db->get('challenges')->result_array();



            require_once('action/fetch_user.php');
            $this->load->view("template/header",$data);
            $this->load->view("challenges_explore", $data);

        }
    }


    public function entries($id){

        $data['success'] ="";

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";

            redirect(base_url('login?redirect=challenges/check/'.$id));

            /*$this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);*/
        }
        else{

            $data['title'] = 'Entries';

            require_once('action/fetch_user.php');

            $this->db->where("challenge_id='$id'");
            $checkChallenge = $this->db->count_all_results("challenges");

            if($checkChallenge >=1){

                //get challenges information
                $this->db->where("challenge_id='$id'");
                $getChallenge = $this->db->get("challenges")->result();

                foreach($getChallenge as $data['getChallenge'])

                    //get entries

                    $challengeEntryID = $data['getChallenge']->challenge_id;

                    $this->db->where("entry_id='$challengeEntryID' AND entry_type='challenge'");
                    $data['getChallengeEntry'] = $this->db->get('entries_submited')->result_array();

                $this->load->view("template/header", $data);
                $this->load->view("challenges_entry", $data);


            }

            else{


                die('Challenge does not exist');
            }




        }



    }

    public function submit_entry($id){
        $data['success']="";
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['userLogginID'])){


            require_once('action/fetch_user.php');

            $userID = $_SESSION['userLogginID'];
            $photoID = $this->input->post("photo");
            $entryType = $this->input->post("entry_type");

            //get contest information

            $this->db->where("challenge_id='$id'");
            $countContest = $this->db->count_all_results('challenges');

            if($countContest >= 1){

                //get challenges information
                $this->db->where("challenge_id='$id'");
                $getChallenge = $this->db->get("challenges")->result();

                foreach($getChallenge as $data['getChallenge']);

                    //get entries
                    $challengeEntryID = $data['getChallenge']->challenge_id;
                    $allowUpload = $data['getChallenge']->allow_upload;

                //die($allowUpload);

                //count the contest entries check if the user has already submitted photo for this entry
                $this->db->where("entry_id='$id' AND user_id='$userID'");
                $countEntries = $this->db->count_all_results('entries_submited');

                if($countEntries >= $allowUpload){

                    //user already submitted the
                    //die('');

                    $data['success'] = "<div class='alert alert-danger text-white'><a class='close' data-dismiss='alert'>x</a> You have reached the maximum upload limit for this challenge</div>";
                    $data['title'] ='Entries ';
                    foreach($getChallenge as $data['getChallenge'])
                        //get entries
                        $challengeEntryID = $data['getChallenge']->challenge_id;

                    $this->db->where("entry_id='$challengeEntryID' AND entry_type='challenge'");
                    $data['getChallengeEntry'] = $this->db->get('entries_submited')->result_array();

                    $this->load->view("template/header", $data);
                    $this->load->view("challenges_entry", $data);
                }

                else{
                    //get the picture details for submission
                    $this->db->where("picture_id='$photoID'");
                    $getPictureD = $this->db->get("uploads")->result();
                    foreach($getPictureD as $pictureD);

                    //get the challenges information
                    $this->db->where("challenge_id='$id'");
                    $getChallengeID = $this->db->get("challenges")->result();

                    foreach($getChallengeID as $challengeItem)


                    $insertPhoto = array(

                        'entry_type'=>$entryType,
                        'entry_name'=>$challengeItem->challenge_name,
                        'entry_id'=>$id,
                        'picture_id'=>$photoID,
                        'picture_name'=>$pictureD->picture_medium_name,
                        'user_id' => $userID,
                        'status'=>0,
                        'submited_date'=>date('Y-m-d H:i:s')

                    );

                    $this->db->insert('entries_submited', $insertPhoto);

                    //die("uploaded successful");

                    //get challenges information
                    $this->db->where("challenge_id='$id'");
                    $getChallenge = $this->db->get("challenges")->result();

                    $data['success'] = "<div class='alert bg-black text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Entry Submitted Successfully!</div>";
                    $data['title'] ='Entries ';
                    foreach($getChallenge as $data['getChallenge'])
                        //get entries



                        $challengeEntryID = $data['getChallenge']->challenge_id;

                    $this->db->where("entry_id='$challengeEntryID' AND entry_type='challenge'");
                    $data['getChallengeEntry'] = $this->db->get('entries_submited')->result_array();

                    $this->load->view("template/header", $data);
                    $this->load->view("challenges_entry", $data);

                }

            }
            else{
                //contests not found


            }




        }

        else{

            redirect(base_url('login?redirect=challenges/check/'.$id));
            //die("You are not allowed to access this page directly");
        }




    }



}
