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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/User.class.php');

ini_set('track_errors', true);

class UserController {
	public function __construct() {}

	public function getAllUsers() {
		$users = array();
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users");
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			array_push($users, $user);
		}
		
		return empty($users) ? null : $users;
	}
	
	public function loadUserType($type, $teacherid) {
		$where = array();
		$where['type'] = $type;
		$where['teacher_id'] = $teacherid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where,'*','last_name ASC');
		$db->disconnect();	
		return $result;
	}
	
	public function loadUser($username) {
		$where = array();
		$where['username'] = $username;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}
	}

	public function loadUserByID($userid) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}
	}

	public function loadUserTypeOrderLname($type, $teacherid) {
		$where = array();
		$where['type'] = $type;
		$where['teacher_id'] = $teacherid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where,'*','if(last_name = "" or last_name is null,1,0),last_name');
		$db->disconnect();	
		return $result;
	}
	
	public function getUserByUsername($username) {
		$where = array();
		$where['username'] = $username;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();

		return $result;
	}

	public function checkNameExists($username, $type) {
		$where = array();
		$where['username'] = $username;
		$where['type'] = $type;

		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function countUserType($subid, $type) {
		$where = array();
		$where['subscriber_id'] = $subid;
		$where['type'] = $type;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		return count($result);
	}

	public function countTeacherStudents($subid, $teacherid, $type) {
		$where = array();
		$where['subscriber_id'] = $subid;
		$where['teacher_id'] = $teacherid;
		$where['type'] = $type;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		return count($result);
	}

	public function updateUser($userid, $uname, $password, $fname, $lname, $gender) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['first_name'] = $fname;
		$data['last_name'] 	= $lname;
		$data['username']	= $uname;
		$data['password']	= $password;
		$data['gender']		= $gender;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updatePassword($userid, $newpassword){
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['password'] = $newpassword;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updatePasswordByEmail($userid, $newpassword){
		$where = array();
		$where['subscriber_id'] = $userid;
		$where['type'] = 3;

		$data = array();
		$data['password'] = $newpassword;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updatePasswordByUsername($username, $type, $newpassword){
		$where = array();
		$where['username'] = $username;
		$where['type'] = $type;

		$data = array();
		$data['password'] = $newpassword;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function updateUserPassword($userid, $password){
		$where = array();
		$where['user_ID'] = $userid;
		
		// $salt = sha1(md5($password));
		// $password = md5($password.$salt);
	
		$data = array();
		$data['password']           = $password;
		
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function softDeleteUser($userid, $is_deleted) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$data = array();
		$data['is_deleted'] = $is_deleted;
					
		$db = new DB();
		$db->connect();
		$result = $db->update("users", $where, $data);
		$db->disconnect();
	}

	public function deleteUser($userid) {
		$where = array();
		$where['user_ID'] = $userid;
				
		$db = new DB();
		$db->connect();
		$result = $db->delete("users", $where);
		$db->disconnect();
	}

	public function registerUser($user) {
		$data = array();
		$data = $this->setData($user);
		
		$data['username'] = $user->getUsername();	
		$data['status'] = 'Active';	
		$data['role'] = 'Student';
				
		$db = new DB();
		$db->connect();
		$db->insert("users", $data);
		$db->disconnect();
	}
 
	public function loginUser($username, $password) {
		if ($user = $this->loadUser($username)) {
			$hashedpass = $password;
			
			if ($user->getPassword() == $hashedpass) {
				return $user;
			}
			else{ return Error::ERROR_WRONG_PASSWORD;
				header("Location: login.php?err=2");
			}
		} else {
			return Error::ERROR_WRONG_USERNAME;		
			header("Location: login.php?err=3");
		}
	}

	public function checkUser($userid, $password) {
		if ($user = $this->loadUserByID($userid)) {
			$hashedpass = $password;
			
			if ($user->getPassword() == $hashedpass) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function logoutUser() {
		$_SESSION = array();
		session_unset();
		session_destroy();
	}
	
	public function checkUserExists($username) {
		$where = array();
		$where['username'] = $username;
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);

		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}

	public function checkEmailExists($email) {
		$where = array();
		$where['email'] = $email;
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		
		if ($db->dbgetrowcount() > 0)
			return true;		
		$db->disconnect();		
		return false;
	}
	
	public function getUser($userid) {
		$where = array();
		$where['user_ID'] = $userid;
		
		$db = new DB();
		$db->connect();
		$result = $db->select("users", $where);
		$db->disconnect();
		
		foreach($result as $row) {
			$user = $this->setUser($row);
			return $user;
		}	
	}
	
	private function setData($user) {
		$data = array();
		$data['password']			= Utils::toHash($user->getPassword());
		$data['username']			= $user->getUsername();
		$data['first_name'] 		= $user->getFirstname();
		$data['last_name'] 			= $user->getLastname();
		$data['user_ID'] 			= $user->getUserid();
		$data['gender']				= $user->getGender();
		$data['type']				= $user->getType();
		$data['teacher_id']			= $user->getTeacher();
		$data['grade_level']		= $user->getGrade_level();
		$data['students']			= $user->getStudents_limit();
		$data['subhead_id']			= $user->getSubheadid();
		return $data;
	}
	
	private function setUser($row) {
		$user = new User();
		$user->setUsername($row['username']);
		$user->setPassword($row['password']);
		$user->setFirstname($row['first_name']);
		$user->setLastname($row['last_name']);
		$user->setUserid($row['user_ID']);
		$user->setGender(strtolower($row['gender']));
		$user->setType($row['type']);
		$user->setTeacher($row['teacher_id']);
		$user->setSubscriber($row['subscriber_id']);
		$user->setSubheadid($row['subhead_id']);
		$user->setGrade_level($row['grade_level']);
		$user->setStudents_limit($row['students']);
		return $user;
	}
	
	/* For generating accounts */
	public function addUser($user) {
		$data = array();
		$data2 = array();
		$data = $this->setUserValues($user);
				
		$db = new DB();
		$db->connect();
		$db->insert("users", $data);
		$db->disconnect();
	}

	/* For retrieving level of accounts */
	public function getUserLevel($user) {
		$custom_query = "";
		
		$custom_query = "SELECT * FROM users WHERE subhead_id=".$user;

		return $custom_query;
	}
	
	private function setUserValues($values) {
		// $salt = sha1(md5($values['password']));
		// $password = md5($values['password'].$salt);
	
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $values['password'];
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['last_name'] 		= $values['last_name'];
		$data['gender'] 		= $values['gender'];
		$data['teacher_id'] 	= $values['teacher_id'];
		$data['subscriber_id'] 	= $values['subscriber_id'];
		$data['grade_level']	= $values['grade_level'];
		$data['students']		= $values['students'];
		return $data;
	}
	
	private function setUserValues2($values) {
		$data = array();
		$data['username']		= $values['username'];
		$data['password']		= $values['password'];
		$data['type'] 			= $values['type'];
		$data['first_name'] 	= $values['first_name'];
		$data['last_name'] 		= $values['last_name'];
		$data['gender'] 		= $values['gender'];
		$data['teacher_id'] 	= $values['teacher_id'];
		$data['subscriber_id'] 	= $values['subscriber_id'];
		$data['grade_level'] 	= $values['grade_level'];
		$data['students'] 		= $values['students'];
		return $data;
	}
	
	// private function setUserValues($values) {
	// 	$salt = sha1(md5($values['password']));
	// 	$password = md5($values['password'].$salt);
	
	// 	$data = array();
	// 	$data['username']		= $values['username'];
	// 	$data['password']		= $password;
	// 	$data['type'] 			= $values['type'];
	// 	$data['first_name'] 	= $values['first_name'];
	// 	$data['gender'] 		= $values['gender'];
	// 	$data['teacher_id'] 	= $values['teacher_id'];
	// 	$data['subscriber_id'] 	= $values['subscriber_id'];
	// 	return $data;
	// }
	
	// private function setUserValues2($values) {
	// 	$data = array();
	// 	$data['username']		= $values['username'];
	// 	$data['password']		= $values['password'];
	// 	$data['type'] 			= $values['type'];
	// 	$data['first_name'] 	= $values['first_name'];
	// 	$data['gender'] 		= $values['gender'];
	// 	$data['teacher_id'] 	= $values['teacher_id'];
	// 	$data['subscriber_id'] 	= $values['subscriber_id'];
	// 	return $data;
	// }
}
?>