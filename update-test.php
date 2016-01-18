<?php
	require_once 'session.php';	
	require_once 'controller/DiagnosticTest.Controller.php';
	require_once 'controller/Events.Controller.php';
	
	$ev = new EventsController();
	$userid 	= $user->getUserid();
	$mid 		= $_POST['mid'];
	$mode		= $_POST['mode'];
	$qid 		= $_POST['qid'];
	$action		= $_POST['act'];
	$name		= $_POST['tname'];
	$dtid		= $_POST['dtid'];
	
	$dtc 	= new DiagnosticTestController();
	$tests 	= $dtc->getAllModuleTestsByTeacher($mid, $userid);
	
	$same = 0;
	
	foreach($tests as $test):
		if($test['dt_id'] != $dtid): 
			if($test['test_name'] == $name) $same = 1;
		endif;
	endforeach;
	
	$qs = explode(',',$qid);
	shuffle($qs);

	$finalqs = implode(',', $qs);
	
	if($same == 0):
		if($action == "new"):
			$values = array(
				"test_name"	=> $name,
				"module_id" => $mid,
				"user_id"	=> $userid,
				"qid"		=> $finalqs,
				"mode"		=> $mode,
			);
			$userid = $user->getUserid();
			$username = $user->getUsername();
			if($mode==1){ $ev->create_pre_test($userid, $username, $name); }
			elseif($mode==2){ $ev->create_post_test($userid, $username, $name); }
			$dtc->addDiagnosticTest($values);
		else:
			$dtc->updateDiagnosticTest($dtid, $name, $qid);
		endif;
		echo 1;
	else: 
		echo 0;
	endif;
?>