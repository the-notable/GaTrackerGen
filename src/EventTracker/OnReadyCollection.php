<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker\OnReadyEvent;

class OnReadyCollection extends OnEventCollectionAbstract {
	
	/**
	 * @var Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\OnReadyEvent
	 */
	private $_OnReadyEvent;
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	/**
	 * @return array 
	 */
	public function get(){
		
		$return_array = array();
		
		$this->_setOnReadyEvent($this->di->get('GaOnReadyEventBuilder'));
		
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
	
	/**
	 * @param OnReadyEvent $OnReadyEvent
	 */
	private function _setOnReadyEvent(OnReadyEvent $OnReadyEvent){
		
		$this->_OnReadyEvent = $OnReadyEvent;
		
	}
	
}