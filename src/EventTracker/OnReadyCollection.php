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

	/**
	 * @param array $multiple_event_settings
     */
	public function __construct(array $multiple_event_settings = array())
	{
		parent::__construct($multiple_event_settings);
		$this->_OnReadyEvent = new OnReadyEvent();
	}
	
	/**
	 * @return array 
	 */
	public function getArrayOfScripts()
	{
		$return_array = array();
		foreach($this->_ind_events_array as $event_array){
			$this->_OnReadyEvent = $this->_returnCommonElements($event_array, $this->_OnReadyEvent);
			if (isset($event_array['duration'])){
				$this->_OnReadyEvent->setDuration($event_array['duration']);
			}
			if (isset($event_array['attempts'])){
				$this->_OnReadyEvent->setAttempts($event_array['attempts']);
			}
			$return_array[] = $this->_OnReadyEvent->getScript();
		}
		return $return_array;
	}
	
}