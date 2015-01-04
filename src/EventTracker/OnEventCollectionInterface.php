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
	function push(array $array);
	
	/**
	 * @return array
	 */
	function get();
	
}