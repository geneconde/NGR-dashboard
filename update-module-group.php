<?php
	include('model/db.inc.php');
	include('controller/GroupModule.Controller.php');
	
	$mid 		= $_GET['module_id'];
	$groupid	= $_GET['group_id'];
	
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
	
	$gmc = new GroupModuleController();
	$gmc->updateGroupModule($groupid, $mid, $values);
	
?>