<?php

namespace Yuyangongfu\Library\Frontend\Javascript;

interface HasCallbackInterface {
	
	/**
	 * @param boolean $bool
	 */
	public function setCallbackIsClosure($bool);
	
	/**
	 * @param string $string
	 */
	public function setCallback($string);
	
}