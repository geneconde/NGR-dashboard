<?php
	require_once 'session.php';
	require_once 'controller/StudentModule.Controller.php';

	$userid		= $user->getUserid();
	$moduleid 	= $_GET['m'];
	$smc		= new StudentModuleController();
	$sm 		= $smc->loadStudentModuleByUser($userid, $moduleid);

	if($sm) $smid = $sm[0]['student_module_ID'];
	else $smid = $smc->addStudentModule($userid, $moduleid);

	$_SESSION['smid']= $smid;

	$location = "modules/".$moduleid."/1.php";

	header("Location: ".$location);
?>