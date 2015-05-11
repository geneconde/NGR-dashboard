<?php
	include_once 'controller/StudentDt.Controller.php';
	
	$dtid 		= $_POST['dtid'];
	
	$sdc		= new StudentDtController();
	$test_set	= $sdc->getTestByDTID($dtid);
	
	echo $test	= ($test_set ? 1 : 0);
?>