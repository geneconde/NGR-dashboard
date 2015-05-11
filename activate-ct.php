<?php
	require_once 'session.php';
	require_once 'controller/StudentCt.Controller.php';
	
	$ctid = $_GET['ctid'];
	
	$scc = new StudentCtController();
	$scc->deactivateGroupCT($ctid);
	
	foreach($_POST['groups'] as $gid => $val) {
		$scc->activateGroupCT($ctid, $gid);
	}

	header("Location: activate-group-ct.php?m=1&ctid=" . $ctid);