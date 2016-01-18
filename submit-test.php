<?php
require_once 'session.php';	
include 'controller/SubmittedTest.Controller.php';

$userid = $user->getUserid();
$name = $_POST['tname'];
$qids = $_POST['qids'];

$stc = new SubmittedTestController();
$tests 	= $stc->getAllTestOfUser($userid);

$same = 0;
foreach($tests as $test):
	if($test['name'] == $name) $same = 1;
endforeach;

if($same == 0):
	$values = array(
		"user_id" => $userid,
		"name" => $name,
		"list" => $qids
	);
	$stc->addTest($values);
	echo 1;
else: 
	echo 0;
endif;
?>