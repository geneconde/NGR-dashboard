<?php
	session_start();
	include_once 'controller/User.Controller.php'; 
	
	$uc = new UserController();	
	$uc->logoutUser();
	header("Location: index.php");	
?>