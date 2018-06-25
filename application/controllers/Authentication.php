<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 05-Apr-18
 * Time: 1:21 PM
 */



class Authentication extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url','form'));
        $this->load->library(array('session','form_validation'));
        $this->load->database();
    }



    public function login(){

        $data['title'] = "Login";
        $data['success']="";

        if(isset($_SESSION['userLogginID'])){

            redirect(base_url('user/home'));
        }


        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>&times;</a>", "</div>");

        if($this->form_validation->run() == false){


            $this->load->view('template/header', $data);
            $this->load->view('login',$data);
            $this->load->view('template/footer', $data);
        }

        else{

            $userName = $this->input->post('username');
            $passWord = md5($this->input->post('password'));


            //check if the user had register
            $this->db->where("username='$userName' AND passwordx='$passWord'");
            $countUser = $this->db->count_all_results('userz');

            //check if the the user has confirm account

            $this->db->where("username='$userName' AND passwordx='$passWord' AND status='1'");
            $countUserCofirm = $this->db->count_all_results('userz');

            if($countUser <=0){

                $data['success'] = "<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>x</a> Incorrect Email or Password, Please try a correct username and password, or register as a new member </div>";
                $this->load->view('template/header', $data);
                $this->load->view('login',$data);
                $this->load->view('template/footer', $data);
            }

            /*elseif($countUserCofirm >=1){

                $data['success'] = "<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>x</a> Your are yet to activate your account from the mail sent to you. Please Login to your mail and activate your account </div>";
                $this->load->view('template/header', $data);
                $this->load->view('login',$data);
                $this->load->view('template/footer', $data);
            }*/

            else{

                //get the data out
                $this->db->where("username='$userName' AND passwordx='$passWord'");
                $getUser = $this->db->get('userz')->result();
                foreach($getUser as $user);

                $userID =  $user->user_id;
                $this->session->userLogginID = $userID;

                if(isset($_GET['redirect']))
                {
                    redirect(base_url($_GET['redirect']));
                }

                elseif($user->admin == false){

                    redirect(base_url('user/home'));
                }
                elseif($user->admin == true){

                    redirect(base_url('admin/home'));

                }
            }
        }
    }


    public function register(){

        $data['title']="Register";
        $data['success']='';
        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>&times;</a>", "</div>");
        $uniqueID = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8) . rand(111, 9993);

        if(isset($_SESSION['userLogginID'])){

            redirect(base_url('user/home?page=people'));
        }

        if($this->form_validation->run() == false){

            $this->load->view('template/header',$data);
            $this->load->view('register',$data);
            $this->load->view('template/footer',$data);
        }

        else{

            $userName = $this->input->post('username');
            $emailAddress = $this->input->post('email');
            $password = $this->input->post('password');



            //check if the user is already register

            $this->db->where("username = '$userName'");
            $this->db->or_where("email='$emailAddress'");
            $countUser =  $this->db->count_all_results('userz');

            if($countUser >=1){
                $data['success']="<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Username or Email already registered.. Please choose another username or check or password recovery</div>";
                $this->load->view('template/header',$data);
                $this->load->view('register',$data);
                $this->load->view('template/footer',$data);
            }
            else{


                $dataStore = array(
                    'username'=>$userName,
                    'email'=>$emailAddress,
                    'passwordx'=>md5($password),
                    'user_id' => $uniqueID,
                    'date'=> date('Y-m-d H:i:s'),
                    'reg_type'=> 'Direct',
                    'status'=>1,
                );

                $this->db->insert('userz', $dataStore);

                //follow by default

                $dataFOllow =array(

                    array(
                        'follower_name'=>$userName,
                        'follower_id'=>$uniqueID,
                        'username'=>'Prudent0014',
                        'user_id'=>'di18cAlR7361',
                        'date'=>date('Y-m-d H:i:s'),
                        'status'=>0,
                    ),

                    array(
                        'follower_name'=>$userName,
                        'follower_id'=>$uniqueID,
                        'username'=>'maguyva',
                        'user_id'=>'laPzgL9G3016',
                        'date'=>date('Y-m-d H:i:s'),
                        'status'=>0,
                    )
                )

                ;

                $this->db->insert_batch('followingx', $dataFOllow);



                //send confirmation mail
                require_once('action/confirm_reg_mail.php');

                $to = $emailAddress;
                $from = "Kompetes.com";
                $from_add = "Kompetes.com";

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
                    'Reply-To: '.$from_add . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                $subject = 'Kompetes User Account Confirmation';
                mail($to,$subject,$mailBody.'</body></html>',$headers, '-f'.$from_add);

                //send home
                $userID = $uniqueID;
                $this->session->userLogginID = $userID;
                redirect(base_url('user/home'));





                /*$data['success'] ="<div class='alert alert-success no-border-radius text-white'><a class='close' data-dismiss='alert'></a> Registration Successful!!!.. Please visit your email (".$emailAddress.") to activate your account </div>";
                $this->load->view('template/header',$data);
                $this->load->view('register',$data);
                $this->load->view('template/footer',$data);*/
            }
        }
    }


    public function confirmmail(){

        //Action



    }


    public function logout(){

        if(isset($this->session->userLogginID)){

            $this->session->unset_userdata(array('userLogginID'));

            redirect(base_url('login'));

        }

        else{
            $this->session->unset_userdata(array('userLogginID'));

            redirect(base_url('login'));
        }

    }




}