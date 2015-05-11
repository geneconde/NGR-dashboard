<?php
	require_once 'session.php';
	include_once 'controller/TeacherModule.Controller.php';
	
	$userid 	= $user->getUserid();
	$mid		= $_POST['mid'];
	$checked 	= $_POST['ck'];
	
	$tmc = new TeacherModuleController();
	$tmc->updateTeacherModule($userid, $mid, $checked);
?>