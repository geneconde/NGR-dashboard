<?php
	require_once 'session.php';
	require_once 'controller/ModuleMeta.Controller.php';
	require_once 'controller/MetaAnswer.Controller.php';

	$smid = $_SESSION['smid'];
	$moduleid = $_POST['moduleid'];
	$answer = $_POST['answer'];
	
	$mmc = new ModuleMetaController();
	$mac = new MetaAnswerController();

	$problem = $mmc->getModuleProblem($moduleid);
	$mac->addMetaAnswer($smid,$problem['meta_ID'],$answer);
?>