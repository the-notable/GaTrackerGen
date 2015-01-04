<?php

namespace Yuyangongfu\Library\Frontend\Javascript\Jquery;

use Yuyangongfu\Library\Frontend\Javascript\HasCallbackInterface,
Yuyangongfu\Library\Frontend\Javascript\GeneratesScriptInterface;

class DocReadyBuilder implements HasCallbackInterface, GeneratesScriptInterface {
	
	/**
	 * @var boolean
	 */
	private $_is_callback_closure;
	
	private $_callback;
	
	public function __construct(){
		
		$this->_is_callback_closure = TRUE;
		
	}
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\GeneratesScriptInterface::getScript()
	 */
	public function getScript() {
		
		if (!isset($this->_callback)){
			
			return FALSE;
			
		}
		
		$rs = '';
		
		if ($this->_is_callback_closure === TRUE){
			
			$rs .= '$(document).ready(function(){';
		
				$rs .= $this->_callback;
				
			$rs .= "});";
			
		}
		else{
			
			$rs .= "$(document).ready($this->_callback)";
			
		}
		
		return $rs;

	}
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\HasCallbackInterface::setCallback()
	 */
	public function setCallback($string) {
		
		$this->_callback = $string;
		
		return $this;

	}


	/**
	 * @see \Yuyangongfu\Helpers\Javascript\HasCallbackInterface::setCallbackIsClosure()
	 */
	public function setCallbackIsClosure($bool){
		
		$this->_is_callback_closure = $bool;
		
		return $this;
		
	}
	
}