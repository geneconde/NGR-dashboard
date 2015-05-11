<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class TeacherModule {
	private $userid			= null;
	private $moduleid		= null;

	public function __construct() {}
	
	public function getUserID() 						{ return $this->userid;			}	
	public function getModuleID() 						{ return $this->moduleid;		}

	
	public function setUserID($userid)					{ $this->userid		= $userid;		}
	public function setModuleID($moduleid) 				{ $this->moduleid 	= $moduleid;	}
}
