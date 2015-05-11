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

require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/DiagnosticTest.class.php');

ini_set('track_errors', true);

class DiagnosticTestController {
	public function __construct() {}
	
	public function addDiagnosticTest($values) {
		$data = array();
		$data = $this->setDtTest($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("dt", $data);
		$db->disconnect();
	}
	
	public function addCumulativeTest($values) {
		$data = array();
		$data = $this->setCtTest($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("dt", $data);
		$db->disconnect();
	}
	
	public function getCumulativeTest($userid) {
		$where = array();
		$where['user_id'] = $userid;
		$where['mode']	  = 3;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("dt", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getAllTeacherTests($teacherid) {
		$where = array();
		$where['user_id'] = $teacherid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("dt", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getAllModuleTests($moduleid) {
		$where = array();
		$where['module_id'] = $moduleid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("dt",$where);
		$db->disconnect();
		return $result;
	}
	
	public function getAllModuleTestsByTeacher($moduleid, $userid) {
		$where = array();
		$where['module_id'] = $moduleid;
		$where['user_id']	= $userid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("dt",$where);
		$db->disconnect();
		return $result;
	}
	
	public function getDiagnosticTest($mid, $userid, $mode) {
		$where = array();
		$where['module_id'] = $mid;
		$where['user_id'] 	= $userid;
		$where['mode']		= $mode;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("dt", $where);
		$db->disconnect();

		foreach($result as $row) {
			$test = $this->setDiagnosticTest($row);
			return $test;
		}
	}

	
	public function getDiagnosticTestByID($dtid) {
		$where = array();
		$where['dt_id'] = $dtid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("dt", $where);
		$db->disconnect();

		foreach($result as $row) {
			$test = $this->setDiagnosticTest($row);
			return $test;
		}
	}
	
	public function updateDiagnosticTest($dtid, $name, $qid) {
		$where = array();
		$where['dt_id'] 		= $dtid;
	
		$data					= array();
		$data['test_name']		= $name;
		$data['qid'] 			= $qid;
		$data['date_modified']	= date('Y-m-d G:i:s');
					
		$db = new DB();
		$db->connect();
		$result = $db->update("dt", $where, $data);
		$db->disconnect();
	}
	
	public function updateDTActivation($userid, $mid, $mode, $isactive) {
		$where = array();
		$where['module_id'] 	= $mid;
		$where['user_id'] 		= $userid;
		$where['mode'] 			= $mode;
	
		$data					= array();
		$data['isactive']		= $isactive;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("dt", $where, $data);
		$db->disconnect();
	}
	
	private function setDiagnosticTest($row) {
		$dt = new DiagnosticTest();
		$dt->setDTID			($row['dt_id']);
		$dt->setTestName		($row['test_name']);
		$dt->setModuleid		($row['module_id']);
		$dt->setUserID			($row['user_id']);
		$dt->setQid				($row['qid']);
		$dt->setMode			($row['mode']);
		$dt->setCreatedDate		($row['date_created']);
		$dt->setModifiedDate	($row['date_modified']);
		return $dt;
	}
	
	private function setDtTest($values) {
		$data = array();
		$data['test_name']			= $values['test_name'];
		$data['module_id']			= $values['module_id'];
		$data['user_id']			= $values['user_id'];
		$data['qid'] 				= $values['qid'];
		$data['mode'] 				= $values['mode'];
		$data['date_created'] 		= date('Y-m-d G:i:s');
		return $data;
	}
	
	private function setCtTest($values) {
		$data = array();
		$data['module_id']			= "cumulative";
		$data['user_id']			= $values['user_id'];
		$data['qid'] 				= $values['qid'];
		$data['mode'] 				= 3;
		$data['date_created'] 		= date('Y-m-d G:i:s');
		$data['isactive'] 			= $values['isactive'];
		$data['timelimit'] 			= $values['timelimit'];
		return $data;
	}
	
	public function deleteDT($dtid) {
		$where = array();
		$where['dt_id'] = $dtid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("dt", $where);
		$db->disconnect();
	}
}
?>