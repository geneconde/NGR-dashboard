<?php
	require_once 'session.php';
	include_once 'controller/CumulativeTest.Controller.php';

	$userid 	= $user->getUserid();
	$ctid = $_GET['ctid'];
	$timelimit	= $_POST['hours'] . ":" . $_POST['minutes'] . ":" . "00";
	$active = (isset($_POST['active']) ? 1 : 0);

	$values	= array(
			'test_name' 	=> $_POST['test-name'],
			'timelimit'		=> $timelimit,
			'isactive'		=> $active,
			'date_modified'	=> date('Y-m-d G:i:s')
		);

	$ctc 	= new CumulativeTestController();

	if($active):
		$ct_set = $ctc->getCumulativeTests($userid);
		foreach($ct_set as $ct):
			$ctc->deactivateCT($ct['ct_id']);
		endforeach;
	endif;

	$ctc->updateCumulativeTest($ctid, $values);

	header("Location: ct-test.php");