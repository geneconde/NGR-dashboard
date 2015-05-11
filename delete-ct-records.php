<?php
	include_once 'controller/StudentCt.Controller.php';
	
	$ctid		= $_POST['ctid'];
	
	$scc		= new StudentCtController();
	$test_set	= $scc->getStudentCtByTest($ctid);
	
	echo "<pre>";
	print_r($test_set);
	echo "</pre>";
	
	foreach($test_set as $test):
		$sctid 	= $test['student_ct_id'];
		
		$scc->deleteCtTest($sctid);
		$scc->deleteCtAnswers($sctid);
	endforeach;
?>