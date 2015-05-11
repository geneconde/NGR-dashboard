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

ini_set('track_errors', true);
 
class StudentAnswerController {
	public function __construct() {}
	
	public function getStudentAnswer($smid, $qid) {
		$where = array();
		$where['student_module_ID'] = $smid;
		$where['question_ID'] = $qid;
		
		$db = new DB();
		$db->connect();
		$answer = $db->select("student_answers",$where,'answer');
		$db->disconnect();
		
		if (isset($answer[0])) return $answer[0]['answer'];
		else return 0;
	}
	
	public function addStudentAnswer($student_module_id, $question_id, $student_answer) {
		$data = array();
		$data['student_module_ID'] = $student_module_id;
		$data['question_ID'] = $question_id;
		$data['answer'] = $student_answer;
		//$data = $this->setStudentAnswerData($student_answer)		
		
		// $where = array();
		// $where['student_module_ID'] = $student_module_id;
		// $where['question_ID'] = $question_id;
		$db = new DB();
		$db->connect();
		
		//check if student answer already exists
		// $result = $db->select("student_answers",$where);
		// $found = false;
		// foreach ($result as $row) { $found = true; }
		
		$db->insert("student_answers", $data);
			
		$db->disconnect();
	}
	
	public function getQuestionAnswers($qid) {
		$where = array();
		$where['question_ID'] = $qid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_answers", $where);
		$db->disconnect();		
		return $result;	
	}
	
	public function getQuestionAnswersByStudent($qid, $smid) {
		$where = array();
		$where['question_ID'] = $qid;
		$where['student_module_ID'] = $smid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_answers", $where);
		$db->disconnect();		
		return $result;	
	}
	
	private function setStudentAnswerData($student_answer) {
		$data = array();
		$data['student_module_ID']	= $student_answer->getStudentModule_id();
		$data['question_ID']		= $student_answer->getQuestion_id();
		$data['answer'] 			= $student_answer->getStudentAnswer();
		return $data;
	}
	
	private function setStudentAnswer($row) {
		$student_answer = new Module();
		$student_answer->setStudentModule_id($row['student_module_ID']);
		$student_answer->setQuestion_id($row['question_ID']);
		$student_answer->setStudentAnswer($row['answer']);
		return $student_answer;
	}
}
?>