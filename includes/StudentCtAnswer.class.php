<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class StudentCtAnswer {
	private $studentctid		= null;
	private $qid				= null;
	private $answer 			= null;
	private $mark				= null;

	public function __construct() {}
		
	public function getStudentCtID() 						{ return $this->studentctid;		}		
	public function getQid() 								{ return $this->qid;				}
	public function getAnswer() 							{ return $this->answer;				}
	public function getMark() 								{ return $this->mark;				}
	
	public function setStudentCtID($studentctid)			{ $this->studentctid		= $studentctid;		}
	public function setQid($qid)							{ $this->qid				= $qid;				}
	public function setAnswer($answer)						{ $this->answer				= $answer;			}
	public function setMark($mark)							{ $this->mark				= $mark;			}
}
?>