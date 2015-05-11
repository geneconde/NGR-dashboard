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
 
class QuestionController {
	public function __construct() {}
	
	public function loadQuestions($exid) {
		$where = array();
		$where['exercise_ID'] = $exid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("questions", $where, "*", "question_ID ASC");
		$db->disconnect();		
		return $result;	
	}

	public function getExerciseSections($exid) {
		$where = array();
		$where['exercise_ID'] = $exid;
		
		$db = new DB();
		$db->connect();
		$result = $db->selectDistinct("questions", $where, 'section', 'section ASC');
		$db->disconnect();

		$sections = array();

		foreach($result as $row) {
			$section = $row['section'];
			array_push($sections, $section);
		}
		
		return empty($sections) ? null : $sections;
	}

	private function setQuestionData($question) {
		$data = array();
		$data['question_ID']	= $question->getQid();
		$data['exercise_ID']	= $question->getQexid();
		$data['correct_answer']	= $question->getQanswer();
		$data['title'] 			= $question->getQtitle();
		return $question;
	}

	private function setQuestion($row) {
		$question = new Question();
		$question->setQid($row['question_ID']);
		$question->setQexid($row['exercise_ID']);
		$question->setQanswer($row['correct_answer']);
		$question->setQtitle($row['title']);
		return $question;
	}
}
?>