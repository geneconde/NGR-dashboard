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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/SubscriberHistory.class.php');

ini_set('track_errors', true);

class SubscriberHistoryController {
	public function __construct() {}

	public function addSubscriberHistory($values) {
		$data = array();
		$data = $this->setValuesHistory($values);

		$db = new DB();
		$db->connect();
		$sid = $db->insert("subscribers_transactions", $data);
		// $sid = $db->insertReturn("subscribers_transactions", $data);
		$db->disconnect();

		return $sid;
	}

	// public function checkSubscriberType($id) {
	// 	$where = array();
	// 	$where['subscriber_id'] = $id;
	// 	$db = new DB();
	// 	$db->connect();
	// 	$result = $db->select("subscribers_transactions", $where);
		
	// 	if ($db->dbgetrowcount() > 0)
	// 		return true;		
	// 	$db->disconnect();		
	// 	return false;
	// }

	public function loadSubscriberHistory($subid) {
		$where = array();
		$where['id'] = $subid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("subscribers_transactions", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$subscriber = $this->setSubscriberHistory($row);
			return $subscriber;
		}	
	}

	private function setSubscriberHistory($row) {
		$subscriberHistory = new SubscriberHistory();
		$subscriberHistory->setRecordId($row['record_id']);
		$subscriberHistory->setPurchaseId($row['purchase_id']);
		$subscriberHistory->setSubscriberId($row['subscriber_id']);
		$subscriberHistory->setDatePaid($row['date_paid']);
		$subscriberHistory->setDateCreated($row['date_created']);
		$subscriberHistory->setDateModified($row['date_modified']);
		$subscriberHistory->setSubscriberOption($row['subscriber_option']);
		$subscriberHistory->setAmountPaid($row['amount_paid']);
		$subscriberHistory->setType($row['type']);
		return $subscriberHistory;
	}

	private function setValuesHistory($values) {
		$data = array();
		$data['purchase_id']							= $values['purchase_id'];
		$data['subscriber_id']							= $values['subscriber_id'];
		$data['date_paid']								= date('Y-m-d G:i:s');
		$data['date_created']							= date('Y-m-d G:i:s');
		$data['date_modified']							= date('Y-m-d G:i:s');
		$data['subscriber_option']						= $values['subscriber_option'];
		$data['amount_paid']							= $values['amount_paid'];
		$data['type']									= $values['type'];
		return $data;
	}
}
?>