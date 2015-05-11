<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentCt {
	private $student_ct_id		= null;
	private $ctid				= null;
	private $userid				= null;
	private $datestarted		= null;
	private $dateended	 		= null;

	public function __construct() {}
	
	public function getSCTID() 						{ return $this->student_ct_id;				}
	public function getCTID()	 					{ return $this->ctid;						}
	public function getUserID() 					{ return $this->userid;						}
	public function getStartDate()					{ return $this->datestarted;				}	
	public function getEndDate() 					{ return $this->dateended;					}
	
	public function setSCTID($student_ct_id)		{ $this->student_ct_id	= $student_ct_id;	}
	public function setCTID($ctid)					{ $this->ctid			= $ctid;			}
	public function setUserID($userid)				{ $this->userid			= $userid;			}
	public function setStartDate($datestarted)		{ $this->datestarted	= $datestarted;		}
	public function setEndDate($dateended)			{ $this->dateended		= $dateended;		}
}
?>
