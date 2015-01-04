<?php

namespace Notable\GaTrackerGen;

/**
 * Class SetTimeoutBuilder
 * @package Notable\GaTrackerGen
 */
class SetTimeoutBuilder implements GeneratesScriptInterface, HasCallbackInterface
{

	/**
	 * @var string
     */
	private $_callback;

	/**
	 * @var bool
     */
	private $_is_callback_closure;

	/**
	 * @var int
     */
	private $_duration;
	
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
		if ($this->_callback == '' || $this->_duration == ''){			
			throw new \Exception('Callback and Duration must both be set before script can be generated');
		}
		
		$rs = '';
		if ($this->_is_callback_closure === true){
			$rs .= "setTimeout(function(){";			
				$rs .= $this->_callback;				
			$rs .= "}, $this->_duration);";			
		} else {
			$rs .= "setTimeout($this->_callback, $this->_duration);";			
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
	
	/**
	 * @param int $number
	 * @return $this
	 * @throws \Exception
	 */
	public function setDuration($number)
	{		
		if (!is_numeric($number)){
			$type = gettype($number);
			throw new \Exception("Param must be of type 'numeric', '$type' provided");
		}		
		$this->_duration = $number;		
		return $this;		
	}
	
}