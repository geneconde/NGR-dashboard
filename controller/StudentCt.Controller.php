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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/StudentCt.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/StudentCtAnswer.class.php');

ini_set('track_errors', true);
 
class StudentCtController {
	public function __construct() {}
	
	public function getStudentCt($userid, $ctid) {
		$where = array();
		$where['user_id'] 	= $userid;
		$where['ct_id'] 	= $ctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct", $where);
		$db->disconnect();

		foreach($result as $row) {
			$sdt = $this->setStudentCt($row);
			return $sdt;
		}
	}

	public function getCtByStudent($userid) {
		$where = array();
		$where['user_id'] 	= $userid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct", $where);
		$db->disconnect();

		return $result;
	}
	
	public function getStudentCtByID($sctid) {
		$where = array();
		$where['student_ct_id'] = $sctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct", $where);
		$db->disconnect();

		foreach($result as $row) {
			$sdt = $this->setStudentCt($row);
			return $sdt;
		}
	}
	
	public function getStudentCtByTest($ctid) {
		$where = array();
		$where['ct_id'] = $ctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct", $where);
		$db->disconnect();

		return $result;
	}
	
	public function finishCumulativeTest($sctid, $startdate) {
		$where = array();
		$where['student_ct_id'] = $sctid;
	
		$data					= array();
		$data['date_ended'] 	= date('Y-m-d G:i:s');
		$data['date_started'] 	= $startdate;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("student_ct", $where, $data);
		$db->disconnect();
	}
	
	public function getCTAnsweredQuestions($sctid) {
		$where = array();
		$where['student_ct_id'] = $sctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_answers", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getStudentAnswer($studentctid) {
		$where = array();
		$where['student_ct_id'] = $studentdtid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_answers", $where, "*", "qid ASC");
		$db->disconnect();
		return $result;
	}
	
	public function getCTStudentAnswerByQuestion($studentctid, $qid) {
		$where = array();
		$where['student_ct_id'] = $studentctid;
		$where['qid'] = $qid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_answers", $where);
		$db->disconnect();
		return $result;
	}
	
	public function getCTTargetAnswer($studentctid, $qid) {
		$where = array();
		$where['student_ct_id'] = $studentctid;
		$where['qid']			= $qid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_answers", $where);
		$db->disconnect();
		return $result[0]['answer'];
	}
	
	public function updateAnswer($studentctid, $qid, $answer, $mark) {
		$where = array();
		$where['student_ct_id'] = $studentctid;
		$where['qid'] 			= $qid;
	
		$data					= array();
		$data['answer'] 		= $answer;
		$data['mark']			= $mark;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("student_ct_answers", $where, $data);
		$db->disconnect();
	}
	
	public function addStudentCT($values){
		$data = array();
		$data = $this->setCtValues($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("student_ct", $data);
		$db->disconnect();
	}
	
	private function setCtValues($values) {
		$data = array();
		$data['ct_id']				= $values['ct_id'];
		$data['user_id']			= $values['user_id'];
		$data['date_started'] 		= $values['date_started'];
		return $data;
	}
	
	public function addStudentAnswer($values) {
		$data = array();
		$data = $this->setCtAnswers($values);
				
		$db = new DB();
		$db->connect();
		$db->insert("student_ct_answers", $data);
		$db->disconnect();
	}
	
	private function setCtAnswers($values) {
		$data = array();
		$data['student_ct_id']		= $values['student_ct_id'];
		$data['qid']				= $values['qid'];
		$data['answer'] 			= $values['answer'];
		$data['mark'] 				= $values['mark'];
		return $data;
	}
	
	private function setStudentCt($row) {
		$st = new StudentCt();
		$st->setSCTID		($row['student_ct_id']);
		$st->setCTID		($row['ct_id']);
		$st->setUserID		($row['user_id']);
		$st->setStartDate	($row['date_started']);
		$st->setEndDate		($row['date_ended']);
		return $st;
	}
	
	private function setStudentAnswer($row) {
		$sca = new StudentCtAnswer();
		$sca->setStudentDtID		($row['student_ct_id']);
		$sca->setQid				($row['qid']);
		$sca->setAnswer				($row['answer']);
		$sca->setMark				($row['mark']);
		return $sca;
	}
	
	public function deleteCtTest($sctid) {
		$where = array();
		$where['student_ct_id'] = $sctid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("student_ct", $where);
		$db->disconnect();
	}
	
	public function deleteCtAnswers($sctid) {
		$where = array();
		$where['student_ct_id'] = $sctid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("student_ct_answers", $where);
		$db->disconnect();
	}

	public function getAllGroups() {
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_group");
		$db->disconnect();
		return $result;
	}

	public function getGroupsInCT($ctid) {
		$where = array();
		$where['ct_id'] = $ctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_group", $where);
		$db->disconnect();
		return $result;
	}

	public function activateGroupCT($ctid, $gid) {
		$data = array();
		$data['ct_id'] = $ctid;
		$data['group_id'] = $gid;

		$db = new DB();
		$db->connect();
		$db->insert('student_ct_group', $data);
		$db->disconnect();
	}

	public function deactivateGroupCT($ctid) {
		$where = array();
		$where['ct_id'] 	= $ctid;
		
		$db = new DB();
		$db->connect();
		$result = $db->delete("student_ct_group", $where);
		$db->disconnect();
	}

	public function checkActiveCTGroup($gid) {
		$where = array();
		$where['group_id'] 	= $gid;

		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_group", $where);
		$db->disconnect();
		return $result;
	}

	public function deactivateTargetGroupCT($gid, $ctid) {
		$where = array();
		$where['group_id'] 	= $gid;
		
		$db = new DB();
		$db->connect();
		$result = $db->delete("student_ct_group", $where, $data);
		$db->disconnect();
	}

	public function getActiveCT($gid) {
		$where = array();
		$where['group_id'] = $gid;

		$db = new DB();
		$db->connect();
		$result = $db->select("student_ct_group", $where);
		$db->disconnect();
		return $result;
	}
}
?>