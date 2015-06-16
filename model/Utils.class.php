<?php
/**
 * Utils class
 * Created by: Raina Gamboa
 */
ini_set('track_errors', true);

final class Utils {
	static public function toHash($password) { 
		//TODO
		//$salt = "";
		//$hashed = "";
		$salt = sha1(md5($password));
	 	$password = md5($password.$salt);
		$hashed = $password;
		return $hashed;
	}
	
	static public function clean($input) {
		return mysql_real_escape_string($input);
	}
}
?>