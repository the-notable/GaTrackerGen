<?php

namespace Notable\GaTrackerGen\Jquery;

use Notable\GaTrackerGen\HasCallbackInterface;
use Notable\GaTrackerGen\GeneratesScriptInterface;

/**
 * Class DocReadyBuilder
 * @package Notable\GaTrackerGen\Jquery
 */
class DocReadyBuilder implements HasCallbackInterface, GeneratesScriptInterface
{
	
	/**
	 * @var boolean
	 */
	private $_is_callback_closure;

	/**
	 * @var string
     */
	private $_callback;
	
	public function __construct()
	{
		$this->_is_callback_closure = true;
	}

	/**
	 * @return string
	 * @throws \Exception
     */
	public function getScript()
	{
		if (!isset($this->_callback)){
			throw new \Exception('Callback must be set before script can be generated');
		}
		
		$rs = '';
		if ($this->_is_callback_closure === true){
			$rs .= '$(document).ready(function(){';
				$rs .= $this->_callback;
			$rs .= "});";
		} else {
			$rs .= "$(document).ready($this->_callback)";
		}
		return $rs;
	}

	/**
	 * @param string $string
	 * @return $this
     */
	public function setCallback($string)
	{
		$this->_callback = $string;
		return $this;
	}

	/**
	 * @param bool $bool
	 * @return $this
     */
	public function setCallbackIsClosure($bool)
	{
		$this->_is_callback_closure = $bool;
		return $this;
	}
	
}