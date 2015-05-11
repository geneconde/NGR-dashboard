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

require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/Exercise.class.php');

ini_set('track_errors', true);
 
class ExerciseController {
	public function __construct() {}
	
	public function loadExercises($modid) {
		$where = array();
		$where['module_ID'] = $modid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("exercise", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$exercise = $this->setExercise($row);
			return $exercise;
		}
	}
	
	public function loadExercisesByType($modid, $type) {
		$where = array();
		$where['module_ID'] = $modid;
		$where['type'] = $type;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("exercise", $where,'*','exercise_ID ASC');
		$db->disconnect();		
		return $result;	
	}
	
	public function deleteExercise($exid) {
		$where = array();
		$where['exid'] = $exid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("exercise", $where);
		$db->disconnect();
	}
	
	public function addExercise($exercise) {
		$data = array();
		$data = $this->setExerciseData($exercise);
		
		$data['moduleid'] = $_POST['moduleid'];
				
		$db = new DB();
		$db->connect();
		$db->insert("exercise", $data);
		$db->disconnect();
	}
	
	public function getExercise($e) {
		$where = array();
		$where['exercise_ID'] = $e;		
		$db = new DB();
		$db->connect();
		$result = $db->select("exercise", $where,'*');
		$db->disconnect();		
		return $result[0];	
	}
	
	private function setExerciseData($exercise) {
		$data = array();
		$data['exercise_ID']	= $exercise->getExid();
		$data['module_ID']		= $exercise->getModuleid();
		$data['title']			= $exercise->getTitle();
		$data['type'] 			= $exercise->getExtype();
		$data['shortcode']		= $exercise->getShortcode();
		$data['screenshot'] 	= $exercise->getScreenshot();
		return $data;
	}
	
	private function setExercise($row) {
		$exercise = new Exercise();
		$exercise->setExid($row['exercise_ID']);
		$exercise->setModuleid($row['module_ID']);
		$exercise->setTitle($row['title']);
		$exercise->setExtype($row['type']);
		$exercise->setShortcode($row['shortcode']);
		$exercise->setScreenshot($row['screenshot']);
		return $exercise;
	}
}
?>