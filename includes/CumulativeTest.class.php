<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class CumulativeTest {
	private $ctid				= null;
	private $test_name			= null;
	private $userid				= null;
	private $qid				= null;
	private $datecreated		= null;
	private $datemodified 		= null;
	private $timelimit	 		= null;
	private $isactive	 		= null;

	public function __construct() {}
	
	public function getCTID() 								{ return $this->dtid;							}
	public function getTestName() 							{ return $this->test_name;						}
	public function getUserid() 							{ return $this->userid;							}
	public function getQid() 								{ return $this->qid;							}		
	public function getCreatedDate() 						{ return $this->datecreated;					}
	public function getModifiedDate() 						{ return $this->datemodified;					}
	public function getTimelimit()							{ return $this->timelimit;						}
	public function getActive()								{ return $this->isactive;						}
	
	public function setCTID($dtid)							{ $this->dtid				= $dtid;			}
	public function setTestName($test_name)					{ $this->test_name			= $test_name;		}
	public function setUserID($userid)						{ $this->userid				= $userid;			}
	public function setQid($qid)							{ $this->qid				= $qid;				}
	public function setCreatedDate($datecreated)			{ $this->datecreated		= $datecreated;		}
	public function setModifiedDate($datemodified)			{ $this->datemodified		= $datemodified;	}
	public function setTimelimit($timelimit)				{ $this->timelimit			= $timelimit;		}
	public function setActive($isactive)					{ $this->isactive			= $isactive;		}
}
?>
