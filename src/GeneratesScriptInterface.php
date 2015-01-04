<?php

namespace Yuyangongfu\Library\Frontend\Javascript;

interface GeneratesScriptInterface {
	
	/**
	 * Returns javascript code as a string
	 * 
	 * @return string
	 */
	public function getScript();
	
}