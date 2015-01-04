<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

interface OnEventCollectionInterface {
	
	/**
	 * @param array $array
	 */
	function push(array $array);
	
	/**
	 * @return array
	 */
	function get();
	
}