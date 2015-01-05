<?php

namespace Notable\GaTrackerGen\EventTracker;

/**
 * Interface OnEventCollectionInterface
 * @package Notable\GaTrackerGen\EventTracker
 */
interface OnEventCollectionInterface
{
	
	/**
	 * @param array $array
	 */
	function pushEventSettings(array $array);
	
	/**
	 * @return array
	 */
	function getArrayOfScripts();
	
}