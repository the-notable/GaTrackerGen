<?php

namespace Notable\GaTrackerGen\EventTracker;

/**
 * Class OnListenerCollection
 * @package Notable\GaTrackerGen\EventTracker
 */
class OnListenerCollection extends OnEventCollectionAbstract
{
	
	/**
	 * @var OnListenerEvent
	 */
	private $_OnListenerEvent;
	
	public function __construct()
	{
		parent::__construct();
		$this->_OnListenerEvent = new OnListenerEvent();
	}
	
	/**
	 * @return array 
	 */
	public function get()
	{
		$return_array = array();
		foreach($this->_ind_events_array as $event_array){
			$this->_OnListenerEvent = $this->_returnCommonElements($event_array, $this->_OnListenerEvent);
			if (isset($event_array['dom_element'])){
				$this->_OnListenerEvent->setDomElement($event_array['dom_element']);
			}
			if (isset($event_array['event_type'])){
				$this->_OnListenerEvent->setEventType($event_array['event_type']);
			}
			$return_array[] = $this->_OnListenerEvent->getScript();
		}
		return $return_array;
	}
	
}