<?php
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	include_once 'controller/StudentDt.Controller.php';
	
	$dtid 	= $_GET['dtid'];
	$mid	= $_GET['module_id'];
	$mode	= ($_GET['mode'] == 'pre' ? 1 : 2 );
	$attr	= ($mode == 1 ? "pretest_id" : "posttest_id" );
	
	$gmc	= new GroupModuleController();
	$gm_set	= $gmc->getGroupsByModule($mid);
	
	foreach($gm_set as $row):
		if($row[$attr] == $dtid):
			$gmc->updateGroupModuleDT($row['group_id'], $mid, $mode);
		endif;
	endforeach;
	
	$sdc		= new StudentDtController();
	$test_set	= $sdc->getTestByDTID($dtid);
	
	foreach($test_set as $test):
		$sdtid 	= $test['student_dt_id'];
		$sdc->deleteTest($sdtid);
		$sdc->deleteDtAnswers($sdtid);
	endforeach;
	
	$dtc 	= new DiagnosticTestController();
	$dtc->deleteDT($dtid);

	header("Location: settings.php?mid=".$mid);
?>