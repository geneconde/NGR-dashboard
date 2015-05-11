<?php
	require_once 'session.php';
	require_once 'controller/StudentCt.Controller.php';

	$gid = $_GET['gid'];

	$scc = new StudentCtController();
	$result = $scc->checkActiveCTGroup($gid);

	if($result) {
		echo 1;
	} else echo 0;