<?php
/**
 * UserFactory class
 * Created by: Raina Gamboa
*/

if(!class_exists('Error')) {
	//require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/model/Error.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Error.class.php');
}

if(!class_exists('Utils')) {
	//require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/model/Utils.class.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Utils.class.php');
}

if(!class_exists('DB')) {
	//require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/model/db.inc.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.inc.php');
}

//require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/TeacherModule.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/TeacherModule.class.php');

ini_set('track_errors', true);
 
class TeacherModuleController {
	
	public function __construct() {}
	
	public function addTeacherModule($userid, $mid) {
		$data = array();
		$data['user_id'] = $userid;
		$data['module_id'] = $mid;
				
		$db = new DB();
		$db->connect();
		$db->insert("teacher_module", $data);
		$db->disconnect();
	}

	public function getTeacherModule($userid) {
		$where = array();
		$where['user_id'] = $userid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_module", $where);
		$db->disconnect();		
		return $result;
	}
	
	public function getTargetModule($userid, $mid) {
		$where = array();
		$where['user_id'] = $userid;
		$where['module_id'] = $mid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_module", $where);
		$db->disconnect();		
		
		return $result[0]['isactive'];
	}
}