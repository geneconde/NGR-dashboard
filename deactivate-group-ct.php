<?php
	require_once 'session.php';
	require_once 'controller/StudentCt.Controller.php';

	$gid = $_POST['gid'];

	$scc = new StudentCtController();
	$scc->deactivateTargetGroupCT($gid);
