<?php

namespace Notable\GaTrackerGen;

/**
 * Interface HasCallbackInterface
 * @package Notable\GaTrackerGen
 */
interface HasCallbackInterface
{
	
	/**
	 * @param boolean $bool
	 */
	public function setCallbackIsClosure($bool);
	
	/**
	 * @param string $string
	 */
	public function setCallback($string);
	
}