<?php
	require_once 'session.php';
	include_once 'controller/CumulativeTest.Controller.php';
	include_once 'controller/TeacherModule.Controller.php';

	$userid = $user->getUserid();

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
			'date_created'	=> date('Y-m-d'),
			'date_modified'	=> date('Y-m-d'),
			'timelimit'		=> $timelimit,
			'isactive'		=> $active
		);

	$ctc->addCumulativeTest($values);

	$tmc		= new TeacherModuleController();
	$tm  		= $tmc->getTeacherModule($userid);

	foreach($tm as $md):
		unset($_SESSION['ct'.$userid.$md['module_id']]);
	endforeach;

	header("Location: ct-settings.php");