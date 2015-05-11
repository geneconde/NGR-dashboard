<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class GroupModule {
	private $groupid		= null;
	private $moduleid		= null;
	private $pretestid		= null;
	private $posttestid		= null;
	private $activereview	= null;
	private $activepre		= null;
	private $activepost		= null;

	public function __construct() {}
	
	public function getGroupID() 				{ return $this->groupid;		}	
	public function getModuleID() 				{ return $this->moduleid;		}	
	public function getPretestID() 				{ return $this->pretestid;		}	
	public function getPosttestID() 			{ return $this->posttestid;		}
	public function getActiveReview() 			{ return $this->activereview;	}
	public function getActivePre() 				{ return $this->activepre;		}
	public function getActivePost() 			{ return $this->activepost;		}

	public function setGroupID($groupid) 				{ $this->groupid		= $groupid;			}	
	public function setModuleID($moduleid) 				{ $this->moduleid		= $pretestid;		}	
	public function setPretestID($pretestid) 			{ $this->pretestid		= $pretestid;		}	
	public function setPosttestID($posttestid) 			{ $this->posttestid		= $posttestid;		}
	public function setActiveReview($activereview) 		{ $this->activereview	= $activereview;	}
	public function setActivePre($activepre) 			{ $this->activepre		= $activepre;		}
	public function setActivePost($activepost) 			{ $this->activepost		= $activepost;		}
}
?>