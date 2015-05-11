<?php
	require_once '../session.php';
	include_once '../controller/User.Controller.php';
	
	$userid		= $_GET['user_id'];
	$type		= $_GET['type'];
	
	$uname 		= $_POST['username'];
	$password 	= $_POST['password'];
	$fname		= $_POST['fname'];
	$lname		= $_POST['lname'];
	$gender		= $_POST['gender'];
	
	$uc			= new UserController();
	$uc->updateUser($userid, $uname, $password, $fname, $lname, $gender);
	
	if($type == 0) $_SESSION['uname'] = $uname;
	
	header("Location: edit-account.php?user_id={$userid}&f=1");
?>