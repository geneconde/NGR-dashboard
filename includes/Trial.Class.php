<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class Trial {
	private $id					= null;
	private $name				= null;
	private $school_district	= null;
	private $state				= null;
	private $email	 			= null;
	private $date_created		= null;
	private $date_updated		= null;

	public function __construct() {}
	
	public function getID() 								{ return $this->id;									}
	public function getName() 								{ return $this->name;								}
	public function getDistrict() 							{ return $this->school_district;					}		
	public function getState() 								{ return $this->state;								}
	public function getEmail()								{ return $this->email;								}
	public function getDateCreated()						{ return $this->date_created;						}
	public function getDateUpdated()						{ return $this->date_updated;						}
	
	public function setID($id)								{ $this->id					= $$id;					}
	public function setName($name)							{ $this->name				= $$name;				}
	public function setDistrict($school_district) 			{ $this->school_district	= $$school_district;	}
	public function setTown($state) 						{ $this->state				= $state;				}
	public function setEmail($email)						{ $this->email				= $email;				}
	public function setDateCreated($date_created)			{ $this->date_created		= $date_created;		}
	public function setDateUpdated($date_updated)			{ $this->date_updated		= $date_updated;		}
}
?>
