<?php

namespace Notable\GaTrackerGen;

/**
 * Class UniversalAnalytics
 * @package Notable\GaTrackerGen
 */
class UniversalAnalytics implements GeneratesScriptInterface
{

	/**
	 * @var string
     */
	private $_ua_id;

	/**
	 * @var string
     */
	private $_user_id;

	/**
	 * @var boolean
     */
	private $_link_attribution;

	/**
	 * @var boolean
     */
	private $_demo_interest_reports;

	/**
	 * @param array $settings
	 * @throws \Exception
     */
	public function __construct(array $settings = array())
	{		
		if(count($settings)){
			if(isset($settings['ua_id'])){
				$this->setUaId($settings['ua_id']);
			}
			if(isset($settings['user_id'])){
				$this->setUserId($settings['user_id']);
			}
			if(isset($settings['link_attribution'])){
				$this->setUseLinkAttribution($settings['link_attribution']);
			}
			if(isset($settings['demo_interest_reports'])){
				$this->setUseDemoInterestReports($settings['demo_interest_reports']);
			}
		}
	}

	/**
	 * @return string
	 * @throws \Exception
     */
	public function getScript()
	{
		if(!$this->_ua_id){
			throw new \Exception('Analytics id is required');
		}

		$return_string = "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){"
		."(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),"
		."m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)"
		."})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
		$return_string .= $this->_getCreateString();
		$return_string .= $this->_link_attribution ? $this->_getLinkAttributionCode() : '';
		$return_string .= $this->_demo_interest_reports ? $this->_getDemoInterestReportCode() : '';
		$return_string .= "ga('send', 'pageview');";
		return $return_string;
	}

	/**
	 * @return string
     */
	private function _getLinkAttributionCode()
	{
		return "ga('require', 'linkid', 'linkid.js');";
	}

	/**
	 * @return string
     */
	private function _getDemoInterestReportCode()
	{
		return "ga('require', 'displayfeatures');";
	}

	/**
	 * @return string
	 */
	private function _getCreateString()
	{		
		if($this->_user_id){
			return "ga('create', '$this->_ua_id', { 'userId': '$this->_user_id' });";
		}		
		return "ga('create', '$this->_ua_id', 'auto');";		
	}

	/**
	 * @param boolean $bool
	 * @return $this
	 * @throws \Exception
     */
	public function setUseLinkAttribution($bool)
	{
		if(!is_bool($bool)){
			$type = gettype($bool);
			throw new \Exception("Param must be of type 'boolean', '$type' provided");
		}
		$this->_link_attribution = $bool;
		return $this;
	}

	/**
	 * @param boolean $bool
	 * @return $this
	 * @throws \Exception
     */
	public function setUseDemoInterestReports($bool)
	{
		if(!is_bool($bool)){
			$type = gettype($bool);
			throw new \Exception("Param must be of type 'boolean', '$type' provided");
		}
		$this->_demo_interest_reports = $bool;
		return $this;
	}

	/**
	 * @param string $string
	 * @return $this
	 * @throws \Exception
     */
	public function setUserId($string)
	{
		if(!is_string($string)){
			$type = gettype($string);
			throw new \Exception("Param must be of type 'string', '$type' provided");
		}
		$this->_user_id = $string;
		return $this;
	}

	/**
	 * @param string $string
	 * @return $this
	 * @throws \Exception
     */
	public function setUaId($string)
	{
		if(!is_string($string)){
			$type = gettype($string);
			throw new \Exception("Param must be of type 'string', '$type' provided");
		}
		$this->_ua_id = $string;
		return $this;
	}

}