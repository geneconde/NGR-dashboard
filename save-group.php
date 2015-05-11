<?php
	require_once 'session.php';
	require_once 'controller/StudentGroup.Controller.php';
	
	$sgc		= new StudentGroupController();
	$userid 	= $user->getUserid();
	$group_name	= $_POST['groupname'];
	
	$sgc->addGroup($group_name, $userid);
	
	header("Location: student-accounts.php");
?>