<?php
/**
 * Language object
 * Created by: Raina Gamboa
 */
class Language {
	private $language_id		= null;
	private $language_code		= null;
	private $language           = null;
	private $shortcode          = null;

	public function __construct() {}
	
	public function getLanguage_id() 						{ return $this->language_id;						}
	public function getLanguage_code() 						{ return $this->language_code;						}
	public function getLanguage() 							{ return $this->language;							}
	public function getShortcode() 							{ return $this->shortcode;							}
	
	public function setLanguage_id($language_id)			{ $this->language_id			= $language_id;			}
	public function setLanguage_code($language_code)		{ $this->language_code			= $language_code;		}
	public function setLanguage($language)					{ $this->language				= $language;			}
	public function setShortcode($shortcode)				{ $this->shortcode				= $shortcode;			}
}

class TeacherLanguage {
	private $teacher_id				= null;
	private $language_id			= null;
	private $is_default				= null;

	public function __construct() {}
	
	public function getTeacher_id() 						{ return $this->teacher_id;							}
	public function getLanguage_id() 						{ return $this->language_id;						}
	public function getIs_default() 							{ return $this->is_default;							}
	
	public function setTeacher_id($teacher_id)				{ $this->teacher_id				= $teacher_id;		}
	public function setLanguage_id($language_id)			{ $this->language_id			= $language_id;		}
	public function setIs_default($is_default)				{ $this->is_default				= $is_default;		}
}


?>
