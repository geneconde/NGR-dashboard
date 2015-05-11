<?php
	include 'model/db.inc.php';
	include 'controller/StudentGroup.Controller.php';
	
	$users 	= $_POST['ur'];
	$new	= $_POST['ct'];
	$group	= $_POST['tf'];
	
	$sgc 	= new StudentGroupController();
	
	echo $group;

	foreach($users as $user) {
		if($new) $sgc->addUserInGroup($group, $user);
		else if($group == 'nogroup') $sgc->deleteUserInGroup($user);
		else $sgc->updateUserInGroup($group, $user);
	}
?>