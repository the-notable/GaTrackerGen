<?php

namespace Notable\GaTrackerGen;

/**
 * Interface GeneratesScriptInterface
 * @package Notable\GaTrackerGen
 */
interface GeneratesScriptInterface
{
	
	/**
	 * Returns javascript code as a string
	 * 
	 * @return string
	 */
	public function getScript();
	
}