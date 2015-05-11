<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class Subscriber {
	private $id					= null;
	private $fname				= null;
	private $lname				= null;
	private $school_district	= null;
	private $state				= null;
	private $email	 			= null;
	private $teachers			= null;
	private $students			= null;
	private $subscription		= null;
	private $notes				= null;
	private $date_created		= null;
	private $date_updated		= null;
	private $active				= null;

	public function __construct() {}
	
	public function getID() 								{ return $this->id;									}
	public function getFirstName() 							{ return $this->fname;								}
	public function getLastName() 							{ return $this->lname;								}
	public function getDistrict() 							{ return $this->school_district;					}
	public function getState() 								{ return $this->state;								}
	public function getEmail()								{ return $this->email;								}
	public function getTeachers()							{ return $this->teachers;							}
	public function getStudents()							{ return $this->students;							}
	public function getSubscription()						{ return $this->subscription;						}
	public function getNotes()								{ return $this->notes;								}
	public function getDateCreated()						{ return $this->date_created;						}
	public function getDateUpdated()						{ return $this->date_updated;						}
	public function getActive()								{ return $this->active;								}
	
	public function setID($id)								{ $this->id					= $id;					}
	public function setFirstName($fname)					{ $this->fname				= $fname;				}
	public function setLastName($lname)						{ $this->lname				= $lname;				}
	public function setDistrict($school_district) 			{ $this->school_district	= $school_district;		}
	public function setTown($state) 						{ $this->state				= $state;				}
	public function setEmail($email)						{ $this->email				= $email;				}
	public function setTeachers($teachers)					{ $this->teachers			= $teachers;			}
	public function setStudents($students)					{ $this->students			= $students;			}
	public function setSubscription($subscription)			{ $this->subscription		= $subscription;		}
	public function setNotes($notes)						{ $this->notes				= $notes;				}
	public function setDateCreated($date_created)			{ $this->date_created		= $date_created;		}
	public function setDateUpdated($date_updated)			{ $this->date_updated		= $date_updated;		}
	public function setActive($active)						{ $this->active				= $active;				}
}
?>
