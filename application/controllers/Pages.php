<?php
/**
 * Created by PhpStorm.
 * User: nestor
 * Date: 06/06/2018
 * Time: 3:36 PM
 */


class Pages extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('form','url'));
        $this->load->database();

    }



    public function about(){

        $data['title']="About Kompetes";
        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');
        }
        $this->load->view('template/header', $data);
        $this->load->view('about', $data);
        $this->load->view('template/footer', $data);

    }


    public function privacy(){


        $data['title']="About Kompetes";
        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');
        }
        $this->load->view('template/header', $data);
        $this->load->view('privacy', $data);
        $this->load->view('template/footer', $data);

}

    public function terms(){
        $data['title']="About Kompetes";
        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');
        }
        $this->load->view('template/header', $data);
        $this->load->view('term', $data);
        $this->load->view('template/footer', $data);
    }



    public function support(){
        $data['success'] ="";
        $data['title']="About Kompetes";
        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');
        }


        $this->form_validation->set_rules('fullname','Fullname','trim|required');
        $this->form_validation->set_rules('organisation','Organisation','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('reason','Reason','trim|required');
        $this->form_validation->set_rules('message','message','trim|required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger no-border-radius text-white'><a class='close' data-dismiss='alert'>&times;</a>", "</div>");


        if($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('support', $data);
            $this->load->view('template/footer', $data);
        }
        else{

            $fullname = $this->input->post('fullname');
            $organisation = $this->input->post('organisation');
            $email = $this->input->post('email');
            $reason = $this->input->post('reason');
            $message = $this->input->post('message');


            $insertSponsor = array(

                'fullname'=>$fullname,
                'email'=>$email,
                'organisation'=> $organisation,
                'reason'=>$reason,
                'message'=> $message,
                'date'=> date('Y-m-d H:i:s')

            );

            $this->db->insert("supports", $insertSponsor);

            //send mail to support@kompetes.co.uk

            require_once('action/support_mail.php');

            $to = 'support@kompetes.co.uk';
            $from = "Kompetes.co.uk";
            $from_add = "Kompetes.co.uk";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
                'Reply-To: '.$from_add . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $subject = 'Kompetes ' . $reason . ' Support';
            //mail($to,$subject,$mailBody.'</body></html>',$headers, '-f'.$from_add);






            $data['success'] = "<div class='alert alert-success text-white'><a class='close' data-dismiss='alert'>x</a> Success !!!.. We have received your message successfully  </div>";

            $this->load->view('template/header', $data);
            $this->load->view('support', $data);
            $this->load->view('template/footer', $data);



        }

    }




    public function sponsor_contest(){
        $data['title']="About Kompetes";
        $data['success'] ="";
        if(isset($_SESSION['userLogginID'])){

            require_once('action/fetch_user.php');
        }
        $this->form_validation->set_rules('fullname','Fullname','trim|required');
        $this->form_validation->set_rules('brand','Brand','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('tel','Telephone','trim|required');
        $this->form_validation->set_rules('message','message','trim|required');


        if($this->form_validation->run() == false)
        {
            $this->load->view('template/header', $data);
            $this->load->view('sponsor', $data);
            $this->load->view('template/footer', $data);

        }
        else{


            $fullname = $this->input->post('fullname');
            $phone = $this->input->post('tel');
            $email = $this->input->post('email');
            $brand = $this->input->post('brand');
            $message = $this->input->post('message');


            $insertSponsor = array(

                'fullname'=>$fullname,
                'email'=>$email,
                'tel'=> $phone,
                'brand'=> $brand,
                'message'=> $message,
                'date'=> date('Y-m-d H:i:s')

            );

            $this->db->insert("sponsors_contest", $insertSponsor);

            //send mail to support@kompetes.co.uk

            include_once('action/sponsor_mail.php');

            $to = 'partnerships@kompetes.co.uk';
            $from = "Kompetes.co.uk";
            $from_add = "Kompetes.co.uk";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: =?UTF-8?B?". base64_encode($from) ."?= <$from_add>\r\n" .
                'Reply-To: '.$from_add . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $subject = 'Kompetes Contest Partnership  ';
            mail($to,$subject,$mailBody.'</body></html>',$headers, '-f'.$from_add);

            $data['success'] = "<div class='alert alert-success text-white'><a class='close' data-dismiss='alert'>x</a> Success !!!.. We have received your message successfully  </div>";

            $this->load->view('template/header', $data);
            $this->load->view('sponsor', $data);
            $this->load->view('template/footer', $data);



        }

    }





}