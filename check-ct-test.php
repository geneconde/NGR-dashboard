<?php
	include_once 'controller/StudentCt.Controller.php';
	
	$ctid 		= $_POST['ctid'];
	
	$scc		= new StudentCtController();
	$test_set	= $scc->getStudentCtByTest($ctid);
	
	echo $test	= ($test_set ? 1 : 0);
?>