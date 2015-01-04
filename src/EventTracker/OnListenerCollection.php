<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker\OnListenerEvent;

class OnListenerCollection extends OnEventCollectionAbstract {
	
	/**
	 * @var \Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker\OnListenerEvent
	 */
	private $_OnListenerEvent;
	
	public function __construct(){
		
		parent::__construct();
		
	}
	
	/**
	 * @return array 
	 */
	public function get(){
		
		$return_array = array();
		
		$this->_setOnListenerEvent($this->di->get('GaOnListenerEventBuilder'));
		
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
	
	/**
	 * @param OnListenerEvent $OnListenerEvent
	 */
	private function _setOnListenerEvent(OnListenerEvent $OnListenerEvent){
		
		$this->_OnListenerEvent = $OnListenerEvent;
		
	}
	
}