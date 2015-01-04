<?php

namespace Notable\GaTrackerGen\Jquery;

use Notable\GaTrackerGen\HasCallbackInterface,
	Notable\GaTrackerGen\GeneratesScriptInterface;

/**
 * Generates jquery listener code
 * 
 * By default callback is generated as an anonymous
 * function. Using setter _callback_is_closure can
 * be set to false which will cause callback to be
 * set as javascript function object name.
 * 
 * Namespace is optional, and if not set will not
 * be included.
 * 
 * @author Daniel
 */
class ListenerBuilder implements HasCallbackInterface, GeneratesScriptInterface 
{
	
	/**
	 * @var string
	 */
	private $_dom_element;
	
	/**
	 * @var string
	 */
	private $_namespace;
	
	/**
	 * @var string
	 */
	private $_event_type;
	
	/**
	 * @var string
	 */
	private $_callback;
	
	/**
	 * @var boolean
	 */
	private $_callback_is_closure;
	
	public function __construct()
	{	
		$this->_callback_is_closure = true;
	}
	
	/**
	 * Returns javascript code as a string
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function getScript()
	{	
		/* These are all required */
		if ($this->_dom_element == '' || $this->_event_type == '' || $this->_callback == ''){
			throw new \Exception('All required properties must be set before script can be generated');
		}
	
		$selector = $this->_buildSelector($this->_dom_element);
		if ($this->_namespace > ''){
			$event_string = "$this->_event_type.$this->_namespace";			
		} else{			
			$event_string = $this->_event_type;			
		}
	
		$callback = $this->_callback;
	
		$rs = '';
		if ($this->_callback_is_closure === true){
			$rs .= $selector.".on('".$event_string."', function(){";
				$rs .= $callback;				
			$rs .= "});";			
		}
		else{			
			$rs .= "$selector.on('$event_string', $callback);";			
		}
	
		return $rs;	
	}
	
	/**
	 * @param string $element
	 * @return $this
	 */
	public function setDomElement($element)
	{	
		$this->_dom_element = $element;	
		return $this;	
	}
	
	/**
	 * @param string $namespace
	 * @return $this
	 */
	public function setNamespace($namespace)
	{				
		$this->_namespace = $namespace;			
		return $this;	
	}
	
	/**
	 * @param string $type
	 * @return $this
	 */
	public function setEventType($type)
	{	
		$this->_event_type = $type;	
		return $this;	
	}

	/**
	 * @param string $callback
	 * @return $this
     */
	public function setCallback($callback)
	{		
		$this->_callback = $callback;		
		return $this;		
	}

	/**
	 * @param bool $bool
	 * @return $this
     */
	public function setCallbackIsClosure($bool)
	{		
		$this->_callback_is_closure = $bool;		
		return $this;		
	}
	
	/**
	 * @param string $element
	 * @return string
	 */
	private function _buildSelector($element)
	{	
		return '$('."'$element')";	
	}
	
}