<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics;

use Yuyangongfu\Library\Frontend\Javascript\GeneratesScriptInterface,
Yuyangongfu\Library\Frontend\Javascript\Jquery\DocReadyBuilder,
Phalcon\DI\Injectable;
use Phalcon\Config;

class UniversalAnalytics extends Injectable implements GeneratesScriptInterface
{
	
	private $_ua_id;
	
	/**
	 * @var Yuyangongfu\Helpers\Javascript\Jquery\DocReadyBuilder
	 */
	private $_DocReadyBuilder;
		
	/**
	 * @param DocReadyBuilder $DocReadyBuilder
	 * @param Config $ga_settings
	 */
	public function __construct(DocReadyBuilder $DocReadyBuilder, $ga_settings)
	{		
		$this->_ua_id = $ga_settings->tracking_id;				
		$this->_setDocReadyBuilder($DocReadyBuilder);			
	}
	
	/**
	 * @see \Yuyangongfu\Helpers\Javascript\GeneratesScriptInterface::getScript()
	 */
	public function getScript() 
	{		
		$create_str = $this->_getCreateString();		
		return "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

$create_str
ga('require', 'linkid', 'linkid.js'); // Enables enhanced link attribution
ga('require', 'displayfeatures'); // Enables display advertising support
ga('send', 'pageview');";
	}

	/**
	 * @return string
	 */
	private function _getCreateString()
	{		
		if(($user_id = $this->CurrentUser->getId()) != FALSE){			
			return "ga('create', '$this->_ua_id', { 'userId': '$user_id' });";			
		}		
		return "ga('create', '$this->_ua_id', 'auto');";		
	}
	
	/**
	 * @param DocReadyBuilder $DocReadyBuilder
	 */
	private function _setDocReadyBuilder(DocReadyBuilder $DocReadyBuilder)
	{		
		$this->_DocReadyBuilder = $DocReadyBuilder;		
	}
	
}