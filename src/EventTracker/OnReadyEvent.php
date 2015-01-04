<?php

namespace Notable\GaTrackerGen\EventTracker;

use Notable\GaTrackerGen\SetTimeoutBuilder;
use Notable\GaTrackerGen\GeneratesScriptInterface;
use Notable\GaTrackerGen\Tools\CreateToken;

/**
 * Class OnReadyEvent
 * @package Notable\GaTrackerGen\EventTracker
 */
class OnReadyEvent extends SendOnEventAbstract implements GeneratesScriptInterface
{
	
	/**
	 * @var integer
	 */
	private $_attempts;
	
	/**
	 * @var SetTimeoutBuilder
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
		$TokenCreator = new CreateToken();
		$token = $TokenCreator->getToken(10);
		$this->_js_function_name = "yuyangongfu_$token";

		/* Set default timeout settings */
		$this->_SetTimeoutBuilder = new SetTimeoutBuilder();
		$callback = "$this->_js_function_name(counter);";
		$this->_SetTimeoutBuilder
		->setCallback($callback)
		->setDuration(100);
		
		/* Set default times to recursively attempt call */
		$this->_attempts = 50;		
	}

	/**
	 * @return string
	 * @throws \Exception
     */
	public function getScript()
	{
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
	 * @param int $number
	 * @return $this
	 */
	public function setDuration($number)
	{
		$this->_SetTimeoutBuilder->setDuration($number);
		return $this;
	}
	
	/**
	 * @param integer $number
	 * @return $this
	 * @throws \Exception
	 */
	public function setAttempts($number)
	{
		if (!is_numeric($number)){
			$type = gettype($number);
			throw new \Exception("Param must be of type 'numeric', '$type' provided");
		}
		$this->_attempts = $number;
		return $this;
	}
	
}