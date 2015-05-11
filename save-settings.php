<?php
	require_once 'session.php';
	include_once 'controller/TeacherModule.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	
	$userid 	= $user->getUserid();
	$mid		= $_POST['mid'];
	$set		= $_POST['set'];
	$value		= $_POST['val'];
	
	$dtc 		= new DiagnosticTestController();
	$tmc		= new TeacherModuleController();

	if($set == 'pre') $dtc->updateDTActivation($userid, $mid, 1, $value);
	else if($set == 'post') $dtc->updateDTActivation($userid, $mid, 2, $value);
	else if($set == 'module') $tmc->updateTeacherModule($userid, $mid, $value);
?>