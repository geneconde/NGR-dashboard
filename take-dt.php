<?php 
	require_once 'session.php';	
	require_once 'locale.php';	
	include_once 'header.php';
	include_once 'controller/User.Controller.php';
	include_once 'controller/DiagnosticTest.Controller.php';
	include_once 'controller/Module.Controller.php';
	include_once 'controller/GroupModule.Controller.php';
	include_once 'controller/StudentDt.Controller.php';
	
	$userid		= $user->getUserid();
	$groupid	= $_GET['gid'];
	$mid		= $_GET['mid'];
	$dtid		= $_GET['dtid'];
	$mode 		= ($_GET['mode'] == 'pre' ? 1 : 2 );
	
	$gmc		= new GroupModuleController();
	$gm			= $gmc->getModuleGroupByID($groupid, $mid);
	
	if($mode == 1) $tlimit = $gm[0]['timelimit_pre'];
	else if($mode == 2) $tlimit = $gm[0]['timelimit_post'];
	
	$mc			= new ModuleController();
	$module_set	= $mc->loadModule($mid);
	$module_name = $module_set->getModule_name();
	
	$dtc		= new DiagnosticTestController();
	$test		= $dtc->getDiagnosticTestByID($dtid);

	$qid 		= explode(',', $test->getQid());
	$count 		= count($qid);
	$tl			= explode(':', $tlimit);
	$hour		= ltrim($tl[0], '0');
	$min		= ltrim($tl[1], '0');
	$timelimit 	= $hour * 60 + $min;
	
	$sdt 			= new StudentDtController();
	$sdt_set		= $sdt->getSDTbyStudent($userid, $dtid);
	
	if($sdt_set):
		$sdtid 		= $sdt_set->getStudentDtID();		
		$sa_set		= $sdt->getAnsweredQuestions($sdtid);

		$sanswers		= array();
		
		foreach($sa_set as $sa)
			array_push($sanswers, $sa['qid']);
			
		foreach($qid as $row):
			if(!in_array($row, $sanswers)):
				$index = array_search($row, $qid);
				break;
			endif;
		endforeach;
	endif;

?>
<div id="container">
<a class="link" href="student.php">&laquo <?php echo _('Go Back');?></a>
<?php if ($_GET['mode'] == 'pre') { ?>
<h1><?php /*echo $module_set->getModule_name(); */ echo _($module_name);?> - <?php echo _("Pre-Diagnostic Test"); ?></h1>
<?php echo _("This pre-diagnostic test consists of"); ?> <strong><?php echo $count; ?> <?php echo _("questions"); ?></strong> <?php echo _("from the"); ?> <strong><?php /*echo $module_set->getModule_name();*/  echo _($module_name);?></strong> <?php echo _("module. You have"); ?> <strong> <?php echo $timelimit; ?> <?php echo _("minutes"); ?></strong> <?php echo _(" to answer all these questions. Only the answers that are completed within the time limit will be recorded. Click the button below to start the test."); ?>
<?php } else { ?>
<h1><?php /*echo $module_set->getModule_name();*/  echo _($module_name);?> - <?php echo _("Post-Diagnostic Test"); ?></h1>
<?php echo _("This post diagnostic test consists of"); ?> <strong><?php echo $count; ?> <?php echo _("questions"); ?></strong> <?php echo _("from the"); ?> <strong><?php /*echo $module_set->getModule_name();*/  echo _($module_name);?></strong> <?php echo _("module. You have"); ?> <strong> <?php echo $timelimit; ?> <?php echo _("minutes"); ?></strong> <?php echo _(" to answer all these questions. Only the answers that are completed within the time limit will be recorded. Click the button below to start the test."); ?>
<?php } ?>
<br/><br/><br/><br/>
<div class="center">
	<a class="take-box" href="dt.php?dtid=<?php echo $dtid; if(isset($index)) { ?>&i=<?php echo $index; } ?>"><?php echo _("START TEST"); ?></a>
</div>
</div>
<?php require_once "footer.php"; ?>