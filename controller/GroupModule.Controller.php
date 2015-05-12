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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/GroupModule.class.php');

ini_set('track_errors', true);

class GroupModuleController {
	public function __construct() {}
	
	public function getModuleGroupByID($groupid, $moduleid) {
		$where = array();
		$where['group_id'] = $groupid;
		$where['module_id'] = $moduleid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("group_module", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getGroupsByModule($moduleid) {
		$where = array();
		$where['module_id'] = $moduleid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("group_module", $where);
		$db->disconnect();
		return $result;
	}
	
	public function addGroupModule($values) {
		$data = array();
		$data = $this->setGMValues($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("group_module", $data);
		$db->disconnect();
	}
	
	private function setGMValues($values) {
		$data = array();
		$data['group_id']			= $values['group_id'];
		$data['module_id']			= $values['module_id'];
		$data['pretest_id'] 		= $values['pretest_id'];
		$data['posttest_id'] 		= $values['posttest_id'];
		$data['review_active'] 		= $values['review_active'];
		$data['pre_active'] 		= $values['pre_active'];
		$data['post_active'] 		= $values['post_active'];
		$data['timelimit_pre'] 		= $values['timelimit_pre'];
		$data['timelimit_post'] 	= $values['timelimit_post'];
		return $data;
	}
	
	public function updateGroupModule($groupid, $mid, $values) {	
		$where = array();
		$where['group_id'] 	= $groupid;
		$where['module_id'] = $mid;
	
		$data	= array();
		$data 	= $this->setTestValues($values);
					
		$db = new DB();
		$db->connect();
		$result = $db->update("group_module", $where, $data);
		$db->disconnect();
	}
	
	public function updateGroupModuleDT($groupid, $mid, $mode) {
		$where = array();
		$where['group_id'] 	= $groupid;
		$where['module_id'] = $mid;
		
		$data	= array();
		if($mode == 1):
			$data['pretest_id']	= 0;
			$data['pre_active'] = 0;
		else:
			$data['posttest_id'] = 0;
			$data['post_active'] = 0;
		endif;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("group_module", $where, $data);
		$db->disconnect();
	}
	
	private function setTestValues($values) {
		$data = array();
		$data['pretest_id']			= $values['pretest_id'];
		$data['posttest_id']		= $values['posttest_id'];
		$data['review_active'] 		= $values['review_active'];
		$data['pre_active'] 		= $values['pre_active'];
		$data['post_active'] 		= $values['post_active'];
		$data['timelimit_pre'] 		= $values['timelimit_pre'];
		$data['timelimit_post'] 	= $values['timelimit_post'];
		return $data;
	}
}
?>