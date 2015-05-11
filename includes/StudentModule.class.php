<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentModule {
	private $smid			= null;
	private $userid			= null;
	private $moduleid		= null;
	private $date_started	= null;
	private $last_screen	= null;
	private $date_finished	= null;

	public function __construct() {}
	
	public function getSMID() 							{ return $this->smid;			}	
	public function getUserID()							{ return $this->userid;			}	
	public function getModuleID() 						{ return $this->moduleid;		}	
	public function getDateStart() 						{ return $this->date_started;	}	
	public function getLastScreen() 					{ return $this->last_screen;	}	
	public function getDateFinished() 					{ return $this->date_finished;	}	
	
	public function setSMID($smid)						{ $this->smid			= $smid;			}
	public function setUserID($userid)					{ $this->userid			= $userid;			}
	public function setModuleID($moduleid) 				{ $this->moduleid 		= $moduleid;		}
	public function setDateStart($date_started) 		{ $this->date_started 	= $date_started;	}
	public function setLastScreen($last_screen) 		{ $this->last_screen 	= $last_screen;		}
	public function setDateFinished($date_finished) 	{ $this->date_finished 	= $date_finished;	}
}
?>