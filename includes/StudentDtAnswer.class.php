<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentDtAnswer {
	private $studentdtid		= null;
	private $qid				= null;
	private $answer 			= null;
	private $mark				= null;

	public function __construct() {}
		
	public function getStudentDtID() 						{ return $this->studentdtid;		}		
	public function getQid() 								{ return $this->qid;				}
	public function getAnswer() 							{ return $this->answer;				}
	public function getMark() 								{ return $this->mark;				}
	
	public function setStudentDtID($studentdtid)			{ $this->studentdtid		= $studentdtid;		}
	public function setQid($qid)							{ $this->qid				= $qid;				}
	public function setAnswer($answer)						{ $this->answer				= $answer;			}
	public function setMark($mark)							{ $this->mark				= $mark;			}
}
?>