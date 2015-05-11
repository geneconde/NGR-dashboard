<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentUserGroup {
	private $group_id	= null;
	private $user_id	= null;

	public function __construct() {}
	
	public function getGroupID() 			{ return $this->qid;	}	
	public function getUserID() 			{ return $this->choice;	}	

	public function setGroupID($group_id)	{ $this->group_id	= $group_id;	}
	public function setUserID($user_id) 	{ $this->user_id 	= $user_id;		}
}
