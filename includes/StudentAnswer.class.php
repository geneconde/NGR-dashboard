<?php
/**
 * StudentAnswer object
 * Created by: Raina Gamboa
 */
class StudentAnswer {
	private $student_module_id	= null;
	private $question_id		= null;
	private $student_answer		= null;

	public function __construct() {}
	
	public function getStudentModule_id() 				{ return $this->student_moduleid;	}	
	public function getQuestion_id() 					{ return $this->question_id;		}	
	public function getStudentAnswer() 					{ return $this->student_answer;		}
	
	public function setStudentModule_id($student_module_id) 	{ $this->student_moduleid	= $student_module_id;	}
	public function setQuestion_id($question_id) 				{ $this->question_id 		= $question_id;			}
	public function setStudentAnswer($student_answer) 			{ $this->student_answer		= $student_answer;		}	
}
?>