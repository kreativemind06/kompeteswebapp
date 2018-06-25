<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 12-Apr-18
 * Time: 7:46 AM
 */


class Success_upload extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
    }


    public function index(){

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        }
        else {

            $data['success'] = "";
            $data['title'] = "Success Upload";
            require_once('action/fetch_user.php');

            $this->load->view('template/header', $data);
            $this->load->view('success_upload', $data);
            $this->load->view('template/footer', $data);

        }

    }

    public function success_challenge(){

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        }
        else {

            $data['success'] = "";
            $data['title'] = "Success Upload";
            require_once('action/fetch_user.php');

            $this->load->view('template/header', $data);
            $this->load->view('success_challenge', $data);
            $this->load->view('template/footer', $data);

        }
    }


    public function success_contest(){

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        }
        else {

            $data['success'] = "";
            $data['title'] = "Success Upload";
            require_once('action/fetch_user.php');

            $this->load->view('template/header', $data);
            $this->load->view('success_challenge', $data);
            $this->load->view('template/footer', $data);

        }
    }




}