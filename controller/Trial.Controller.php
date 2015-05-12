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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/Trial.Class.php');

ini_set('track_errors', true);

class TrialController {
	public function __construct() {}

	public function getAllTrialUsers() {
		$users = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("trial_users");
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setTrialUser($row);
			array_push($users, $user);
		}
		
		return empty($users) ? null : $users;
	}

	public function addTrialUsers($values) {
		$data = array();
		$data = $this->setValues($values);
				
		$db = new DB();
		$db->connect();
		$tid = $db->insertReturn("trial_users", $data);
		$db->disconnect();

		return $tid;
	}

	public function updateTrialUserDate($userid, $new_curr_date) {
		$where = array();
		$where['demo_ID'] = $userid;
		
		$data = array();
		$data['date_current'] = $new_curr_date;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("trial_users", $where, $data);
		$db->disconnect();
	}

	public function loadTrialUsers($subid) {
		$where = array();
		$where['id'] = $subid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("trial_users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$trials = $this->setTrialUser($row);
			return $trials;
		}	
	}

	public function checkEmailExistsTrial($email) {
		$where = array();
		$where['email'] = $email;
		$db = new DB();
		$db->connect();
		$result = $db->select("trial_users", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	private function setValues($values) {
		$data = array();
		$data['cname']						= $values['cname'];
		$data['school'] 					= $values['school'];				
		$data['state'] 						= $values['state'];
		$data['email'] 						= $values['email'];
		$data['date_created'] 				= date('Y-m-d');
		$data['date_current'] 				= date('Y-m-d');

		return $data;
	}

	public function getTrialUser($id_demo) {
		$where = array();
		$where['demo_ID'] = $id_demo;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("trial_users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setTrialUser($row);
			return $user;
		}	
	}

/*	public function getAllExpiredUsers($newdate) {
		$where = array();
		$where['date_created'] = $newdate;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("trial_users", $where);
		$db->disconnect();
		return $result;
	}*/

/*	public function getAllExpiredUsers($newdate) {
		$where = array();
		$where['date_current'] = $newdate;

		$users = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("trial_users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setTrialUser($row);
			array_push($users, $user);
		}
		
		return empty($users) ? null : $users;

	}*/


	private function setData($user) {
		$data = array();
		$data['demo_ID']				= $user->getTrialId();
		$data['cname'] 					= $user->getName();
		$data['school'] 				= $user->getDistrict();
		$data['state'] 					= $user->getState();
		$data['email']					= $user->getEmail();
		$data['date_created']			= $user->getDateCreated();
		$data['date_current']			= $user->getDateCurrent();
		return $data;
	}

	private function setTrialUser($row) {
		$user = new Trial();
		$user->setTrialId($row['demo_ID']);
		$user->setName($row['cname']);
		$user->setDistrict($row['school']);
		$user->setTown($row['state']);
		$user->setEmail($row['email']);
		$user->setDateCreated($row['date_created']);
		$user->setDateCurrent($row['date_current']);

		return $user;
	}
}
?>