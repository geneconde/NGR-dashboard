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

require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/StudentGroup.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/StudentUserGroup.class.php');

ini_set('track_errors', true);

class StudentGroupController {
	public function __construct() {}
	
	public function addGroup($group_name, $teacher_id) {
		$data = array();
		$data['group_name'] = $group_name;
		$data['teacher_id'] = $teacher_id;
				
		$db = new DB();
		$db->connect();
		$db->insert("student_group", $data);
		$db->disconnect();
	}
	
	public function getActiveGroups($teacherid) {
		$where = array();
		$where['teacher_id'] 	= $teacherid;
		$where['isactive'] 		= 1;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("student_group", $where);
		$db->disconnect();
		return $result;
	}

	public function getGroupName($group_id) {
		$where = array();
		$where['group_id'] 	= $group_id;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("student_group", $where);
		$db->disconnect();
		return $result;
	}

	public function updateGroupName($groupid, $group_name) {	
		$where = array();
		$where['group_id'] 		= $groupid;
	
		$data					= array();
		$data['group_name'] 	= $group_name;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("student_group", $where, $data);
		$db->disconnect();
	}
	
	public function getGroups($teacherid) {
		$where = array();
		$where['teacher_id'] 	= $teacherid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("student_group", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getTargetGroup($groupid) {
		$where = array();
		$where['group_id'] = $groupid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("student_group", $where);
		$db->disconnect();
		return $result;
	}

	public function getGroupOfUser($userid) {
		$where = array();
		$where['user_id'] = $userid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("student_user_group", $where);
		$db->disconnect();
		return $result[0]['group_id'];
	}
	
	public function getUsersInGroup($groupid) {
		$where = array();
		$where['group_id'] = $groupid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("student_user_group", $where);
		$db->disconnect();
		
		$users = array();
		
		foreach($result as $row) {
			array_push($users, $row['user_id']);
		}
		
		return $users;
	}
	
	public function addUserInGroup($groupid, $userid) {
		$data = array();
		$data['group_id'] 	= $groupid;
		$data['user_id'] 	= $userid;
				
		$db = new DB();
		$db->connect();
		$db->insert("student_user_group", $data);
		$db->disconnect();
	}
	
	public function updateUserInGroup($groupid, $userid) {	
		$where = array();
		$where['user_id'] 		= $userid;
	
		$data					= array();
		$data['group_id'] 		= $groupid;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("student_user_group", $where, $data);
		$db->disconnect();
	}

	public function deleteUserInGroup($userid) {
		$where = array();
		$where['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->delete("student_user_group", $where);
		$db->disconnect();
	}

	public function deleteGroup($groupid) {
		$where = array();
		$where['group_id'] = $groupid;

		$db = new DB();
		$db->connect();
		$result = $db->delete("student_group", $where);
		$db->disconnect();
	}

	public function deleteAllGroup($groupid) {
		$where = array();
		$where['group_id'] = $groupid;

		$db = new DB();
		$db->connect();
		$result = $db->delete("student_user_group", $where);
		$db->disconnect();
	}
}
?>