<?php

namespace Yuyangongfu\Library\Frontend\Javascript;

use Yuyangongfu\Library\Frontend\Javascript\GeneratesScriptInterface,
Yuyangongfu\Library\Frontend\Javascript\HasCallbackInterface;

class SetTimeoutBuilder implements GeneratesScriptInterface, HasCallbackInterface 
{
	
	private $_callback;
	
	private $_is_callback_closure;
	
	private $_duration;
	
	public function __construct()
	{		
		$this->_is_callback_closure = TRUE;		
	}
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\GeneratesScriptInterface::getScript()
	 */
	public function getScript() 
	{		
		if ($this->_callback == '' || $this->_duration == ''){			
			return FALSE;			
		}
		
		$rs = '';
		
		if ($this->_is_callback_closure === TRUE){			
			$rs .= "setTimeout(function(){";			
				$rs .= $this->_callback;				
			$rs .= "}, $this->_duration);";			
		}
		else{			
			$rs .= "setTimeout($this->_callback, $this->_duration);";			
		}
		
		return $rs;		
	}
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\HasCallbackInterface::setCallback()
	 */
	public function setCallback($string) 
	{
		$this->_callback = $string;		
		return $this;		
	}

	/**
	 * @see \Yuyangongfu\Helpers\Javascript\HasCallbackInterface::setCallbackIsClosure()
	 */
	public function setCallbackIsClosure($bool)
	{		
		$this->_is_callback_closure = $bool;		
		return $this;		
	}
	
	/**
	 * @param integer $number
	 * @return boolean|\Yuyangongfu\Helpers\Javascript\SetTimeoutBuilder
	 */
	public function setDuration($number)
	{		
		if (!is_numeric($number)){			
			return FALSE;			
		}		
		$this->_duration = $number;		
		return $this;		
	}
	
}