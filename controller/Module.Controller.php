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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/Module.class.php');

ini_set('track_errors', true);
 
class ModuleController {
	public function __construct() {}
	
	public function getAllModules() {
		$modules = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("module","","*","module_name ASC");
		$db->disconnect();
		return $result;
	}
	
	public function loadModule($mid) {
		$where = array();
		$where['module_ID'] = $mid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("module", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$module = $this->setModule($row);
			return $module;
		}
	}

	public function deleteModule($moduleid) {
		$where = array();
		$where['moduleid'] = $moduleid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("module", $where);
		$db->disconnect();
	}
	
	public function addModule($module) {
		$data = array();
		$data = $this->setModuleData($module);
				
		$db = new DB();
		$db->connect();
		$db->insert("module", $data);
		$db->disconnect();
	}
	
	public function addTestQuestions() {
		$data = array();
		$data = $this->setModuleData($module);
		
		$db = new DB();
		$db->connect();
		$db->insert("module", $data);
		$db->disconnect();
		
	}
	
	public function getModule($moduleid) {
		$where = array();
		$where['module_ID'] = $moduleid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("module", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$module = $this->setModule($row);
			return $module;
		}	
	}
	
	private function setModuleData($module) {
		$data = array();
		$data['module_ID']			= $module->getModuleid();
		$data['module_name']		= $module->getModule_name();
		$data['module_desc'] 		= $module->getModule_desc();
		$data['category'] 			= $module->getModule_cat();
		return $data;
	}
	
	private function setModule($row) {
		$module = new Module();
		$module->setModuleid($row['module_ID']);
		$module->setModule_name($row['module_name']);
		$module->setModule_desc($row['module_desc']);
		$module->setModule_cat($row['category']);
		return $module;
	}
}
?>