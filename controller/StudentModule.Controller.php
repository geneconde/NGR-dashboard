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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/StudentModule.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/controller/Events.Controller.php');

ini_set('track_errors', true);
 
class StudentModuleController {
	public function __construct() {}
	
	public function loadStudentModule($smid) {
		$where = array();
		$where['student_module_ID'] = $smid;		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_module", $where,'*');
		$db->disconnect();		
		return $result[0];	
	}
	
	public function loadAllStudentModule($userid) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_module", $where,'*','student_module_ID ASC');
		$db->disconnect();		
		return $result;	
	}
	
	public function loadStudentModuleByUser($userid, $mid) {
		$where = array();
		$where['user_ID'] = $userid;
		$where['module_ID'] = $mid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_module", $where,'*','student_module_ID ASC');
		$db->disconnect();		
		return $result;	
	}

	public function loadSMbyUserID($userid, $mid) {
		$where = array();
		$where['user_ID'] = $userid;
		$where['module_ID'] = $mid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_module", $where,'*','student_module_ID ASC');
		$db->disconnect();		
		return $result[0];	
	}
	
	public function finishModule($smid) {
		$where = array();
		$where['student_module_ID'] = $smid;

		finish_module($smid);
		
		$data = array();
		$data['date_finished'] = date("Y-m-d H:i:s");
		
		$db = new DB();
		$db->connect();
		$result = $db->update("student_module", $where, $data);
		
		$db->disconnect();
	}
	
	public function countModules($userid, $modid) {
		$where = array();
		$where['user_ID'] = $userid;
		$where['module_ID'] = $modid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_module", $where,'*','student_module_ID ASC');
		$count = $db->dbgetrowcount();
		$db->disconnect();		
		return $count;
	}
	
	public function updateStudentLastscreen($page, $stud_mod_id) {
		$where = array();
		$where['student_module_ID'] = $stud_mod_id;
		
		$data = array();
		$data['last_screen'] = $page;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("student_module", $where, $data);
		$db->disconnect();
	}
	
	public function addStudentModule($userid, $modid) {
		$data = array();
		$data['user_ID'] = $userid;
		$data['module_ID'] = $modid;
		$data['date_started'] = date('Y-m-d H:i:s');
		$data['last_screen'] = '1';
				
		$db = new DB();
		$db->connect();
		$db->insert("student_module", $data);
		
		$id = $db->dblastinsertid();
		
		$db->disconnect();
		return $id;
	}

	public function checkStudentModuleExists($userid, $mid) {
		$where = array();
		$where['user_ID'] = $userid;
		$where['module_ID'] = $mid;
		$db = new DB();
		$db->connect();
		$result = $db->select("student_module", $where);

		if ($db->dbgetrowcount() > 0)
			return $db->dbgetrowcount();		
		$db->disconnect();		
		return false;
	}
}
?>