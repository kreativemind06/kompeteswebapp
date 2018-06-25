<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 06-Apr-18
 * Time: 1:19 PM
 */



    $UserID = $this->session->userLogginID;


   $whereID = $this->db->where("user_id = '$UserID'");
    $getUser = $this->db->get('userz')->result();
    foreach($getUser as $user);
    $data['username'] = $user->username;
    $data['userEmail'] = $user->email;
    $data['userRegDate'] = $user->date;
    $userRegType = $user->reg_type;
    $data['userFirstName'] = $user->firstname;
    $data['userLastname'] = $user->lastname;
    $data['userState'] = $user->state;
    $data['userCountry'] = $user->country;
    $data['userCity'] = $user->city;
    $data['userBirthday'] = $user->birthday;
    $data['userFacebook'] = $user->facebook;
    $data['userTwitter'] = $user->twitter;
    $data['userInstagram'] = $user->instagram;
    $data['userWebsite'] = $user->website;
    $data['userDescription'] = $user->about;
    $data['userGender'] = $user->gender;
    $data['userAbout'] = $user->about;
    $data['userPhoto'] = $user->picture;
    $data['userPassword'] = $user->passwordx;
    $data['adminStatus'] = $user->admin;

//get the numbers of pictures uploaded by the user

 $this->db->where("user_id = '$UserID'");
$data['countUploadPicture'] = $this->db->count_all_results('uploads');

//get the picture
$this->db->where("user_id = '$UserID'");
$data['getUploadedPhotos'] = $this->db->get('uploads')->result_array();


//get user credit unit
$this->db->where("user_id = '$UserID'");
$countUserCredit = $this->db->count_all_results('credit_subscription');

if($countUserCredit >=1) {
 $this->db->where("user_id = '$UserID'");
 $getUserCredit = $this->db->get('credit_subscription')->result();

 foreach ($getUserCredit as $userCredit) ;
 $data['creditUnit'] = $userCredit->credit;
}
else{

 $data['creditUnit'] = 0;

}

/*//get the no of follower

$this->db->where("user_id = '$UserID'");
$data['countFollowers'] = $this->db->count_all_results('followingx');


//get the no of following
$this->db->where("follower_id = '$UserID'");
$data['countFollowings'] = $this->db->count_all_results('followingx');

//get all the followings
$this->db->where("user_id = '$UserID'");
$data['getFollowings'] = $this->db->get("followingx")->result_array();*/



//get user notifications

$this->db->where("user_id ='$UserID' || user_id ='general'");
$data['countNotification'] = $this->db->count_all_results('notificationx');

if($data['countNotification'] >=1){

 //Fetch result out
 $this->db->where("user_id ='$UserID' || user_id ='general'");
 $this->db->order_by("date",'DESC');
 $data['getNotifications'] = $this->db->get('notificationx')->result_array();


}
