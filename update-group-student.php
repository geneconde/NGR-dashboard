<?php
	require_once 'session.php';
	include_once 'controller/User.Controller.php'; 
	require_once 'controller/StudentGroup.Controller.php';
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/User.class.php');

	$uc = new UserController();
	$userid = $user->getUserid();

	$sgc 		= new StudentGroupController();
	$groups		= $sgc->getGroups($userid);

	$stds = $uc->getAllStudents($userid);
	$groupName = $_POST['group'];
	// $teacherID = $stds[0]["teacher_id"];
	// $groupHolder = $sgc->getGroups($teacherID);
	// $groupID = $groupHolder[0]['group_id'];
	// $sgc->updateGroupName($groupID, $groupName);
	// header("Location: modules.php");
?>