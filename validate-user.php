<?php
	include_once 'controller/User.Controller.php';
	$uc = new UserController();

	if(isset($_POST['userid'])) {
		$user = $uc->loadUser($_POST['userid']);
		if($user) echo 0;
		else echo 1;
	} else echo 0;
?>