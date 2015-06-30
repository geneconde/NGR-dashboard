<?php
/**
 * UserFactory class
 * Created by: Raina Gamboa
*/

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
 
class MetaAnswerController {
	public function __construct() {}
	
	public function getProblemAnswer($smid, $metaid) {
		$where = array();
		$where['student_module_ID'] = $smid;
		$where['meta_ID'] = $metaid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("meta_answers", $where, 'answer');

		if (empty($result)){
			$data = array();
			$data['answer'] = 'No Answer.';
			$data['student_module_ID'] = $smid;
			$data['meta_ID'] = $metaid;
			$result = $db->insert("meta_answers", $data);
			return $data['answer'];
		}
		$db->disconnect();	
		return $result[0]['answer'];
		
	}
	
	public function getProblemAnswer2($smid, $metaid) {
		$where = array();
		$where['student_module_ID'] = $smid;
		$where['meta_ID'] = $metaid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("meta_answers", $where, 'answer');
		$db->disconnect();	
		return $result;
	}
	
	public function addMetaAnswer($smid,$metaid,$answer) {
		$data = array();
		$data['answer'] = $answer;
		$data['student_module_ID'] = $smid;
		$data['meta_ID'] = $metaid;
		
		$db = new DB();
		$db->connect();
		$result = $db->insert("meta_answers", $data);
		$db->disconnect();			
	}
}
?>