<?php
	session_start();
	
	if(!((isset($_SESSION['uname'])) || (isset($_SESSION['admin'])))){
		header("Location: index.php");
	}
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/controller/User.Controller.php'); 
	
	$user = null;
	
	$uc = new UserController();
	if(isset($_SESSION['uname'])){
		$user = $uc->loadUser($_SESSION['uname']);
	}
	
	$name = $user->getFirstname();
	$gender = strtolower($user->getGender());
?>