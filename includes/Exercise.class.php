<?php
/**
 * Exercise object
 * Created by: Raina Gamboa
 */
class Exercise {
	private $exid		= null;
	private $moduleid	= null;
	private $title		= null;
	private $extype		= null;
	private $shortcode	= null;
	private $screenshot	= null;

	public function __construct() {}
	
	public function getExid() 							{ return $this->exid;		}	
	public function getModuleid() 						{ return $this->moduleid;	}	
	public function getTitle() 							{ return $this->title;		}	
	public function getExtype() 						{ return $this->extype;		}
	public function getShortcode() 						{ return $this->shortcode;		}
	public function getScreenshot() 					{ return $this->screenshot;		}
	
	public function setExid($exid) 						{ $this->exid 			= $exid;			}
	public function setModuleid($moduleid) 				{ $this->moduleid		= $moduleid;		}
	public function setTitle($title) 					{ $this->title	 		= $title;			}
	public function setExtype($extype) 					{ $this->extype 		= $extype;			}
	public function setShortcode($shortcode) 			{ $this->shortcode 		= $shortcode;		}
	public function setScreenshot($screenshot) 			{ $this->screenshot		= $screenshot;		}		
}
?>