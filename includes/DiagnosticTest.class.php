<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class DiagnosticTest {
	private $dtid				= null;
	private $test_name			= null;
	private $moduleid			= null;
	private $qid				= null;
	private $userid				= null;
	private $mode				= null;
	private $datecreated		= null;
	private $datemodified 		= null;

	public function __construct() {}
	
	public function getDTID() 								{ return $this->dtid;							}
	public function getTestName() 							{ return $this->test_name;						}
	public function getModuleid() 							{ return $this->moduleid;						}
	public function getQid() 								{ return $this->qid;							}	
	public function getUserid() 							{ return $this->userid;							}	
	public function getMode() 								{ return $this->mode;							}	
	public function getCreatedDate() 						{ return $this->datecreated;					}
	public function getModifiedDate() 						{ return $this->datemodified;					}
	
	public function setDTID($dtid)							{ $this->dtid				= $dtid;			}
	public function setTestName($test_name)					{ $this->test_name			= $test_name;		}
	public function setModuleid($moduleid) 					{ $this->moduleid 			= $moduleid;		}
	public function setQid($qid)							{ $this->qid				= $qid;				}
	public function setUserID($userid)						{ $this->userid				= $userid;			}
	public function setMode($mode)							{ $this->mode				= $mode;			}
	public function setCreatedDate($datecreated)			{ $this->datecreated		= $datecreated;		}
	public function setModifiedDate($datemodified)			{ $this->datemodified		= $datemodified;	}
}
?>
