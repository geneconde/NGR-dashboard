<?php
	require_once 'session.php';	
	require_once 'controller/GroupModule.Controller.php';
	require_once 'controller/Events.Controller.php';

	$ev = new EventsController();
	$mid = $_GET['module_id'];
	$temp = str_replace("-", " ", $mid);
	$mname = ucwords($temp);
	$pren = $_GET['pren'];
	$postn = $_GET['postn'];
	$groupid = $_GET['group_id'];
	$userid = $user->getUserid();
	$username = $user->getUsername();
	
	$values = array(
		"pretest_id" 		=> $_POST['preid'],
		"posttest_id"		=> $_POST['postid'],
		"review_active"		=> $_POST['ractive'],
		"pre_active"		=> $_POST['preactive'],
		"post_active"		=> $_POST['postactive'],
		"timelimit_pre"		=> $_POST['pretl'],
		"timelimit_post"	=> $_POST['posttl']
	);
	
	echo json_encode($values);
	
	if($_POST['ractive']==1) { $ev->activates_module($userid, $username, $mname); }
	if($_POST['preactive']==1) { $ev->activate_pre($userid, $username, $pren); }
	if($_POST['postactive']==1) { $ev->activate_post($userid, $username, $postn); }

	$gmc = new GroupModuleController();
	$gmc->updateGroupModule($groupid, $mid, $values);
	
?>