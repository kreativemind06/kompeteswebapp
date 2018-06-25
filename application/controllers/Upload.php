<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 09-Apr-18
 * Time: 11:26 AM
 */



class Upload extends CI_Controller{

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
        $data['title'] = "Profile";

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data['title'] = 'Upload';
            $data['success']="";

            require_once('action/fetch_user.php');

            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('adult', 'Adult', 'trim');
            $this->form_validation->set_rules('tags', 'Tags', 'required|trim');
            $this->form_validation->set_rules('category[]', 'Category', 'required|trim');
            $this->form_validation->set_rules('discription', 'Description', 'required|trim');


            if ($this->form_validation->run() == false) {
                $this->load->view('template/header', $data);
                $this->load->view('upload', $data);

            }
            else {


                if (!isset($_SESSION['set_picture_id'])) {


                    $data['success'] = "<div class='alert alert-danger text-white'><a class='close' data-dismiss='alert'>x</a> Please upload your pictures first and proceed to fill the form</div>";
                    $this->load->view('template/header', $data);
                    $this->load->view('upload', $data);

                }
                else {


                    $title_pic = $this->input->post('title');
                    $adultActive = $this->input->post('adult');
                    $tags = $this->input->post('tags');
                    $category_pic = $this->input->post('category[]');
                    $description = $this->input->post('discription');

                    //update the table

                    //$countCat = count($category_pic);

                    /*  for($i=0; $i<$countCat; $i++) {

                           $category_pic[$i];

                      }*/

                    $categoryPic = implode(',', $category_pic);
                    $updateForm = array(
                        'title' => $title_pic,
                        'category' => $categoryPic,
                        'description' => $description,
                        'tags' => $tags,
                        'adult' => $adultActive,
                    );

                    $pictureSession = $_SESSION['set_picture_id'];
                    //echo $categoryPic . '<br>';
                    //echo $pictureSession;

                    $this->db->where("group_id = '$pictureSession'");
                    $this->db->update('uploads', $updateForm);
                    $this->session->unset_userdata(array('set_picture_id'));

                    redirect(base_url('success_upload'));


                }
            }
        }
    }

    public function upload_pix(){


        //$config['upload_path']   = './uploads/';
        //$config['allowed_types'] = 'gif|jpg|png';
        //$config['max_size']      = 1024;


        require_once('action/fetch_user.php');

        $files = $_FILES;
        $path=dirname(__FILE__);
        $abs_path=explode('/application/',$path);
        $pathToImages = './uploads/';
        $pathToThumbImages = './uploads/small_thumb/';
        $pathToMediumImages = './uploads/medium_thumb/';

        //$this->load->library('upload', $config);
        //$this->upload->do_upload('file');

        $cpt = count($_FILES['file']['name']);
        $groupId = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);

        for($i=0; $i<$cpt; $i++){

            $_FILES['files']['name'] = $files['file']['name'][$i];
            $_FILES['files']['type'] = $files['file']['type'][$i];
            $_FILES['files']['tmp_name'] = $files['file']['tmp_name'][$i];
            $_FILES['files']['error'] = $files['file']['error'][$i];
            $_FILES['files']['size'] = $files['file']['size'][$i];

            $config['upload_path'] = $pathToImages;
            $config['max_size'] = 0;
            /*$config['max_width']            = 1024;
            $config['max_height']           = 768;*/
            $config['allowed_types'] = 'jpg|jpeg|png';



            $this->load->library('upload', $config);
            $this->upload->initialize($config);



            if ($this->upload->do_upload('files')){

                $uploaddata=$this->upload->data();
                {
                    $randomstr = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
                    $imgNewname = $randomstr;
                    $img_name = $uploaddata['raw_name'];
                    $img_ext = $uploaddata['file_ext'];

                    $imgNewname = $imgNewname.$img_ext;
                    $thumbname = $randomstr.'_small'.$img_ext;
                    $mediumName = $randomstr.'_medium'.$img_ext;

                    if(strtolower($img_ext) == '.jpg' || strtolower($img_ext) == '.jpeg'){
                        $img = imagecreatefromjpeg( "{$pathToImages}{$img_name}{$img_ext}" );
                    }
                    elseif(strtolower($img_ext) == '.png')
                    {
                        $img = imagecreatefrompng( "{$pathToImages}{$img_name}{$img_ext}" );
                    }
                    $thumbWidth = '394';
                    $thumbHeight = '210';


                    $width = imagesx( $img );
                    $height = imagesy( $img );

                    $new_width = $thumbWidth;
                    $new_height = floor( $height * ( $thumbWidth / $width ) );
                    //$new_height = $thumbHeight;
                    $tmp_img = imagecreatetruecolor( $new_width, $new_height );
                    imagealphablending($tmp_img, false);
                    imagesavealpha($tmp_img, true);
                    $transparent =  imagecolorallocate($tmp_img, 0, 0, 0);
                    imagecolortransparent($tmp_img, $transparent );
                    imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

                    if(strtolower($img_ext) == '.jpg' || strtolower($img_ext) == '.jpeg'){
                        imagejpeg( $tmp_img, "{$pathToThumbImages}{$img_name}{$img_ext}" );
                    }
                    elseif(strtolower($img_ext) == '.png')
                    {
                        imagepng( $tmp_img, "{$pathToThumbImages}{$img_name}{$img_ext}", 9 );
                    }


                    $mediumWidth = '680';
                    $mediumHeight = '580';
                    $newMediumHeight = floor($height * ($mediumWidth / $width));
                    //$newMediumHeight = "580";

                    $tmp_img_medium =  imagecreatetruecolor($mediumWidth, $newMediumHeight);
                    imagealphablending($tmp_img_medium, false);
                    imagesavealpha($tmp_img_medium, true);
                    $transparentMedium = imagecolorallocate($tmp_img_medium, 0,0,0);
                    imagecolortransparent($tmp_img_medium, $transparentMedium);
                    imagecopyresized($tmp_img_medium, $img, 0,0,0,0, $mediumWidth, $newMediumHeight, $width, $height);

                    if(strtolower($img_ext) == '.jpg' || strtolower($img_ext) == '.jpeg'){
                        imagejpeg( $tmp_img_medium, "{$pathToMediumImages}{$img_name}{$img_ext}" );
                    }
                    elseif(strtolower($img_ext) == '.png')
                    {
                        imagepng( $tmp_img_medium, "{$pathToMediumImages}{$img_name}{$img_ext}", 9 );
                    }


                    rename($pathToMediumImages.$img_name.$img_ext, $pathToMediumImages.$mediumName);
                    rename($pathToImages.$img_name.$img_ext, $pathToImages.$imgNewname);
                    rename($pathToThumbImages.$img_name.$img_ext, $pathToThumbImages.$thumbname);
                    $imgDataArr['prod_image'] = $imgNewname;
                }


                //insert Picture

                $insertPicture = array(

                    'picture_name' => $imgNewname,
                    'picture_medium_name'=>$mediumName,
                    'picture_small_name'=>$thumbname,
                    'username' => $data['username'],
                    'picture_id' => $randomstr,
                    'user_id' => $this->session->userLogginID,
                    'status'=>0,
                    'group_id'=>$groupId,
                    'date'=>date('Y-m-d H:i:s'),
                );

                $this->db->insert("uploads", $insertPicture);

                //insert into post table

                $insertPost = array(

                    'post_id' => substr(str_shuffle("0123456789"), 0, 10),
                    'poster_name' => $data['username'],
                    'poster_id' => $this->session->userLogginID,
                    'post_type' => 'photo',
                    'media_id' => $randomstr,
                    'status' => 0,
                    'date'=> date('Y-m-d H:i:s'),
                );

                $this->db->insert("post_timeline", $insertPost);

                //set the is into session
                $sessionRAnd = $groupId;

                $_SESSION['set_picture_id'] = $sessionRAnd;

            }

            else{

                $data['success'] = "<div class='alert alert-danger'><a class='close' data-dismiss='alert'></a> Failed..." . $this->upload->display_errors()."</div>";
                redirect(base_url());

            }
        }

        //$this->db->insert();
        print_r('Image Uploaded Successfully.');
        exit;
    }


    public function video()
    {

        $data['success'] = "";
        $data['title'] = "Profile";

        if (!isset($this->session->userLogginID)) {

            $data['title'] = 'Login';
            $data['success'] = "<div class='alert alert-danger text-white no-border-radius'><a class='close' data-dismiss='alert'>x</a> Please login</div>";
            $this->load->view('template/header', $data);
            $this->load->view('login', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data['title'] = 'Upload';
            $data['success'] = "";

            require_once('action/fetch_user.php');

            $this->form_validation->set_rules('title', 'Title', 'required|trim');
            $this->form_validation->set_rules('adult', 'Adult', 'trim');
            $this->form_validation->set_rules('tags', 'Tags', 'required|trim');
            $this->form_validation->set_rules('category[]', 'Category', 'required|trim');
            $this->form_validation->set_rules('discription', 'Description', 'required|trim');


            if ($this->form_validation->run() == false) {
                $this->load->view('template/header', $data);
                $this->load->view('upload_video', $data);

            } else {


                if (!isset($_SESSION['set_picture_id'])) {
                    $data['success'] = "<div class='alert alert-danger text-white'><a class='close' data-dismiss='alert'>x</a> Please upload your pictures first and proceed to fill the form</div>";
                    $this->load->view('template/header', $data);
                    //$this->load->view('upload', $data);

                } else {


                }
            }

        }
    }



        public function upload_video(){


            //$config['upload_path']   = './uploads/';
            //$config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size']      = 1024;

            if($_SERVER['REQUEST_METHOD'] =="Post") {


                die("welcome");
                require_once('action/fetch_user.php');

                $files = $_FILES;
                $path = dirname(__FILE__);
                $abs_path = explode('/application/', $path);
                $pathToImages = './videos/';
                $pathToThumbImages = './videos/';
                $pathToMediumImages = './videos/';

                //$this->load->library('upload', $config);
                //$this->upload->do_upload('file');

                $cpt = count($_FILES['file']['name']);
                $groupId = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8);

                for ($i = 0; $i < $cpt; $i++) {

                    $_FILES['files']['name'] = $files['file']['name'][$i];
                    $_FILES['files']['type'] = $files['file']['type'][$i];
                    $_FILES['files']['tmp_name'] = $files['file']['tmp_name'][$i];
                    $_FILES['files']['error'] = $files['file']['error'][$i];
                    $_FILES['files']['size'] = $files['file']['size'][$i];

                    $config['upload_path'] = $pathToImages;
                    $config['max_size'] = 0;
                    /*$config['max_width']            = 1024;
                    $config['max_height']           = 768;*/
                    $config['allowed_types'] = 'mp4|jpg|jpeg|png';


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);


                    if ($this->upload->do_upload('files')) {


                    }

                }
            }

    }




    public function u_video(){

        $data['title'] ="Upload Video";

        if(isset($_SESSION['userLogginID'])){


            require_once('action/fetch_user.php');
        }

        $this->load->view('template/header', $data);

        if($_SERVER['REQUEST_METHOD'] == 'Post'){

            error_reporting(E_ALL | E_STRICT);
            require('UploadHandler.php');
            $upload_handler = new UploadHandler();
        }


        $this->load->view("video_upload");



    }
}