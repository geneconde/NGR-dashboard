<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class CumulativeTest {
	private $fid				= null;
	private $exerciseid			= null;
	private $section			= null;
	private $choice				= null;
	private $feedback			= null;

	public function __construct() {}
	
	public function getFID() 								{ return $this->fid;							}
	public function getExerciseID() 						{ return $this->exerciseid;						}
	public function getSection() 							{ return $this->section;						}
	public function getChoice() 							{ return $this->choice;							}
	public function getFeedback() 							{ return $this->feedback;						}		
	
	public function setFID($fid)							{ $this->fid				= $fid;				}
	public function setExerciseID($exerciseid)				{ $this->exerciseid			= $exerciseid;		}
	public function setSection($section)					{ $this->section			= $section;			}
	public function setChoice($choice)						{ $this->choice				= $choice;			}
	public function setFeedback($feedback)					{ $this->feedback			= $feedback;		}

}
?>
