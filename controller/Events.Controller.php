<?php

if(!class_exists('Error')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Error.class.php');
}

if(!class_exists('Utils')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/Utils.class.php');
}

if(!class_exists('DB')) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/db.inc.php');
}

ini_set('track_errors', true);

class EventsController {
	public function __construct() {}

	public function getAllLogs() {
		$db = new DB();
		$db->connect();
		$result = $db->select("event_logs", $where, "first_name, last_name");
		$db->disconnect();
		return $result;
	}

	public function checkLog($user) {
		$db = new DB();
		$db->connect();
		$result = $db->query("SELECT count(*) FROM event_logs WHERE user_id=$user");
		$db->disconnect();
		return $result;
	}

	public function takes_module($userid, $username, $module) {
		$data = array();
		$data['event'] = $username . " takes module '" . $module . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function finish_module($smid) {
		$where = array();
		$where['student_module_ID'] = $smid;

		$db = new DB();
		$db->connect();
		$user_mid = $db->select("student_module", $where, "user_ID, module_ID");

		$data = array();
		$data['event'] = $user_mid[0]['user_ID'] . " finished module '" . $user_mid[0]['module_ID'] . "'";
		$data['user_id'] = $userid;
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function create_pre_test($userid, $username, $test) {
		$data = array();
		$data['event'] = $username . " created pre-test '" . $test . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function create_post_test($userid, $username, $test) {
		$data = array();
		$data['event'] = $username . " created post-test '" . $test . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function create_cumulative_test($userid, $username, $test) {
		$data = array();
		$data['event'] = $username . " created cumulative test '" . $test . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function take_pre($userid, $username, $mname) {
		$data = array();
		$data['event'] = $username . " takes pre-test on '" . $mname . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function take_post($userid, $username, $mname) {
		$data = array();
		$data['event'] = $username . " takes post-test on '" . $mname . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function take_cumulative($userid, $username) {
		$data = array();
		$data['event'] = $username . " takes cumulative-test";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function activates_module($userid, $username, $module) {
		$data = array();
		$data['event'] = $username . " activates module '" . $module . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function activate_pre($userid, $username, $test) {
		$data = array();
		$data['event'] = $username . " activates pre-test '" . $test . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function activate_post($userid, $username, $test) {
		$data = array();
		$data['event'] = $username . " activates post-test '" . $test . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}

	public function activate_cumulative($userid, $username, $test) {
		$data = array();
		$data['event'] = $username . " activates cumulative-test '" . $test . "'";
		$data['user_id'] = $userid;

		$db = new DB();
		$db->connect();
		$result = $db->insert("event_logs", $data);
		$db->disconnect();
	}
}
?>