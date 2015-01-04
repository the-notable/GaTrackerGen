<?php

namespace Notable\GaTrackerGen\EventTracker;

/**
 * Class OnReadyCollection
 * @package Notable\GaTrackerGen\EventTracker
 */
class OnReadyCollection extends OnEventCollectionAbstract
{
	
	/**
	 * @var OnReadyEvent
	 */
	private $_OnReadyEvent;
	
	public function __construct()
	{
		parent::__construct();
		$this->_OnReadyEvent = new OnReadyEvent();
	}
	
	/**
	 * @return array 
	 */
	public function get()
	{
		$return_array = array();
		foreach($this->_ind_events_array as $event_array){
			$this->_OnReadyEvent = $this->_returnCommonElements($event_array, $this->_OnListenerEvent);
			if (isset($event_array['duration'])){
				$this->_OnReadyEvent->setDuraction($event_array['duration']);
			}
			if (isset($event_array['attempts'])){
				$this->_OnReadyEvent->setAttempts($event_array['attempts']);
			}
			$return_array[] = $this->_OnReadyEvent->getScript();
		}
		return $return_array;
	}
	
}