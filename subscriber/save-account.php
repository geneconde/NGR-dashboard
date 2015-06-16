<?php
	require_once '../session.php';
	include_once '../controller/User.Controller.php';
	require_once '../controller/Security.Controller.php';
	
	$userid		= $_GET['user_id'];
	$type		= $_GET['type'];
	
	$uname 		= $_POST['username'];
	$fname		= $_POST['fname'];
	$lname		= $_POST['lname'];
	$gender		= $_POST['gender'];
	$squestion	= $_POST['squestion'];
	$sanswer	= $_POST['sanswer'];
	
	$uc			= new UserController();
	$sc 		= new SecurityController();
	$securityRecord = $sc->getSecurityRecord($userid);
	$uc->updateUser($userid, $uname, $fname, $lname, $gender);
	if(sizeof($securityRecord) == 1){
		$sc->updateSecurityQuestion($squestion, $sanswer, $userid);
	} else {
		$sc->setSecurityQuestion($squestion, $sanswer, $userid);
	}
	if($type == 0) $_SESSION['uname'] = $uname;
	
	header("Location: edit-account.php?user_id={$userid}&f=1");
?>