<?php
	session_start();
	$_SESSION['uname'] = 'raina';
	if(!((isset($_SESSION['uname'])) || (isset($_SESSION['admin'])))){
		header("Location: index.php");
	}
	
	include_once('controller/User.Controller.php');
	include_once('controller/StudentModule.Controller.php');
	include_once('controller/StudentAnswer.Controller.php');	
	include_once('controller/ModuleMeta.Controller.php'); 
	include_once('controller/MetaAnswer.Controller.php');
	include_once('controller/Subscriber.Controller.php');
	include_once('controller/Module.Controller.php');
	
	$sc = new SubscriberController();

	$user = null;
	
	$uc = new UserController();
	if(isset($_SESSION['uname'])){
		$user = $uc->loadUser($_SESSION['uname']);
		$sub = $sc->loadSubscriber($user->getSubscriber());
	}

	
	$name = $user->getFirstname();
	
	$smc = new StudentModuleController();
	$sac = new StudentAnswerController();
	$mmc = new ModuleMetaController();
	$mac = new MetaAnswerController();
	$mc = new ModuleController();
	
?>