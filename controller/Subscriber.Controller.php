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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/Subscriber.Class.php');

ini_set('track_errors', true);

class SubscriberController {
	public function __construct() {}

	public function addSubscriber($values) {
		$data = array();
		$data = $this->setValues($values);
				
		$db = new DB();
		$db->connect();
		$sid = $db->insertReturn("subscribers", $data);
		$db->disconnect();

		return $sid;
	}

	public function getIdByEmail($email){
		$where = array();
		$where['email'] = $email;
	
		$db = new DB();
		$db->connect();
		$result = $db->select("subscribers", $where);
		$db->disconnect();		
		return $result;
	}

	public function getUserIdbySubId($sid){
		$where = array();
		$where['subscriber_id'] = $sid;
		$where['type'] = 3;

		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);

		$db->disconnect();		

		return $result;
	}

	public function checkEmailExistsSubscribe($email) {
		$where = array();
		$where['email'] = $email;
		$db = new DB();
		$db->connect();
		$result = $db->select("subscribers", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function loadSubscriber($subid) {
		$where = array();
		$where['id'] = $subid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("subscribers", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$subscriber = $this->setSubscriber($row);
			return $subscriber;
		}	
	}

	private function setSubscriber($row) {
		$subscriber = new Subscriber();
		$subscriber->setID($row['id']);
		$subscriber->setFirstName($row['first_name']);
		$subscriber->setLastName($row['last_name']);
		$subscriber->setDistrict($row['school_district_name']);
		// $subscriber->setEnrolment($row['school_district_enrolment']);
		$subscriber->setTown($row['state']);
		$subscriber->setEmail(strtolower($row['email']));
		$subscriber->setTeachers($row['teachers']);
		$subscriber->setStudents($row['students']);
		$subscriber->setSubscription($row['subscription']);
		$subscriber->setNotes($row['notes']);
		$subscriber->setDateCreated($row['date_created']);
		$subscriber->setDateUpdated($row['date_updated']);
		$subscriber->setActive($row['active']);
		return $subscriber;
	}

	private function setValues($values) {
		$data = array();
		$data['first_name']					= $values['fname'];
		$data['last_name']					= $values['lname'];
		$data['school_district_name'] 		= $values['school'];		
		$data['state'] 						= $values['state'];
		$data['email'] 						= $values['email'];
		$data['teachers'] 					= $values['teachers'];
		$data['students'] 					= $values['students'];
		$data['subscription'] 				= $values['subscribe'];
		$data['notes'] 						= $values['notes'];
		$data['date_created'] 				= date('Y-m-d G:i:s');
		$data['date_updated'] 				= date('Y-m-d G:i:s');
		$data['date_updated'] 				= date('Y-m-d G:i:s');
		$data['active'] 					= 1;
		return $data;
		// $data = array();
		// $data['first_name']					= $values['first_name'];
		// $data['last_name']					= $values['last_name'];
		// $data['school_district_name'] 		= $values['school'];		
		// // $data['school_district_enrolment'] 	= $values['schoolStud'];		
		// $data['state'] 						= $values['state'];
		// $data['email'] 						= $values['email'];
		// $data['teachers'] 					= $values['teachers'];
		// $data['students'] 					= $values['students'];
		// $data['subscription'] 				= $values['subscribe'];
		// $data['notes'] 						= $values['notes'];
		// $data['date_created'] 				= date('Y-m-d G:i:s');
		// $data['date_updated'] 				= date('Y-m-d G:i:s');
		// $data['date_updated'] 				= date('Y-m-d G:i:s');
		// $data['active'] 					= 1;
		// return $data;
	}
}
?>