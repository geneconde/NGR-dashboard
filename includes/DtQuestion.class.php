<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class DtQuestion {
	private $qid			= null;
	private $moduleid		= null;
	private $type			= null;
	private $question		= null;
	private $answer			= null;
	private $image			= null;
	private $from_review	= null;

	public function __construct() {}
	
	public function getQid() 							{ return $this->qid;			}	
	public function getModuleid() 						{ return $this->moduleid;		}	
	public function getType() 							{ return $this->type;			}	
	public function getQuestion() 						{ return $this->question;		}
	public function getAnswer() 						{ return $this->answer;			}
	public function getImage() 							{ return $this->image;			}
	public function getFromReview()						{ return $this->from_review;	}

	public function setQid($qid)						{ $this->qid			= $qid;			}
	public function setModuleid($moduleid) 				{ $this->moduleid 		= $moduleid;	}
	public function setType($type) 						{ $this->type 			= $type;		}
	public function setQuestion($question)				{ $this->question		= $question;	}
	public function setAnswer($answer)					{ $this->answer			= $answer;		}
	public function setImage($image)					{ $this->image			= $image;		}
	public function setFromReview($from_review)			{ $this->from_review	= $from_review;	}
}
?>