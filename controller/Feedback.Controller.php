<?php
/**
 * Cumulative Test Controller
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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/Feedback.class.php');


ini_set('track_errors', true);

class FeedbackController {
	public function __construct() {}
	
	public function addFeedback($values) {
		$data = array();
		$data = $this->setFeedback($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("feedback", $data);
		$db->disconnect();
	}

	public function getFeedback($exid, $section, $choice) {
		$where = array();
		$where['exercise_id'] 	= $exid;
		$where['section'] 		= $section;
		$where['choice'] 		= $choice;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("feedback", $where);
		$db->disconnect();		

		$feedback = array();

		foreach($result as $row) {
			$fb = $row['feedback'];
			array_push($feedback, $fb);
		}
		
		return empty($feedback) ? null : $feedback;
	}

	private function setFeedback($values) {
		$data = array();
		$data['exercise_id']		= $values['exercise_id'];
		$data['choice'] 			= $values['choice'];		
		$data['feedback'] 			= $values['feedback'];
		return $data;
	}
}
?>