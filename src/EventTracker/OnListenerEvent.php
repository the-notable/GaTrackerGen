<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\Jquery\ListenerBuilder,
Yuyangongfu\Library\Frontend\Javascript\GeneratesScriptInterface;

class OnListenerEvent extends SendOnEventAbstract implements GeneratesScriptInterface 
{
		
	/**
	 * @var \Yuyangongfu\Library\Frontend\Javascript\Jquery\ListenerBuilder
	 */
	private $_ListenerBuilder;
	
	public function __construct(ListenerBuilder $JqueryListenerBuilder)
	{		
		parent::__construct();		
		$this->_setListenerBuilder($JqueryListenerBuilder);
		$this->_ListenerBuilder->setNamespace('gaeventtracking');		
	}	
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\GeneratesScriptInterface::getScript()
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
		
		return FALSE;
	}
	
	/**
	 * @param string $element
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\OnListenerEventCode
	 */
	public function setDomElement($element)
	{		
		$this->_ListenerBuilder->setDomElement($element);		
		return $this;		
	}
	
	/**
	 * @param string $type
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\OnListenerEventCode
	 */
	public function setEventType($type)
	{	
		$this->_ListenerBuilder->setEventType($type);	
		return $this;	
	}
	
	/**
	 * @param ListenerBuilder $ListenerBuilder
	 */
	private function _setListenerBuilder(ListenerBuilder $ListenerBuilder)
	{		
		$this->_ListenerBuilder = $ListenerBuilder;		
	}
	
}