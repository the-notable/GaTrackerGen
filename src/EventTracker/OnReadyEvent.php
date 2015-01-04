<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\SetTimeoutBuilder,
Yuyangongfu\Library\Frontend\Javascript\GeneratesScriptInterface;

class OnReadyEvent extends SendOnEventAbstract implements GeneratesScriptInterface {
	
	/**
	 * @var integer
	 */
	private $_attempts;
	
	/**
	 * @var Yuyangongfu\Helpers\Javascript\SetTimeoutBuilder
	 */
	private $_SetTimeoutBuilder;
	
	/**
	 * @var string
	 */
	private $_js_function_name;
	
	public function __construct()
	{		
		parent::__construct();
		/* Create a random name for the recursive javascript function */
		$CryptoRandGen = $this->di->get('CryptoRandGen');
		
		$TokenCreator = $this->di->get('CreateToken', array($CryptoRandGen));
		
		$token = $TokenCreator->getToken(10);
		
		$this->_js_function_name = "yuyangongfu_$token";
		
		/* Set default timeout settings */
		$this->_setSetTimeoutBuilder($this->di->get('SetTimeoutBuilder'));
		
		$callback = "$this->_js_function_name(counter);";
		
		$this->_SetTimeoutBuilder
		->setCallback($callback)
		->setDuration(100);
		
		/* Set default times to recursivly attempt call */
		$this->_attempts = 50;		
	}
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\GeneratesScriptInterface::getScript()
	 */
	public function getScript(){
		
		$event_code = $this->_EventTrackerBuilder->getScript();
		
		$timeout_code = $this->_SetTimeoutBuilder->getScript();
		
		$rs = '';
		
		$rs .= "var $this->_js_function_name = function(counter){
					
					if(typeof ga !== 'undefined'){
						$event_code
					} else if (counter < $this->_attempts){
						counter++;
						return $timeout_code
					} else {
						console.log('ga not found');					
					}
					
				};
				
				$this->_js_function_name(0);
		";
		
		return $this->_DocReadyBuilder
		->setCallback($rs)
		->getScript();
		
	}
	
	/**
	 * @param integer $number
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\OnReadyEvent
	 */
	public function setDuration($number){
		
		$this->_SetTimeoutBuilder->setDuration($number);
		
		return $this;
		
	}
	
	/**
	 * @param integer $number
	 * @return boolean|\Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\OnReadyEvent
	 */
	public function setAttempts($number){
	
		if (!is_numeric($number)){
				
			return FALSE;
				
		}
	
		$this->_attempts = $number;
	
		return $this;
	
	}
	
	/**
	 * @param SetTimeoutBuilder $SetTimeoutBuilder
	 */
	private function _setSetTimeoutBuilder(SetTimeoutBuilder $SetTimeoutBuilder){
		
		$this->_SetTimeoutBuilder = $SetTimeoutBuilder;		
		
	}
	
}