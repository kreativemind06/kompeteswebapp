<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url','form'));
		$this->load->library(array('session','form_validation'));
		$this->load->database();
	}


	public function index()
	{
		$data['title']="Welcome";
		if(isset($_SESSION['userLogginID'])){

			require_once('action/fetch_user.php');
		}
		$this->load->view('template/header', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer', $data);

	}
}
