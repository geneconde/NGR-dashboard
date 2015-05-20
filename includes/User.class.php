<?php
/**
 * User object
 * Created by: Raina Gamboa
 */
class User {
	private $userid				= null;
	private $username 			= null;
	private $password 			= null;
	private $firstname 			= null;
	private $lastname 			= null;
	private $gender 			= null;
	private $type 				= null;
	private $teacher			= null;
	private $subscriber			= null;
	private $subhead_id			= null;
	private $grade_level		= null;
	private $students_limit		= null;

	public function __construct() {}
	
	public function getUserid() 						{ return $this->userid;			}	
	public function getUsername() 						{ return $this->username;		}	
	public function getPassword() 						{ return $this->password;		}
	public function getFirstname() 						{ return $this->firstname;		}
	public function getLastname() 						{ return $this->lastname;		}
	public function getGender()							{ return $this->gender;			}
	public function getType()							{ return $this->type;			}
	public function getTeacher()						{ return $this->teacher;		}
	public function getSubscriber()						{ return $this->subscriber;		}
	public function getSubheadid()						{ return $this->subhead_id;		}
	public function getGrade_level()					{ return $this->grade_level;	}
	public function getStudents_limit()					{ return $this->students_limit;	}
	
	public function setUserid($userid) 					{ $this->userid 			= $userid;				}
	public function setUsername($username) 				{ $this->username 			= $username;			}
	public function setPassword($password) 				{ $this->password 			= $password;			}
	public function setFirstname($firstname) 			{ $this->firstname 			= $firstname;			}
	public function setLastname($lastname) 				{ $this->lastname 			= $lastname;			}
	public function setGender($gender) 					{ $this->gender 			= $gender;				}
	public function setType($type) 						{ $this->type 				= $type;				}
	public function setTeacher($teacher) 				{ $this->teacher 			= $teacher;				}
	public function setSubscriber($subscriber) 			{ $this->subscriber 		= $subscriber;			}
	public function setSubheadid($subhead_id) 			{ $this->subhead_id 		= $subhead_id;			}
	public function setGrade_level($grade_level) 		{ $this->grade_level 		= $grade_level;			}
	public function setStudents_limit($students_limit) 	{ $this->students_limit 	= $students_limit;		}
}
?>