<?php 
	ini_set('display_errors', 1);
	require_once 'session.php';
	include_once 'controller/Language.Controller.php';
	include_once 'controller/User.Controller.php';
	
	$uc = new UserController();
	if(isset($_SESSION['uname'])){
		$user = $uc->loadUser($_SESSION['uname']);
	}
	$teacher_id = $user->getUserid();
	
	$lc = new LanguageController();
	$languages = $lc->getAllLanguages();
	$teacher_languages = $lc->getLanguageByTeacher($teacher_id);
	
	if(isset($_POST['locale']))
	{
		if(isset($_POST['cbx']))
		{
			$lc->deleteTeacherLanguage($teacher_id);
			
			foreach($_POST['cbx'] as $language_id)
			{
				$tl = new TeacherLanguage();
				$tl->setTeacher_id($teacher_id);
				$tl->setLanguage_id($language_id);
				$tl->setIs_default(0);
				$lc->addTeacherLanguage($tl);
			}
		}
		else
		{
			$lc->deleteTeacherLanguage($teacher_id);
		}
		
		$langs = $lc->getLanguage($_POST['locale']);
		$lc->updateDefaultLanguage($teacher_id, $langs->getLanguage_id(), 1);	
		$lang = $langs->getLanguage_code();	
		
		echo "Language settings have been updated. You can now go back to the dashboard";
	} else {
		echo "Please select at least one default language. Thank you.";
	}
	
?>