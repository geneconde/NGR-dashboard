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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/Language.class.php');

ini_set('track_errors', true);
 
class LanguageController {
	public function __construct() {}
	
	public function getAllLanguages() {
		$languages = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("languages");
		$db->disconnect();
		
		foreach($result as $row) {
			$language = $this->setLanguage($row);
			array_push($languages, $language);
		}
		
		return empty($languages) ? null : $languages;
	}
		
	public function addTeacherLanguage($teacher_language) {
		$data = array();
		$data = $this->setTeacherLanguageData($teacher_language);
				
		$db = new DB();
		$db->connect();
		$db->insert("teacher_language", $data);
		$db->disconnect();
	}

	public function getLanguages() {
		$where = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("languages");
		$db->disconnect();
		
		return $result;
	}
	
	// public function updateTeacherLanguage($teacher_id, $language_id, $is_active) {
		// $where = array();
		// $where['teacher_id'] = $teacher_id;
		// $where['language_id'] = $language_id;
		
		// $data = array();
		// $data['is_active'] = $is_active;
					
		// $db = new DB();
		// $db->connect();
		// $result = $db->update("teacher_language", $where, $data);
		// $db->disconnect();
	// }
	
	public function getLanguage($language_id) {
		$where = array();
		$where['id'] = $language_id;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("languages", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$language = $this->setLanguage($row);
			return $language;
		}
	}
	
	public function getDefaultLanguageByTeacher($teacher_id) {
		$where = array();
		$where['teacher_id'] = $teacher_id;
		$where['is_default'] = 1;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_language", $where);
		$db->disconnect();
		
		return $result;
	}

	public function getLanguageByTeacher($teacher_id) {
		$where = array();
		$where['teacher_id'] = $teacher_id;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_language", $where);
		$db->disconnect();
		
		return $result;
	}
	
	public function getDefaultLanguage($teacher_id, $is_default) {
		$where = array();
		$where['teacher_id'] = $teacher_id;
		$where['is_default'] = $is_default;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_language", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$language = $this->setTeacherLanguage($row);
			return $language;
		}
	}
	
	public function updateDefaultLanguage($teacher_id, $language_id,$default) {
		$where = array();
		$where['teacher_id'] = $teacher_id;
		$where['language_id'] = $language_id;
		
		$data = array();
		$data['is_default'] = $default;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("teacher_language", $where, $data);
		$db->disconnect();
	}
	
	public function setDefaultLanguage($teacher_id, $language_id) {
		$data = array();
		$data['teacher_id'] = $teacher_id;
		$data['language_id'] = $language_id;
		$data['is_default'] = 1;
					
		$db = new DB();
		$db->connect();
		$result = $db->insert("teacher_language", $data);
		$db->disconnect();
	}
	
	public function deleteTeacherLanguage($teacher_id) {
		$where = array();
		$where['teacher_id'] = $teacher_id;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("teacher_language", $where);
		$db->disconnect();
	}
	
	public function checkLanguageExists($language_id) {
		
		$where = array();
		$where['language_id'] = $language_id;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_language", $where);

		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}
	
	public function checkTeacherExists($teacher_id) {
		
		$where = array();
		$where['teacher_id'] = $teacher_id;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("teacher_language", $where);

		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}
	
	// setting and getting of DATA
	private function setLanguageData($language) {
		$data = array();
		$data['id']						= $language->getLanguage_id();
		$data['language_code']			= $language->getLanguage_code();
		$data['language'] 				= $language->getLanguage();
		$data['shortcode'] 				= $language->getShortcode();
		return $data;
	}
	
	private function setLanguage($row) {
		$language = new Language();
		$language->setLanguage_id($row['id']);
		$language->setLanguage_code($row['language_code']);
		$language->setLanguage($row['language']);
		$language->setShortcode($row['shortcode']);
		return $language;
	}
	
	private function setTeacherLanguageData($submission) {
		$data = array();
		$data['teacher_id']		= $submission->getTeacher_id();
		$data['language_id']	= $submission->getLanguage_id();
		$data['is_default']		= $submission->getIs_default();
		return $data;
	}
	
	private function setTeacherLanguage($row) {
		$teacher_language = new TeacherLanguage();
		$teacher_language->setTeacher_id($row['teacher_id']);
		$teacher_language->setLanguage_id($row['language_id']);
		$teacher_language->setIs_default($row['is_default']);
		return $teacher_language;
	}
	
}
?>