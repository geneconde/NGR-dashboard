<?php
/**
 * UserFactory class
 * Created by: Raina Gamboa
*/

if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/demo/model/Error.class.php');
}

if(!class_exists('Utils')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/demo/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/demo/model/db.inc.php');
}

ini_set('track_errors', true);
 
class SecurityController {
	public function __construct() {}
	
	public function getAllQuestions() {
		$db = new DB();
		$db->connect();
		$result = $db->select("security_questions");
		$db->disconnect();	
		return $result;
	}

	public  function setSecurityQuestion($squestion, $sanswer, $userid) {
		$data = array();
		$data['question_id'] = $squestion;
		$data['answer'] 	= $sanswer;
		$data['user_id'] 	= $userid;

		$db = new DB();
		$db->connect();
		$db->insert("security", $data);

		// $lastid = $db->dblastinsertid();
		// $db->disconnect();
		// return $lastid;
	}

	public function updateSecurityQuestion($squestion, $sanswer, $userid) {
		$where = array();
		$where['user_id'] = $userid;
		
		$data = array();
		$data['question_id'] = $squestion;
		$data['answer'] 	= $sanswer;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("security", $where, $data);
		$db->disconnect();
	}

	public function getSecurityRecord($userID) {
		$where = array();
		$where['user_id'] = $userID;
		$users = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("security", $where);
		$db->disconnect();
		return ($result);
	}

}
?>