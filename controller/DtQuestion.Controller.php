<?php
/**
 * UserFactory class
 * Created by: Raina Gamboa
*/

if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/model/Error.class.php');
}

if(!class_exists('Utils')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/model/db.inc.php');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/DtQuestion.class.php');

ini_set('track_errors', true);
 
class DtQuestionController {
	public function __construct() {}
	
	public function setDTQuestion($module) {
		$data = array();
		$data['qid']			= $module->getQid();
		$data['module_id']		= $module->getModuleid();
		$data['question']		= $module->getQuestion();
		$data['choices'] 		= $module->getChoices();
		$data['answer'] 		= $module->getAnswer();
		$data['answer_order'] 	= $module->getAnswerOrder();
		return $data;
	}
	
	public function getAllQuestions() {
		$db = new DB();
		$db->connect();
		$result = $db->select("dt_pool");
		$db->disconnect();		
		return $result;
	}

	public function getDTPool($mid) {
		$where = array();
		$where['module_id'] = $mid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("dt_pool", $where);
		$db->disconnect();		
		return $result;
	}
	
	public function getTargetQuestion($qid) {
		$where = array();
		$where['qid'] = $qid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("dt_pool", $where);
		$db->disconnect();		
		return $result;
	}
	
	public function getQuestionChoices($qid) {
		$where = array();
		$where['qid'] = $qid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("dt_choices", $where);
		$db->disconnect();		
		return $result;
	}
	
	public function addQuestion($question) {
		$data = array();
		$data = $this->setQuestionValues($question);
				
		$db = new DB();
		$db->connect();
		$db->insert("dt_pool", $data);
		$db->disconnect();
	}
	
	private function setQuestionValues($values) {
		$data = array();
		$data['module_id']		= $values['module_id'];
		$data['type']			= $values['type'];
		$data['question']		= $values['question'];
		$data['answer'] 		= $values['answer'];
		$data['image'] 			= $values['image'];
		$data['from_review'] 	= $values['from_review'];
		return $data;
	}
}
?>