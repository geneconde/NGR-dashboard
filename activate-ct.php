<?php
	require_once 'session.php';
	require_once 'controller/StudentCt.Controller.php';
	require_once 'controller/CumulativeTest.Controller.php';
	require_once 'controller/Events.Controller.php';

	$ev = new EventsController();
	$ctid = $_GET['ctid'];
	$userid = $user->getUserid();
	$username = $user->getUsername();
	
	$scc = new StudentCtController();
	$ctc = new CumulativeTestController();
	$ct = $ctc->getCTName($ctid);

	$scc->deactivateGroupCT($ctid);
	
	$one = 0;
	foreach($_POST['groups'] as $gid => $val) {
		$scc->activateGroupCT($ctid, $gid);
		if($one==0) $ev->activate_cumulative($userid, $username, $ct[0]);
		$one++;
	}

	header("Location: activate-group-ct.php?m=1&ctid=" . $ctid);