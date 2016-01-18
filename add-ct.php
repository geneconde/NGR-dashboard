<?php
	require_once 'session.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';
	require_once 'controller/Events.Controller.php';
	
	$ev = new EventsController();
	$userid = $user->getUserid();
	$username = $user->getUsername();

	$ctc 	= new CumulativeTestController();

	$active = (isset($_POST['active']) ? 1 : 0);
	$timelimit	= $_POST['hours'] . ":" . $_POST['minutes'] . ":" . "00";

	if($active):
		$ct_set = $ctc->getCumulativeTests($userid);
		foreach($ct_set as $ct):
			$ctc->deactivateCT($ct['ct_id']);
		endforeach;
	endif;
	
	$qs = explode(',',$_POST['questions']);
	shuffle($qs);

	$finalqs = implode(',', $qs);
	
	$values	= array(
			'test_name' 	=> $_POST['test-name'],
			'user_id'		=> $userid,
			'qid'			=> $finalqs,
			'date_created'	=> date('Y-m-d G:i:s'),
			'date_modified'	=> date('Y-m-d G:i:s'),
			'timelimit'		=> $timelimit,
			'isactive'		=> $active
		);

	$ev->create_cumulative_test($userid, $username, $_POST['test-name']);
	$ctc->addCumulativeTest($values);

	$tmc		= new TeacherModuleController();
	$tm  		= $tmc->getTeacherModule($userid);

	foreach($tm as $md):
		unset($_SESSION['ct'.$userid.$md['module_id']]);
	endforeach;

	header("Location: ct-test.php");