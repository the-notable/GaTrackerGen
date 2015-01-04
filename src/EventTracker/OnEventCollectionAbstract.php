<?php

namespace Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker;

use Yuyangongfu\Library\Frontend\Javascript\GoogleAnalytics\EventTracker\SendOnEventAbstract,
Phalcon\DI\Injectable;

abstract class OnEventCollectionAbstract extends Injectable implements OnEventCollectionInterface {
	
	/**
	 * @var array
	 */
	protected $_ind_events_array;
	
	public function __construct(){
		
		$this->_ind_events_array = array();
		
	}
	
	/**
	 * @param array $array
	 */
	public function push(array $array){
	
		$this->_ind_events_array[] = $array;
	
	}
	
	/**
	 * @param array $array
	 * @param SendOnEventAbstract $EventObject
	 * @return SendOnEventAbstract
	 */
	protected function _returnCommonElements(array $array, SendOnEventAbstract $EventObject){
		
		if (isset($array['category'])){
			
			$EventObject->setCategory($array['category']);
			
		}
		
		if (isset($array['action'])){
				
			$EventObject->setAction($array['action']);
				
		}
		
		if (isset($array['label'])){
		
			$EventObject->setLabel($array['label']);
		
		}
		
		if (isset($array['value'])){
				
			$EventObject->setValue($array['value']);
				
		}
		
		if (isset($array['field_entry'])){
				
			$EventObject->addFieldEntry($array['field_entry']['field'], $array['field_entry']['value']);
				
		}
		
		return $EventObject;
		
	}
	
}