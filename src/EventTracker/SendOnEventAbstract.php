<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker\Builder,
Yuyangongfu\Library\Frontend\Javascript\Jquery\DocReadyBuilder,
Phalcon\DI\Injectable;

abstract class SendOnEventAbstract extends Injectable {
	
	protected $_EventTrackerBuilder;
	
	protected $_DocReadyBuilder;
	
	public function __construct(){
	
		$this->_setEventTrackerBuilder($this->di->get('GaScriptBuilder'));
	
		$this->_setDocReadyBuilder($this->di->get('JqueryOnReadyBuilder'));

	}
	
	/**
	 * @param unknown $category
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\SendOnEventAbstract
	 */
	public function setCategory($category){
	
		$this->_EventTrackerBuilder->setCategory($category);
	
		return $this;
	
	}
	
	/**
	 * @param string $action
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\SendOnEventAbstract
	 */
	public function setAction($action){
	
		$this->_EventTrackerBuilder->setAction($action);
	
		return $this;
	
	}
	
	/**
	 * @param string $label
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\SendOnEventAbstract
	 */
	public function setLabel($label){
	
		$this->_EventTrackerBuilder->setLabel($label);
	
		return $this;
	
	}
	
	/**
	 * @param string $value
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\SendOnEventAbstract
	 */
	public function setValue($value){
	
		$this->_EventTrackerBuilder->setValue($value);
	
		return $this;
	
	}
	
	/**
	 * @param string $field
	 * @param string $value
	 * @return \Yuyangongfu\Helpers\Javascript\GoogleAnalytics\EventTracker\SendOnEventAbstract
	 */
	public function addFieldEntry($field, $value){
	
		$this->_EventTrackerBuilder->addFieldEntry($field, $value);
	
		return $this;
	
	}
	
	/**
	 * @param Builder $EventTrackerBuilder
	 */
	private function _setEventTrackerBuilder(Builder $EventTrackerBuilder){
	
		$this->_EventTrackerBuilder = $EventTrackerBuilder;
	
	}
	
	/**
	 * @param DocReadyBuilder $DocReadyBuilder
	 */
	private function _setDocReadyBuilder(DocReadyBuilder $DocReadyBuilder){
	
		$this->_DocReadyBuilder = $DocReadyBuilder;
	
	}
	
}