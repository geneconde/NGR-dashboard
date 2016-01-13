<?php
if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Error.class.php');
}

if(!class_exists('Utils')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.inc.php');
}

ini_set('track_errors', true);

class SubmittedTestController {
	public function __construct() {}
	
	public function addTest($values) {
		$db = new DB();
		$db->connect();
		$db->insert("submitted_test", $values);
		$db->disconnect();
	}

	public function getTest($userid, $name) {
		$where = array();
		$where['user_id'] = $userid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("submitted_test", $where);
		$db->disconnect();
		return $result;
	}

	public function getAllTest($userid) {
		$db = new DB();
		$db->connect();
		$result = $db->select("submitted_test");
		$db->disconnect();
		return $result;
	}
}
?>