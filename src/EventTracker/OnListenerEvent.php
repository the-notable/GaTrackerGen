<?php

namespace Notable\GaTrackerGen\EventTracker;

use Notable\GaTrackerGen\Jquery\ListenerBuilder;
use Notable\GaTrackerGen\GeneratesScriptInterface;

class OnListenerEvent extends SendOnEventAbstract implements GeneratesScriptInterface 
{
		
	/**
	 * @var ListenerBuilder
	 */
	private $_ListenerBuilder;

	/**
	 * @param array $settings
     */
	public function __construct(array $settings = array())
	{		
		parent::__construct($settings);
		$this->_ListenerBuilder = new ListenerBuilder();
		$this->_ListenerBuilder->setNamespace('gaeventtracking');
		if(count($settings)){
			if(isset($settings['dom_element'])){
				$this->setDomElement($settings['dom_element']);
			}
			if(isset($settings['event_type'])){
				$this->setEventType($settings['event_type']);
			}
		}
	}

	/**
	 * @return bool|string
	 * @throws \Exception
     */
	public function getScript()
	{		
		$event_code = $this->_EventTrackerBuilder->getScript();
		
		if ($event_code){			
			$listener_code = $this->_ListenerBuilder
			->setCallback($event_code)
			->getScript();			
			if ($listener_code){				
				return $this->_DocReadyBuilder
				->setCallback($listener_code)
				->getScript();				
			}			
		}
		
		return false;
	}
	
	/**
	 * @param string $element
	 * @return $this
	 */
	public function setDomElement($element)
	{		
		$this->_ListenerBuilder->setDomElement($element);		
		return $this;		
	}
	
	/**
	 * This refers to the jquery on event type (click, mouseover, etc)
	 *
	 * @param string $type
	 * @return $this
	 */
	public function setEventType($type)
	{	
		$this->_ListenerBuilder->setEventType($type);	
		return $this;	
	}
	
}