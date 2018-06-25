<?php

session_start();

	//include("dbcon.php");
    //$connect = mysqli_connect('localhost','root','Notbypower@2018','komepetes');
    $connect = mysqli_connect('localhost','root','Notbypower@2018','komepetes');
	$userip = '91.232.12';
	$userFollow = @$_REQUEST['id'];
	//$userFollow = 'di18cAlR7361-Prudent0014-f9aSV4pm9229-Ayobami';


    $cutUser =  explode('-', $userFollow);

    $followerID = $cutUser[0];
    $followerName = $cutUser[1];
    $followingID = $cutUser[2];
    $followingName = $cutUser[3];
    $date = date('Y-m-d H:i:s');



    //echo 'Fodllower ID: '. $followerID .'<br>';
    //echo 'Fodllower Name: '. $followerID .'<br>';
    //echo 'Fodllowing ID: '. $followingID .'<br>';
    //echo 'Fodllowing Name: '. $followingName .'<br>';

    if($followerID !=="" && $followingID !=="" && $followingName !=="" && $followerName !=="") {

        //check if the user is already following
        $check = mysqli_query($connect, "SELECT * FROM `followingx` WHERE follower_id = '$followingID' AND `user_id`='$followerID'");
        $countCheck = mysqli_num_rows($check);

        if ($countCheck <= 0) {

            $insert = @mysqli_query($connect, "INSERT INTO `followingx` (`username`,`user_id`,`follower_name`,`follower_id`,`status`,`date`) VALUES('" . $followerName . "','" . $followerID . "','" . $followingName . "','" . $followingID . "','0','" . $date . "')");


            //notify the person of the follower information

            $message = $followerName . ' Started following you.. check <a href="profile/check/' . $followerID . '">' . $followingName . 's profile for more information</a>';
            $link =  base_url("profile/check/").$followingID;
            $user_id = $followerID;
            $status = 0;
            $remake = '';


            $insertNotification = mysqli_query($connect, "INSERT INTO `notificationx` (`message`,`link`,`user_id`,`status`,`date`,`remark`) VALUES('$message','" . $link . "','$user_id','0','$date','$remake')");


            if (!$insertNotification) {

                echo mysqli_error($connect);

            }

            echo '<a class="btn follow following" href="#"> <i class="ext-red"></i>Following</a>';
        }
        else {

            $deleteFolower = mysqli_query($connect, "DELETE FROM `followingx` WHERE follower_id = '$followingID' AND `user_id`='$followerID'");

            if (!$deleteFolower) {
                echo mysqli_error($connect);
            }

            echo '<a class="btn follow" href="#"> <i class="fa fa-user-plus text-red"></i> Follow</a>';

            //die('Delete');
        }
    }


//@mysqli_query($connect,"INSERT INTO digg_follower_ip (userip,digg_id) VALUES('".$userip."','44')");/
//echo '<a class="btn-following" href="#"></a>';


?>