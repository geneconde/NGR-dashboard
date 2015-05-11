<?php
/**
 * Cumulative Test Controller
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

require_once($_SERVER['DOCUMENT_ROOT'].'/shymansky/dashboard/includes/CumulativeTest.class.php');


ini_set('track_errors', true);

class CumulativeTestController {
	public function __construct() {}
	
	public function addCumulativeTest($values) {
		$data = array();
		$data = $this->setCtTest($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("ct", $data);
		$db->disconnect();
	}
	
	public function getCumulativeTests($userid) {
		$where = array();
		$where['user_id'] = $userid;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("ct", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getActiveCT($userid) {
		$where = array();
		$where['user_id'] = $userid;
		$where['isactive'] = 1;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("ct", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$test = $this->setCumulativeTest($row);
			return $test;
		}
	}
	
	public function getActiveCumulativeTest($userid) {
		$where = array();
		$where['user_id'] = $userid;
		$where['isactive'] = 1;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("ct", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getCumulativeTestByID($ctid) {
		$where = array();
		$where['ct_id'] = $ctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("ct", $where);
		$db->disconnect();

		foreach($result as $row) {
			$test = $this->setCumulativeTest($row);
			return $test;
		}
	}
	
	public function updateCumulativeTest($ctid, $values) {
		$where = array();
		$where['ct_id'] 		= $ctid;
	
		$data = array();
		$data = $this->setCtValues($values);
					
		$db = new DB();
		$db->connect();
		$result = $db->update("ct", $where, $data);
		$db->disconnect();
	}

	public function updateCTQuestions($ctid, $selection) {
		$where = array();
		$where['ct_id'] = $ctid;
	
		$data = array();
		$data['qid'] = $selection;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("ct", $where, $data);
		$db->disconnect();
	}
	
	public function deactivateCT($ctid) {
		$where = array();
		$where['ct_id'] 	= $ctid;
	
		$data				= array();
		$data['isactive']	= 0;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("ct", $where, $data);
		$db->disconnect();
	}
	
	public function activateCT($ctid) {
		$where = array();
		$where['ct_id'] 	= $ctid;
	
		$data				= array();
		$data['isactive']	= 1;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("ct", $where, $data);
		$db->disconnect();
	}
	
	private function setCumulativeTest($row) {
		$ct = new CumulativeTest();
		$ct->setCTID			($row['ct_id']);
		$ct->setTestName		($row['test_name']);
		$ct->setUserID			($row['user_id']);
		$ct->setQid				($row['qid']);
		$ct->setCreatedDate		($row['date_created']);
		$ct->setModifiedDate	($row['date_modified']);
		$ct->setTimelimit		($row['timelimit']);
		$ct->setActive			($row['isactive']);
		return $ct;
	}
	
	private function setCtValues($values) {
		$data = array();
		$data['test_name']			= $values['test_name'];
		$data['timelimit'] 			= $values['timelimit'];		
		$data['isactive'] 			= $values['isactive'];		
		$data['date_modified'] 		= $values['date_modified'];
		return $data;
	}
	
	private function setCtTest($values) {
		$data = array();
		$data['test_name']			= $values['test_name'];
		$data['user_id']			= $values['user_id'];
		$data['qid'] 				= $values['qid'];
		$data['date_created'] 		= $values['date_created'];
		$data['date_modified'] 		= $values['date_modified'];
		$data['timelimit'] 			= $values['timelimit'];
		$data['isactive'] 			= $values['isactive'];
		return $data;
	}
	
	public function deleteCT($ctid) {
		$where = array();
		$where['ct_id'] = $ctid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("ct", $where);
		$db->disconnect();
	}
}
?>