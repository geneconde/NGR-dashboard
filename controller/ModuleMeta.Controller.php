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
 
class ModuleMetaController {
	public function __construct() {}
	
	public function getModuleProblem($modid) {
		$where = array();
		$where['module_ID'] = $modid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("module_meta", $where);
		$db->disconnect();	
		return $result[0];
	}
}
?>