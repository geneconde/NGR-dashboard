<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class DtChoices {
	private $qid		= null;
	private $choice		= null;
	private $image		= null;
	private $order		= null;

	public function __construct() {}
	
	public function getQid() 					{ return $this->qid;	}	
	public function getChoice() 				{ return $this->choice;	}	
	public function getImage() 					{ return $this->image;	}	
	public function getOrder() 					{ return $this->order;	}

	public function setQid($qid)				{ $this->qid		= $qid;		}
	public function setChoice($choice) 			{ $this->choice 	= $choice;	}
	public function setImage($image) 			{ $this->image 		= $image;	}
	public function setOrder($order)			{ $this->order		= $order;	}
}
?>