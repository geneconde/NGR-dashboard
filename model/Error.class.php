<?php
/**
 * Error class
 * Created by: Raina Gamboa
 */
class Error {
	const ERROR_WRONG_USERNAME = "Username does not exist!";
	const ERROR_WRONG_PASSWORD = "Wrong password!";
	const ERROR_CONFIRM_INFORMATION = "Error information must be equal!";
	const ERROR_OLDINFO_NOT_EQUAL = "Error wrong information!";
	const ERROR_NULL_VALUES = "Error fields must not be NULL!";
		
	private $error = null;
	
	public function __construct($error) {
		$this->error = $error;
	}
	
	public function getError() {
		return $error();
	}
}
?>