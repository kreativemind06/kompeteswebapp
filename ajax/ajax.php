<?php 
/*
    Author's: Aizaz.dinho, Meezi (geeks of meralesson.com)
    Website: Meralesson.com
*/
include('../core/init.php'); 
$get = new Main;
$submit = new Main;
$user_id = $_SESSION['user_id'];
//if user submit follow 
if(isset($_POST['follow'])){
	$follow_id = $_POST['follow'];
    //run function from main class
	$submit->follow($user_id,$follow_id);		 
}
//if user submit unfollow
if(isset($_POST['Unfollow'])){
    $follow_id = $_POST['Unfollow'];
    //run function from main class
	$submit->unFollow($user_id,$follow_id);		 	 
}




?>