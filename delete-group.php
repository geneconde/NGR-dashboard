<?php
	include 'model/db.inc.php';
	include 'controller/StudentGroup.Controller.php';

	$groupid = $_POST['groupid'];

	$sgc = new StudentGroupController();

	$users = $sgc->getUsersInGroup($groupid);

	$sgc->deleteGroup($groupid);
	$sgc->deleteAllGroup($groupid);