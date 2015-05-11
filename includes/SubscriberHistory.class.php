<?php
/**
 * Module object
 * Created by: Raina Gamboa
 */
class SubscriberHistory {
	private $record_id					= null;
	private $purchase_id				= null;
	private $subscriber_id				= null;
	private $date_paid					= null;
	private $date_created				= null;
	private $date_modified	 			= null;
	private $subscriber_option			= null;
	private $amount_paid				= null;
	private $type						= null;

	public function __construct() {}
	
	public function getRecordId() 								{ return $this->record_id;									}
	public function getPurchaseId() 							{ return $this->purchase_id;								}
	public function getSubscriberId() 							{ return $this->subscriber_id;								}
	public function getDatePaid() 								{ return $this->date_paid;									}
	public function getDateCreated() 							{ return $this->date_created;								}
	public function getDateModified()							{ return $this->date_modified;								}
	public function getSubscriberOption()						{ return $this->subscriber_option;							}
	public function getAmountPaid()								{ return $this->amount_paid;								}
	public function getType()									{ return $this->type;										}
	
	public function setRecordId($record_id)						{ $this->record_id					= $record_id;			}
	public function setPurchaseId($purchase_id)					{ $this->purchase_id				= $purchase_id;			}
	public function setSubscriberId($subscriber_id)				{ $this->subscriber_id				= $subscriber_id;		}
	public function setDatePaid($date_paid) 					{ $this->date_paid					= $date_paid;			}
	public function setDateCreated($date_created) 				{ $this->date_created				= $date_created;		}
	public function setDateModified($date_modified)				{ $this->date_modified				= $date_modified;		}
	public function setSubscriberOption($subscriber_option)		{ $this->subscriber_option			= $subscriber_option;	}
	public function setAmountPaid($amount_paid)					{ $this->amount_paid				= $amount_paid;			}
	public function setType($type)								{ $this->type						= $type;				}

}

?>
