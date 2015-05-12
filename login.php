<?php
	session_start();

	ini_set('display_errors', '1');

	include_once 'controller/User.Controller.php'; 
	include_once 'controller/Subscriber.Controller.php';
	include_once 'controller/Language.Controller.php';

	$lc = new LanguageController();
	$uc = new UserController();
	$sc = new SubscriberController();

	if (isset($_POST['username'])) {
		// $password = $_POST['password'];
		// $salt = sha1(md5($password));
		// $password = md5($password.$salt);
		$password = $_POST['password'];
		$retObj = $uc->loginUser($_POST['username'],$password);
		if ((is_object($retObj)) && ($retObj instanceof User)) {
			$subid = $retObj->getSubscriber();

			$subscriber = $sc->loadSubscriber($subid);

			if($subscriber->getActive() == 1) {
				if($retObj->getType() == '0') {
					$_SESSION['uname'] = $_POST['username'];
					
					//added for language
					$teacher = $uc->loadUser($_SESSION['uname']);
					
					$gdl = $lc->getDefaultLanguage($teacher->getUserid(), 1);
					if($gdl != null)
					{
						$default_lang = $lc->getLanguage($gdl->getLanguage_id());
						$lang = $default_lang->getLanguage_code();
					} else {
						$lang = 'en_US';
					}
					
					header("Location: teacher.php?lang=$lang"); exit;	
					
				} elseif($retObj->getType() == '1'){
					$_SESSION['uname'] = $_POST['username'];	  
					header("Location:parent/parent.php");exit;
				} elseif($retObj->getType() == '3'){
					$_SESSION['uname'] = $_POST['username'];

					$subscriber = $uc->loadUser($_SESSION['uname']);

					$gdl = $lc->getDefaultLanguage($subscriber->getUserid(), 1);
					if($gdl != null)
					{
						$default_lang = $lc->getLanguage($gdl->getLanguage_id());
						$lang = $default_lang->getLanguage_code();
					} else {
						$lang = 'en_US';
					}

					header("Location: subscriber/index.php?lang=$lang");
				} elseif($retObj->getType() == '4'){
					$_SESSION['uname'] = $_POST['username'];

					$subscriber = $uc->loadUser($_SESSION['uname']);

					$gdl = $lc->getDefaultLanguage($subscriber->getUserid(), 1);
					if($gdl != null)
					{
						$default_lang = $lc->getLanguage($gdl->getLanguage_id());
						$lang = $default_lang->getLanguage_code();
					} else {
						$lang = 'en_US';
					}

					header("Location: phpgrid/manage-subhead.php?lang=$lang");
				} else {
					$_SESSION['uname'] = $_POST['username'];	  
					
					//added for language
					$student = $uc->loadUser($_SESSION['uname']);
								
					$gdl = $lc->getDefaultLanguage($student->getTeacher(), 1);
					if($gdl != null)
					{
						$default_lang = $lc->getLanguage($gdl->getLanguage_id());
						$lang = $default_lang->getLanguage_code();
					} else {
						$lang = 'en_US';
					}
					
					header("Location:student.php?lang=$lang");exit;
				}
			} else {
				header("Location: index.php?deac=1");exit;
			}
		}
		else{
			header("Location: index.php?err=$retObj");exit;
		}
	}
?>