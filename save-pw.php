<?php
	require_once 'session.php';
	include_once('controller/User.Controller.php');
	
	$userid		= $_GET['user_id'];
	$pw			= $_POST['newpw'];
	
	//if(isset($_POST['currentpw'])) {
	// $password 	= $_POST['currentpw'];
	// $salt 		= sha1(md5($password));
	// $password 	= md5($password.$salt);
		 
	$uc 	= new UserController();
	//$match 	= $uf->checkUser($userid, $password);
	
	echo $userid."<br>";
	echo $pw."<br>";
		
	if(isset($_POST['newpw'])) {
		$password	= $_POST['newpw'];
		// $salt 		= sha1(md5($password));
		// $password 	= md5($password.$salt);

		//if($match) {
		$uc->updatePassword($userid, $password);
		header("Location: change-pw.php?user_id={$userid}&s=1");
		//} else {
			//header("Location: change-pw.php?user_id={$userid}&s=0");
		//}
	}
?>