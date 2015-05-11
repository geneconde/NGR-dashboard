<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentDt {
	private $studentdtid	= null;
	private $userid			= null;
	private $moduleid		= null;
	private $mode			= null;
	private $dtid			= null;
	private $datestarted	= null;
	private $dateended 		= null;

	public function __construct() {}
	
	public function getStudentDtID() 						{ return $this->studentdtid;			}	
	public function getUserID() 							{ return $this->userid;					}	
	public function getModuleID() 							{ return $this->moduleid;				}	
	public function getMode() 								{ return $this->mode;					}	
	public function getDTID() 								{ return $this->dtid;					}	
	public function getStartDate() 							{ return $this->datestarted;			}
	public function getEndDate() 							{ return $this->dateended;				}	
	
	public function setStudentDtID($studentdtid)			{ $this->studentdtid	= $studentdtid;	}
	public function setUserID($userid) 						{ $this->userid 		= $userid;		}
	public function setModuleID($moduleid) 					{ $this->moduleid 		= $moduleid;	}
	public function setMode($mode) 							{ $this->mode 			= $mode;		}
	public function setDTID($dtid)							{ $this->dtid			= $dtid;		}
	public function setStartDate($datestarted)				{ $this->datestarted	= $datestarted;	}
	public function setEndDate($dateended)					{ $this->dateended		= $dateended;	}
}
?>