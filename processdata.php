<?php
	require_once 'session.php';
	$userid = $user->getUserid();
	
    $data = $_POST['input'];
	$page = $_POST['page'];
	$name = $_POST['tname'];

	$_SESSION['ct'.$userid.$page] = $data;
	$_SESSION['tname']	= $name;
?>