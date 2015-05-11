<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentGroup {
	private $groupid		= null;
	private $group_name		= null;
	private $teacher_id		= null;
	private $isactive		= null;

	public function __construct() {}
	
	public function getGroupID() 			{ return $this->groupid;		}	
	public function getGroupName() 			{ return $this->group_name;		}	
	public function getTeacherID() 			{ return $this->teacher_id;		}	
	public function getActive() 			{ return $this->isactive;		}	

	public function setGroupID($groupid)		{ $this->groupid		= $groupid;		}
	public function setGroupName($group_name) 	{ $this->group_name 	= $group_name;	}
	public function setTeacherID($teacher_id) 	{ $this->teacher_id 	= $teacher_id;	}
	public function setActive($isactive) 		{ $this->isactive 		= $isactive;	}
}
?>